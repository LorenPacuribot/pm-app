<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class QuicklinkRelationManager extends RelationManager
{
    protected static string $relationship = 'quicklink';

    protected static bool $isLazy = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                            TextInput::make('drive'),
                            TextInput::make('project_plan'),
                            TextInput::make('figma'),
                            TextInput::make('devsite'),
                            TextInput::make('livesite'),
                            TextInput::make('domain_credentials'),
                            TextInput::make('hosting_credentials'),
                            TextInput::make('ifr_sheet'),
                            TextInput::make('ffr_sheet'),
                            TextInput::make('project_work_group'),
                            TextInput::make('project_management'),
                            TextInput::make('architecture_analysis'),
                            TextInput::make('template_design_creation'),
                            TextInput::make('internal_td_review'),
                            TextInput::make('template_designs_approval'),
                            TextInput::make('clients_design_comments'),
                            TextInput::make('internal_pages_creation'),
                            TextInput::make('final_project_documentation'),
                            TextInput::make('project_plan_approval'),
                            TextInput::make('slicing_development'),
                            TextInput::make('initial_full_review'),
                            TextInput::make('initial_full_review_fixes'),
                            TextInput::make('initial_full_review_verification'),
                            TextInput::make('review_approval_uploading'),
                            TextInput::make('devsite_clients_comments'),
                            TextInput::make('user_video_manual'),
                            TextInput::make('project_uploading_launching'),
                            TextInput::make('final_full_review'),
                            TextInput::make('final_full_review_fixes'),
                            TextInput::make('final_full_review_verification'),
                            TextInput::make('approval_project_closure'),
                            TextInput::make('livesite_clients_comments'),
                            TextInput::make('project_closure'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('quicklink')
            ->heading('Quick Link 🔗')
            ->columns([
                TextColumn::make('project.name')->sortable()->searchable(),
                TextColumn::make('drive')->limit(30),
                TextColumn::make('figma')->limit(30),
                TextColumn::make('devsite')->limit(30),
                TextColumn::make('livesite')->limit(30),
                TextColumn::make('project_plan')->limit(30),
                TextColumn::make('project_management')->limit(30),
                TextColumn::make('slicing_development')->limit(30),
                TextColumn::make('final_project_documentation')->limit(30),
                TextColumn::make('project_uploading_launching')->limit(30),
                TextColumn::make('approval_project_closure')->limit(30),
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
