<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class GanntChartRelationManager extends RelationManager
{
    protected static string $relationship = 'ganntcharts';

    protected static bool $isLazy = false;

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Gannt Chart')
                ->schema([
                // TextInput::make('project_id')
                // ->required()
                // ->numeric()
                // ->label('Project ID'),
            // TextInput::make('milestone_id')
            //     ->required()
            //     ->numeric()
            //     ->label('Milestone ID'),
            // DatePicker::make('start_date')
            //     ->required()
            //     ->label('Start Date'),
            // DatePicker::make('end_date')
            //     ->required()
            //     ->label('End Date'),
            TextInput::make('days')
                ->required()
                ->numeric()
                ->label('Days'),
            TextInput::make('delay')
                ->numeric()
                ->label('Delay')
                ->default(0),
            DatePicker::make('actual_end_date')
                ->required()
                ->label('Actual End Date'),
            TextInput::make('budget')
                ->required()
                ->numeric()
                ->label('Budget'),
                ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ganntchart')
            ->heading('Gannt Chart ⭐')
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


                TextColumn::make('start_date')
                ->label('Start Date'),

                TextColumn::make('end_date')
                ->label('End Date'),

                TextColumn::make('days')
                ->label('Days'),

                TextColumn::make('delay')
                ->label('Delays'),

                TextColumn::make('actual_end_date')
                ->label('Actual End Date'),

                TextColumn::make('total_qoutation')
                ->label('Total qoutation')
                ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('total_estimated_time')
                ->label('Total estimated time')
                ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('total_actual_time')
                ->label('Total actual time')
                ->toggleable(isToggledHiddenByDefault: true),


            ])
            ->filters([
                //
            ])
            ->headerActions([
              //  Tables\Actions\CreateAction::make(),
            ])
            ->actions([
              //  Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                // Tables\Actions\ForceDeleteAction::make(),
                // Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
