<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use App\Models\TaskCard;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TaskCardResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TaskCardResource\RelationManagers;

class TaskCardResource extends Resource
{
    protected static ?string $model = TaskCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationLabel ='Task Card Instructions';

    protected static ?string $slug = 'task-card-instructions';

    protected static ?string $navigationGroup = 'TEMPLATES';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Task Card')
            ->schema([
                Select::make('task_id')
                    ->label('Task')
                    ->options(Task::all()->pluck('name', 'id'))
                    ->searchable()
                   ->required(),
                   Forms\Components\TextInput::make('name')
                   ->required()
                    ->columnSpanFull(),
                   Forms\Components\Textarea::make('instruction')
                   ->required()
                   ->columnSpanFull(),
            ]),
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Task')
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return Task::find($record->task_id)->name;
                    }),
                Tables\Columns\TextColumn::make('name')
                ->copyable()
                ->searchable(),
                Tables\Columns\TextColumn::make('instruction')
                ->copyable()
                ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
