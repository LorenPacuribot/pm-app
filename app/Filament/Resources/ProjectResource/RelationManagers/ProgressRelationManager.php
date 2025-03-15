<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ProgressRelationManager extends RelationManager
{
    protected static string $relationship = 'progress';

    protected static bool $isLazy = false;

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Progress')
            ->schema([
                // Select::make('phase_id')
                // ->relationship('phase', 'name')
                // ->required(),
                // Select::make('task_id')
                // ->relationship('task', 'name')
                // ->required(),
            // Forms\Components\TextInput::make('status')
            //     ->required()
            //     ->maxLength(255),
            TextInput::make('budget_from_sales')
            ->label('Budget from Sales'),
            TextInput::make('time_consumed_by_team')
            ->label('Time consumed'),
                Select::make('status')
                ->options([
                    '0' => 'Pending',
                    '1' => 'Done',
                ])
    ])
]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Progress')
            ->heading('Progress ✅')
            ->columns([
                TextColumn::make('project.name')
                ->searchable()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Project'),
                TextColumn::make('milestone.name')
                ->searchable()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Milestone'),
                TextColumn::make('phase.name')
                ->searchable()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Phase'),
                TextColumn::make('task.name')
                ->searchable()
                ->sortable()
                ->label('Task'),
                TextColumn::make('budget_from_sales')
                ->label('Qoute from Sales')
                ->searchable()
                ->sortable(),
                TextColumn::make('status')
                ->label('Status')
                ->searchable()
                ->sortable()
                ->formatStateUsing(fn ($state) => $state == '1' ? 'Done' : 'Pending')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                   '0' => 'warning',
                   '1' => 'success',
                }),
                   TextColumn::make('time_consumed_by_team')
                   ->label('Time Consumed')
                   ->searchable()
                   ->sortable(),




            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
              //  Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
              //  Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([

                Tables\Actions\BulkActionGroup::make([

                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]));
    }
}
