<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgressRelationManager extends RelationManager
{
    protected static string $relationship = 'progress';

    

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('phase_id')
                ->required()
                ->numeric(),
                Forms\Components\TextInput::make('task_id')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('status')
                ->required()
                ->maxLength(255),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Progress')
            ->columns([
                Tables\Columns\TextColumn::make('Progress'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
