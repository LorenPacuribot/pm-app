<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Phase;
use App\Models\TaskType;
use Filament\Forms\Form;
use App\Models\Milestone;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TaskTypeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TaskTypeResource\RelationManagers;

class TaskTypeResource extends Resource
{
    protected static ?string $model = TaskType::class;

    protected static ?string $modelLabel = 'Task';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel ='Tasks';

    protected static ?string $slug = 'tasks';

    protected static ?string $navigationGroup = 'PROCESS DETAILS';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Tasks')
            ->schema([
            //     Select::make('milestone_id')
            //     ->label('Milestone')
            //     ->options(Milestone::all()->pluck('name', 'id'))
            //     ->searchable()
            //    ->required(),
                // Select::make('phase_id')
                //     ->label('Phase')
                //     ->options(Phase::all()->pluck('name', 'id'))
                //     ->searchable()
                //    ->required(),
                Forms\Components\TextInput::make('name')

                    ->required()
                    ->maxLength(255),

            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            // Tables\Columns\TextColumn::make('Milestone')
            // ->numeric()
            // ->sortable()
            // ->getStateUsing(function ($record) {
            //     return Milestone::find($record->milestone_id)->name;
            // }),
            // Tables\Columns\TextColumn::make('Phase')
            //     ->numeric()
            //     ->sortable()
            //     ->getStateUsing(function ($record) {
            //         return Phase::find($record->phase_id)->name;
            // }),
            Tables\Columns\TextColumn::make('name')
                ->label('Project Type')
                ->sortable()
                ->searchable()
                ->copyable(),
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
            RelationManagers\TaskRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskTypes::route('/'),
            'create' => Pages\CreateTaskType::route('/create'),
            'edit' => Pages\EditTaskType::route('/{record}/edit'),
        ];
    }
}
