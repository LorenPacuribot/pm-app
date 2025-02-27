<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VerseResource\Pages;
use App\Filament\Resources\VerseResource\RelationManagers;
use App\Models\Verse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VerseResource extends Resource
{
    protected static ?string $model = Verse::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel ='Verses';

    protected static ?string $slug = 'verses';

    protected static ?string $navigationGroup = 'SYSTEM MANAGEMENT';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListVerses::route('/'),
            'create' => Pages\CreateVerse::route('/create'),
            'edit' => Pages\EditVerse::route('/{record}/edit'),
        ];
    }
}
