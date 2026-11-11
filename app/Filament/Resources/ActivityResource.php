<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Dokumentasi kegiatan harian.
 */
class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $modelLabel = 'catatan kegiatan';
    protected static ?string $pluralModelLabel = 'Dokumentasi Harian';
    protected static ?int $navigationSort = 0;
    protected static ?string $recordTitleAttribute = 'title';

    /** Kontributor hanya melihat catatannya sendiri. */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->with('village');

        return auth()->user()?->canPublish() ? $query : $query->where('author_id', auth()->id());
    }

    public static function getNavigationBadge(): ?string
    {
        if (! auth()->user()?->canPublish()) {
            return null;
        }
        $n = Activity::where('status', 'draft')->count();

        return $n ? (string) $n : null;
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Draf menunggu persetujuan';
    }

    public static function form(Form $form): Form
    {
        $canPublish = auth()->user()?->canPublish();

        return $form->schema([
            Forms\Components\Section::make('Kegiatan')->schema([
                Forms\Components\DatePicker::make('activity_date')->label('Tanggal kegiatan')->default(now())->required()->native(false)->displayFormat('d F Y')->maxDate(now()->addDay()),
                Forms\Components\Select::make('category')->label('Kategori')->options(Activity::CATEGORIES)->required()->native(false),
                Forms\Components\TextInput::make('title')->label('Judul singkat')->required()->maxLength(160)->columnSpanFull()
                    ->placeholder('contoh: Pemeriksaan ovitrap minggu ke-2 di Desa Beji'),
                Forms\Components\Select::make('village_id')->label('Desa mitra')->relationship('village', 'name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->name} — Kec. {$record->district}")
                    ->searchable()->preload()->native(false)->helperText('Kosongkan jika kegiatan tidak di desa mitra.'),
                Forms\Components\TextInput::make('location')->label('Lokasi lain')->maxLength(160)->placeholder('contoh: Aula UMP'),
                Forms\Components\Textarea::make('description')->label('Catatan kegiatan')->required()->rows(5)->columnSpanFull()
                    ->helperText('Apa yang dilakukan, siapa yang terlibat, dan hasilnya. Jangan cantumkan nama/alamat warga.'),
            ])->columns(2),
            Forms\Components\Section::make('Foto kegiatan')->schema([
                Forms\Components\FileUpload::make('photos')->hiddenLabel()->image()->multiple()->reorderable()->maxFiles(20)
                    ->disk('public')->directory(fn () => 'dokumentasi/'.now()->format('Y/m'))
                    ->imageResizeMode('contain')->imageResizeTargetWidth('1600')->maxSize(10240)->panelLayout('grid')
                    ->helperText('Foto pertama menjadi sampul. Maks. 20 foto, 10 MB per foto. Hindari foto wajah anak tanpa izin orang tua.'),
            ]),
            Forms\Components\Section::make('Publikasi')->schema([
                Forms\Components\Select::make('status')->options(['draft' => 'Draf (menunggu persetujuan)', 'published' => 'Terbit'])
                    ->default($canPublish ? 'published' : 'draft')->required()->native(false)
                    ->disabled(! $canPublish)->dehydrated($canPublish)
                    ->helperText($canPublish ? null : 'Catatan Anda akan diterbitkan setelah diperiksa Editor.'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('activity_date', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('photos')->label('Foto')->disk('public')->circular()->stacked()->limit(3)->limitedRemainingText(),
                Tables\Columns\TextColumn::make('activity_date')->label('Tanggal')->date('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('title')->label('Kegiatan')->searchable()->wrap()->limit(70)->weight('medium')
                    ->description(fn (Activity $r) => $r->place_label),
                Tables\Columns\TextColumn::make('category')->label('Kategori')->badge()->formatStateUsing(fn ($state) => Activity::CATEGORIES[$state] ?? $state),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->formatStateUsing(fn ($state) => $state === 'published' ? 'Terbit' : 'Draf')
                    ->color(fn ($state) => $state === 'published' ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('author.name')->label('Pencatat')->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->label('Kategori')->options(Activity::CATEGORIES),
                Tables\Filters\SelectFilter::make('village')->label('Desa')->relationship('village', 'name'),
                Tables\Filters\SelectFilter::make('status')->options(['draft' => 'Draf', 'published' => 'Terbit']),
            ])
            ->actions([
                Tables\Actions\Action::make('terbitkan')->label('Terbitkan')->icon('heroicon-o-check-circle')->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Activity $r) => $r->status === 'draft' && auth()->user()->canPublish())
                    ->action(fn (Activity $r) => $r->update(['status' => 'published'])),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('terbitkan')->label('Terbitkan terpilih')->icon('heroicon-o-check-circle')
                        ->requiresConfirmation()->visible(fn () => auth()->user()->canPublish())
                        ->action(fn (Collection $records) => $records->each->update(['status' => 'published'])),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
