<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Data Program';
    protected static ?string $modelLabel = 'anggota tim';
    protected static ?string $pluralModelLabel = 'Tim Peneliti';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('Nama lengkap & gelar')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\TextInput::make('position')->label('Jabatan')->required()->placeholder('contoh: Co-PI'),
                Forms\Components\TextInput::make('expertise')->label('Bidang')->placeholder('contoh: Epidemiologi'),
                Forms\Components\Select::make('group')->label('Kelompok')->options(TeamMember::GROUPS)->default('peneliti')->required()->native(false),
                Forms\Components\TextInput::make('institution')->label('Institusi')->default('Universitas Muhammadiyah Purwokerto'),
                Forms\Components\Textarea::make('bio')->label('Bio singkat')->rows(3)->columnSpanFull(),
                Forms\Components\TextInput::make('order_index')->label('Urutan')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->label('Tampilkan di website')->default(true)->inline(false),
            ])->columns(2)->columnSpan(['lg' => 2]),
            Forms\Components\Section::make('Foto')->schema([
                Forms\Components\FileUpload::make('photo')->hiddenLabel()->image()->avatar()->imageEditor()
                    ->imageCropAspectRatio('1:1')->imageResizeTargetWidth('600')->disk('public')->directory('tim')->maxSize(5120),
            ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_index')->defaultSort('order_index')
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->label('')->disk('public')->circular()
                    ->defaultImageUrl(asset('images/mascot-avatar.webp')),
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable()->weight('medium')->description(fn (TeamMember $r) => $r->expertise),
                Tables\Columns\TextColumn::make('position')->label('Jabatan'),
                Tables\Columns\TextColumn::make('group')->label('Kelompok')->badge()->formatStateUsing(fn ($state) => TeamMember::GROUPS[$state] ?? $state),
                Tables\Columns\ToggleColumn::make('is_active')->label('Tampil'),
            ])
            ->filters([Tables\Filters\SelectFilter::make('group')->label('Kelompok')->options(TeamMember::GROUPS)])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
