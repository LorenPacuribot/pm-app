<?php

namespace App\Filament\Resources;

use id;
use Filament\Forms;
use Filament\Tables;

use App\Models\Project;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProjectResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationGroup;
use App\Filament\Resources\ProjectResource\RelationManagers;


class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel ='Projects';

    protected static ?string $slug = 'projects';

    protected static ?string $navigationGroup = 'PROJECT';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Project')
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [



            RelationGroup::make('Information', [
                RelationManagers\ProjectInformationRelationManager::class,
                RelationManagers\GanntChartRelationManager::class,
                RelationManagers\QuicklinkRelationManager::class,
            ]),

            RelationGroup::make('Progress', [
                RelationManagers\ProgressRelationManager::class,
                RelationManagers\RoadblockRelationManager::class,
            ]),

            RelationGroup::make('Priority', [
                RelationManagers\UrgentRelationManager::class,
                RelationManagers\CommunicationplanRelationManager::class,
            ]),

            RelationGroup::make('Status', [

                RelationManagers\TaskmonitoringstatusRelationManager::class,
                RelationManagers\CpiRelationManager::class,
                RelationManagers\SpiRelationManager::class,
            ]),

            RelationGroup::make('Documentaion', [

                RelationManagers\ProjectDocumentationRelationManager::class,

            ]),



        ];



    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }



}
