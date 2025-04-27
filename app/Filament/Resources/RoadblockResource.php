<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Form;
use App\Models\Roadblock;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RoadblockResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RoadblockResource\RelationManagers;

class RoadblockResource extends Resource
{
    protected static ?string $model = Roadblock::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-frown';

    protected static ?string $navigationLabel ='Road Blocks';

    protected static ?string $slug = 'roadblocks';

    protected static ?string $navigationGroup = 'OTHERS';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Road Blocks')
            ->schema([
                    Select::make('project_id')
                    ->label('Project')
                    ->options(Project::all()->pluck('name', 'id'))
                    ->searchable()
                   ->required(),
                    Select::make('task_id')
                    ->label('Task')
                    ->options(Task::all()->pluck('name', 'id'))
                    ->searchable()
                   ->required(),
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
                Tables\Columns\TextColumn::make('project_id')
                ->sortable()
                ->getStateUsing(function ($record) {
                    return Project::find($record->project_id)->name;
                })
                ->toggleable(isToggledHiddenByDefault: true)
                ->copyable(),
                Tables\Columns\TextColumn::make('task_id')
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return Task::find($record->task_id)->name;
                    })
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->copyable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoadblocks::route('/'),
            'create' => Pages\CreateRoadblock::route('/create'),
            'edit' => Pages\EditRoadblock::route('/{record}/edit'),
        ];
    }
}
