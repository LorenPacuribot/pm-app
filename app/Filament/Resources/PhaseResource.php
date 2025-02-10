<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhaseResource\Pages;
use App\Filament\Resources\PhaseResource\RelationManagers;
use App\Models\Phase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Milestone;
use Filament\Forms\Components\Select;

class PhaseResource extends Resource
{
    protected static ?string $model = Phase::class;

    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';

    protected static ?string $navigationLabel ='Phases';

    protected static ?string $slug = 'phases';

    protected static ?string $navigationGroup = 'PROCESS DETAILS';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Phases')
            ->schema([
                Select::make('milestone_id')
                ->label('Milestone')
                ->options(Milestone::all()->pluck('name', 'id'))
                ->searchable()
               ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('milestone_id')
                ->getStateUsing(function ($record) {
                    return Milestone::find($record->milestone_id)->name;
                })
                ->toggleable(isToggledHiddenByDefault: true)
                ->copyable(),
                Tables\Columns\TextColumn::make('name')
                ->copyable()
                ->searchable(),
                Tables\Columns\TextColumn::make('description')
                ->copyable()
                ->searchable()
                    ->sortable()
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPhases::route('/'),
            'create' => Pages\CreatePhase::route('/create'),
            'edit' => Pages\EditPhase::route('/{record}/edit'),
        ];
    }
}
