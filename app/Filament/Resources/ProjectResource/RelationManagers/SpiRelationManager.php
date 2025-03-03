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

class SpiRelationManager extends RelationManager
{
    protected static string $relationship = 'spi';

    protected static ?string $modelLabel = 'SPI';
    protected static bool $isLazy = false;
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('spi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('spi')
            ->heading('SPI 🗓️')
            ->columns([
                // TextColumn::make('project.name')
                // ->searchable()
                // ->sortable()
                // ->toggleable(isToggledHiddenByDefault: true)
                // ->label('Project'),

             //   TextColumn::make('project.name')->label('Project'),
                TextColumn::make('actual_task_done'),
                TextColumn::make('task_needed_to_be_done'),
                TextColumn::make('spi_status')->badge(),
                TextColumn::make('spi_value'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
            //    Tables\Actions\CreateAction::make(),
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
