<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Menu;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MenuResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MenuResource\RelationManagers;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $slug = 'kelola_menu';
    protected static ?string $navigationLabel = 'Kelola Menu';
    protected static ?string $pluralModelLabel = 'Daftar Menu';
    protected static ?string $modelLabel = 'Menu';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('menu_name')
                    ->label('Nama Menu')
                    ->placeholder('Masukan nama menu')
                    ->required(),

                Select::make('category_id')
                    ->relationship('category', 'category_name')
                    ->label('Kategori Menu')
                    ->placeholder('Pilih Kategori')
                    ->required(),

                TextInput::make('price')
                    ->label('Harga')
                    ->placeholder('Masukan harga menu')
                    ->numeric()
                    ->required(),

                TextInput::make('gofood_link')
                    ->label('Link GoFood')
                    ->placeholder('Masukan link GoFood (opsional)'),

                TextInput::make('shopeefood_link')
                    ->label('Link ShopeeFood')
                    ->placeholder('Masukan link ShopeeFood (opsional)'),

                FileUpload::make('image')
                    ->image()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('id')
                ->sortable(),

            TextColumn::make('menu_name')
                ->label('Menu')
                ->searchable()
                ->sortable()
                ->wrap(),

            TextColumn::make('price')
                ->label('Harga')
                ->sortable()
                ->money('IDR'),

            TextColumn::make('category.category_name')
                ->label('Kategori')
                ->sortable()
                ->wrap(),

            ImageColumn::make('image')
                ->label('Gambar')
                ->width(100)
                ->height(100),

            IconColumn::make('gofood_link')
                ->label('GF')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->getStateUsing(fn ($record) => !empty($record->gofood_link))
                ->sortable(),

            IconColumn::make('shopeefood_link')
                ->label('SF')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->getStateUsing(fn ($record) => !empty($record->shopeefood_link))
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
