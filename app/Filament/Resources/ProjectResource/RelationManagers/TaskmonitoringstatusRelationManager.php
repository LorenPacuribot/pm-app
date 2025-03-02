<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class TaskmonitoringstatusRelationManager extends RelationManager
{
    protected static string $relationship = 'taskmonitoringstatus';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make(2)
                ->schema([
                    Select::make('project_id')
                        ->relationship('project', 'name')
                        ->required(),
                    TextInput::make('task_type')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('team')
                        ->required()
                        ->maxLength(255),
                    DatePicker::make('activation_date')
                        ->required(),
                    DatePicker::make('original_closure')
                        ->required(),
                    DatePicker::make('extended_closure'),
                    DatePicker::make('actual_closure'),
                    Select::make('status')
                        ->options([
                            'Pending' => 'Pending',
                            'Ongoing' => 'Ongoing',
                            'Completed' => 'Completed',
                            'Delayed' => 'Delayed',
                        ])
                        ->required(),
                    TextInput::make('current_phase')
                        ->maxLength(255),
                    TextInput::make('current_status')
                        ->maxLength(255),
                    TextInput::make('cpi')
                        ->numeric(),
                    TextInput::make('spi')
                        ->numeric(),
                    TextInput::make('original_days')
                        ->numeric(),
                    TextInput::make('actual_days')
                        ->numeric(),
                    TextInput::make('delay_days')
                        ->numeric(),
                    Textarea::make('reason')
                        ->maxLength(500),
                ]),
        ]);

    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('taskmonitoringstatus')
            ->columns([
                TextColumn::make('project.name')
                ->searchable()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Project'),
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
