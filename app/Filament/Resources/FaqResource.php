<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $modelLabel = 'FAQ';
    protected static ?string $pluralModelLabel = 'FAQ Maskot';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('question')->label('Pertanyaan')->required()->maxLength(255)->columnSpanFull(),
            Forms\Components\Textarea::make('answer')->label('Jawaban (dijawab maskot)')->required()->rows(4)->columnSpanFull()
                ->helperText('Gunakan bahasa sederhana yang mudah dipahami warga.'),
            Forms\Components\Select::make('category')->label('Kategori')->options(Faq::CATEGORIES)->default('umum')->required()->native(false),
            Forms\Components\TextInput::make('order_index')->label('Urutan')->numeric()->default(0),
            Forms\Components\Toggle::make('show_in_widget')->label('Tampilkan di widget maskot')->default(true),
            Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_index')->defaultSort('order_index')
            ->columns([
                Tables\Columns\TextColumn::make('question')->label('Pertanyaan')->searchable()->wrap(),
                Tables\Columns\TextColumn::make('category')->label('Kategori')->badge()->formatStateUsing(fn ($state) => Faq::CATEGORIES[$state] ?? $state),
                Tables\Columns\ToggleColumn::make('show_in_widget')->label('Widget'),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->filters([Tables\Filters\SelectFilter::make('category')->options(Faq::CATEGORIES)])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
