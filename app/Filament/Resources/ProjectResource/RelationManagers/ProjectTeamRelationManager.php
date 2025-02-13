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

class ProjectTeamRelationManager extends RelationManager
{
    protected static string $relationship = 'projectTeam';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Project Information')
            ->schema([
                // Select::make('project_id')
                // ->relationship('project', 'name')
                // ->required(),

            TextInput::make('role')
                ->required(),

            TextInput::make('name')
                ->required(),

            TextInput::make('hours')
            ->required(),
            ])
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ProjectTeam')
            ->columns([
                TextColumn::make('project.name')->label('Project'),
                TextColumn::make('role')->limit(50),
                TextColumn::make('name'),
                TextColumn::make('hours'),
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
