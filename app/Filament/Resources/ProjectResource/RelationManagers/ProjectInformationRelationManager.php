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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ProjectInformationRelationManager extends RelationManager
{
    protected static string $relationship = 'projectInformation';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            // Select::make('project_id')
            //     ->relationship('project', 'name')
            //     ->required(),

            Textarea::make('overview')
                ->rows(3)
                ->required(),

            TextInput::make('projectType')
                ->required(),

            TextInput::make('platform')
                ->required(),

            TextInput::make('methodology')
                ->required(),

            Textarea::make('problem')
                ->rows(3)
                ->required(),

            Textarea::make('solution')
                ->rows(3)
                ->required(),

            Textarea::make('impact')
                ->rows(3)
                ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ProjectInformation')
            ->columns([
                TextColumn::make('project.name')->label('Project'),
                TextColumn::make('overview')->limit(50),
                TextColumn::make('projectType'),
                TextColumn::make('platform'),
                TextColumn::make('methodology'),
                TextColumn::make('problem')->limit(50),
                TextColumn::make('solution')->limit(50),
                TextColumn::make('impact')->limit(50),
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
