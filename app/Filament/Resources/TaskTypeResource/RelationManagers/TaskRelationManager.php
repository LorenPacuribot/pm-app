<?php

namespace App\Filament\Resources\TaskTypeResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Phase;
use Filament\Forms\Form;
use App\Models\Milestone;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class TaskRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('phase_id')
                    ->label('Phase')
                    ->options(Phase::all()->pluck('name', 'id'))
                    ->searchable()
                   ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('instructions')
                //    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('links')
                    //    ->required()
                        ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Task')
            ->columns([
                Tables\Columns\TextColumn::make('Milestone')
                ->numeric()
                ->sortable()
                ->getStateUsing(function ($record) {
                    return Milestone::find($record->milestone_id)->name;
                })
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Phase')
                    ->numeric()
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return Phase::find($record->phase_id)->name;
                }),
                Tables\Columns\TextColumn::make('name')
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
