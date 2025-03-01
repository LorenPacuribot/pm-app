<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class RoadblockRelationManager extends RelationManager
{
    protected static string $relationship = 'roadblock';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Road Blocks')
            ->schema([
                //     Select::make('project_id')
                //     ->label('Project')
                //     ->options(Project::all()->pluck('name', 'id'))
                //     ->searchable()
                //    ->required(),
                    Select::make('task_id')
                    ->label('Task')
                    ->options(Task::all()->pluck('name', 'id'))
                    ->searchable()
                   ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ])
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('roadblock')
            ->columns([
                Tables\Columns\TextColumn::make('project_id')
                ->sortable()
                ->getStateUsing(function ($record) {
                    return Project::find($record->project_id)->name;
                })
                ->toggleable(isToggledHiddenByDefault: true)
               // ->copyable()
                ->label('Project'),
                Tables\Columns\TextColumn::make('task_id')
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return Task::find($record->task_id)->name;
                    })
                    //->toggleable(isToggledHiddenByDefault: true)
                    ->copyable()
                    ->label('Task'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->copyable()
                    ->label('Blocker'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('deleted_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
