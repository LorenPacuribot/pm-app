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
            Forms\Components\Section::make('Task Monitoring')
               ->schema([
                    Select::make('project_id')
                        ->relationship('project', 'name')
                        ->required(),
                        Select::make('task_type_id')
                        ->relationship('tasktypes', 'name')
                        ->nullable(),

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
                        TextInput::make('current_milestone')
                        ->maxLength(255),
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
        ->paginated(false)
            ->recordTitleAttribute('taskmonitoringstatus')
            ->heading('Task Monitoring Status ✅')
            ->columns([
            //    TextColumn::make('project.name')->label('Project'),

                TextColumn::make('tasktypes.name')->label('Project Type'),
                TextColumn::make('team')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('activation_date')->date(),
                TextColumn::make('original_closure')->date(),
                TextColumn::make('extended_closure')->date()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('actual_closure')->date()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                ->label('Status')
               // ->searchable()
              //  ->sortable()
                ->formatStateUsing(fn ($state) => $state == '1' ? 'Closed' : 'Ongoing')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                   '0' => 'warning',
                   '1' => 'success',
                }),
                TextColumn::make('current_milestone')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('current_phase')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('current_status'),
                TextColumn::make('cpi')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('spi')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('original_days')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('actual_days')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('delay_days'),
                TextColumn::make('reason')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
               // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
              //  Tables\Actions\DeleteAction::make(),
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
