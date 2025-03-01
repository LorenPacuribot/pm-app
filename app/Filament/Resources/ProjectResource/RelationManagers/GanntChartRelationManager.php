<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class GanntChartRelationManager extends RelationManager
{
    protected static string $relationship = 'ganntcharts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('project_id')
                ->required()
                ->numeric()
                ->label('Project ID'),
            TextInput::make('milestone_id')
                ->required()
                ->numeric()
                ->label('Milestone ID'),
            DatePicker::make('start_date')
                ->required()
                ->label('Start Date'),
            DatePicker::make('end_date')
                ->required()
                ->label('End Date'),
            TextInput::make('days')
                ->required()
                ->numeric()
                ->label('Days'),
            TextInput::make('delay')
                ->numeric()
                ->label('Delay')
                ->default(0),
            TextInput::make('budget')
                ->required()
                ->numeric()
                ->label('Budget'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ganntchart')
            ->columns([
                TextColumn::make('project.name')
                ->searchable()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Project'),
                TextColumn::make('milestone.name')
                ->searchable()
                ->sortable()
                ->label('Milestone'),
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
