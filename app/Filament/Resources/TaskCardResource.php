<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskCardResource\Pages;
use App\Filament\Resources\TaskCardResource\RelationManagers;
use App\Models\TaskCard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskCardResource extends Resource
{
    protected static ?string $model = TaskCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationLabel ='Task Card Instructions';

    protected static ?string $slug = 'task-card-instructions';

    protected static ?string $navigationGroup = 'COMMUNICATION';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Tasks')
            ->schema([

            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListTaskCards::route('/'),
            'create' => Pages\CreateTaskCard::route('/create'),
            'edit' => Pages\EditTaskCard::route('/{record}/edit'),
        ];
    }
}
