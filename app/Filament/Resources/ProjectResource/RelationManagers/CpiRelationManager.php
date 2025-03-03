<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CpiRelationManager extends RelationManager
{
    protected static string $relationship = 'cpi';

    protected static ?string $modelLabel = 'CPI';

    protected static bool $isLazy = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cpi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('cpi')
            ->heading('CPI 💸')
            ->columns([
                // TextColumn::make('project.name')
                // ->searchable()
                // ->sortable()
                // ->toggleable(isToggledHiddenByDefault: true)
                // ->label('Project'),
               // TextColumn::make('project.name')->label('Project'),
                TextColumn::make('estimates_from_sales'),
                TextColumn::make('time_consumed_by_team'),
                TextColumn::make('cpi_status')->badge(),
                TextColumn::make('cpi_value'),
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
