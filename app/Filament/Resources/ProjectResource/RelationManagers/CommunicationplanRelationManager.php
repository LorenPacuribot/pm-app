<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CommunicationplanRelationManager extends RelationManager
{
    protected static string $relationship = 'communicationplan';

    protected static bool $isLazy = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                ->relationship('project', 'name') // Assuming 'projects' table has a 'name' field
                ->required(),

            Select::make('milestone_id')
                ->relationship('milestone', 'name') // Assuming 'milestones' table has a 'title' field
                ->required(),

            Select::make('phase_id')
                ->relationship('phase', 'name') // Assuming 'phases' table has a 'name' field
                ->required(),

            TextInput::make('email_id')
                ->email()
                ->required(),

                Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
                ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('communicationplan')

            ->heading('Communication Plan ✉️')
            ->columns([

                TextColumn::make('project.name')->sortable()->searchable(),
                TextColumn::make('milestone.name')->sortable(),
                TextColumn::make('phase.name')->sortable(),
                TextColumn::make('email_id')->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'in_progress',
                        'success' => 'completed',
                    ])
                    ->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
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
