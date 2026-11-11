<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $modelLabel = 'pengguna';
    protected static ?string $pluralModelLabel = 'Pengguna & Hak Akses';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Nama')->required(),
            Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('role')->label('Peran')->options(User::ROLES)->required()->native(false)
                ->helperText('Super Admin: semua akses · Editor: kelola & terbitkan konten · Kontributor: isi dokumentasi harian (perlu persetujuan).'),
            Forms\Components\TextInput::make('password')->label('Password')->password()->revealable()
                ->required(fn (string $operation) => $operation === 'create')
                ->dehydrated(fn ($state) => filled($state))->minLength(8)
                ->helperText(fn (string $operation) => $operation === 'edit' ? 'Kosongkan jika tidak ingin mengganti.' : null),
            Forms\Components\Toggle::make('is_active')->label('Akun aktif')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable()->weight('medium')->description(fn (User $r) => $r->email),
                Tables\Columns\TextColumn::make('role')->label('Peran')->badge()
                    ->formatStateUsing(fn ($state) => User::ROLES[$state] ?? $state)
                    ->color(fn ($state) => match ($state) { 'super_admin' => 'danger', 'editor' => 'primary', default => 'info' }),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->date('d M Y')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([Tables\Filters\SelectFilter::make('role')->label('Peran')->options(User::ROLES)])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->hidden(fn (User $r) => $r->id === auth()->id()),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
