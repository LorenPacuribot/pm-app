<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class UrgentRelationManager extends RelationManager
{
    protected static string $relationship = 'urgent';

    protected static bool $isLazy = false;


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    Select::make('status')
                    ->options([
                        '0' => 'Pending',
                        '1' => 'Done',
                    ])

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('urgent')
            ->heading('Urgent Task  ⌛')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->searchable()
                ->sortable()
                ->formatStateUsing(fn ($state) => $state == '1' ? 'Done' : 'Pending')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                   '0' => 'warning',
                   '1' => 'success',
                }),
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
