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

    protected static bool $isLazy = false;

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
                            '0' => 'Ongoing',
                            '1' => 'Closed',

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
            ->heading('Task Monitoring Status ✅')
            ->columns([
                TextColumn::make('project.name')->label('Project'),
                TextColumn::make('task_type'),
                TextColumn::make('team'),
                TextColumn::make('activation_date')->date(),
                TextColumn::make('original_closure')->date(),
                TextColumn::make('status')->badge(),
                TextColumn::make('current_phase'),
                TextColumn::make('current_status'),
                TextColumn::make('cpi'),
                TextColumn::make('spi'),
                TextColumn::make('delay_days'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
