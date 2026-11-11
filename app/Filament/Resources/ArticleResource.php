<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $modelLabel = 'berita';
    protected static ?string $pluralModelLabel = 'Berita & Artikel';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make([
                Forms\Components\Section::make('Isi berita')->schema([
                    Forms\Components\TextInput::make('title')->label('Judul')->required()->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state, string $operation) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    Forms\Components\TextInput::make('slug')->label('Alamat URL (slug)')->required()->unique(ignoreRecord: true)
                        ->prefix('/berita/')->helperText('Dibuat otomatis dari judul.'),
                    Forms\Components\Textarea::make('summary')->label('Ringkasan')->rows(3)->maxLength(300)
                        ->helperText('1–2 kalimat. Tampil di kartu berita & pratinjau media sosial.'),
                    Forms\Components\RichEditor::make('content')->label('Isi')->required()
                        ->fileAttachmentsDisk('public')->fileAttachmentsDirectory('articles/konten')
                        ->toolbarButtons(['bold', 'italic', 'underline', 'h2', 'h3', 'bulletList', 'orderedList', 'blockquote', 'link', 'attachFiles', 'undo', 'redo']),
                ]),
                Forms\Components\Section::make('Galeri foto')->collapsible()->schema([
                    Forms\Components\FileUpload::make('gallery')->hiddenLabel()->image()->multiple()->reorderable()->maxFiles(20)
                        ->disk('public')->directory('articles/galeri')->imageResizeMode('contain')->imageResizeTargetWidth('1600')
                        ->maxSize(8192)->panelLayout('grid'),
                ]),
            ])->columnSpan(['lg' => 2]),

            Forms\Components\Group::make([
                Forms\Components\Section::make('Publikasi')->schema([
                    Forms\Components\Select::make('status')->options(['draft' => 'Draf', 'published' => 'Terbit'])->default('draft')->required()->native(false),
                    Forms\Components\DateTimePicker::make('published_at')->label('Tanggal terbit')->native(false)
                        ->helperText('Kosongkan untuk memakai waktu saat diterbitkan.'),
                    Forms\Components\Select::make('category')->label('Kategori')->options(Article::CATEGORIES)->default('berita')->required()->native(false),
                    Forms\Components\Toggle::make('is_featured')->label('Jadikan berita utama di beranda'),
                ]),
                Forms\Components\Section::make('Gambar utama')->schema([
                    Forms\Components\FileUpload::make('featured_image')->hiddenLabel()->image()->imageEditor()
                        ->imageCropAspectRatio('16:9')->imageResizeTargetWidth('1600')
                        ->disk('public')->directory('articles')->maxSize(8192),
                ]),
            ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')->label('')->disk('public')->width(72)->height(44),
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->wrap()->limit(80)->weight('medium'),
                Tables\Columns\TextColumn::make('category')->label('Kategori')->badge()->formatStateUsing(fn ($state) => Article::CATEGORIES[$state] ?? $state),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->formatStateUsing(fn ($state) => $state === 'published' ? 'Terbit' : 'Draf')
                    ->color(fn ($state) => $state === 'published' ? 'success' : 'gray'),
                Tables\Columns\IconColumn::make('is_featured')->label('Utama')->boolean()->toggleable(),
                Tables\Columns\TextColumn::make('published_at')->label('Terbit')->dateTime('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('author.name')->label('Penulis')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->label('Kategori')->options(Article::CATEGORIES),
                Tables\Filters\SelectFilter::make('status')->options(['draft' => 'Draf', 'published' => 'Terbit']),
            ])
            ->actions([
                Tables\Actions\Action::make('lihat')->icon('heroicon-o-arrow-top-right-on-square')->color('gray')
                    ->url(fn (Article $r) => route('berita.show', $r), shouldOpenInNewTab: true)
                    ->visible(fn (Article $r) => $r->status === 'published'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
