<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AssignedPeople;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssignedPeopleResource\Pages;
use App\Filament\Resources\AssignedPeopleResource\RelationManagers;

class AssignedPeopleResource extends Resource
{
    protected static ?string $model = AssignedPeople::class;


    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel ='Assigned Person';

    protected static ?string $slug = 'assigned-person';

    protected static ?string $navigationGroup = 'OTHERS';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('role')
                //     ->required()
                //     ->maxLength(255),

                                                Select::make('role')
                                    ->options([
                                        'Project Manager' => 'Project Manager',
                                        'Designer' => 'Designer',
                                        'Developer' => 'Developer',
                                        'Quality Assurance' => 'Quality Assurance',
                                        'Sales' => 'Sales',
                                        'PM Lead' => 'PM Lead',
                                        'Engineering Lead' => 'Engineering Lead',
                                        'QA Lead' => 'QA Lead',

                                    ])
                                    ->label('Role')
                                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('name')
                ->searchable(),
                 Tables\Columns\TextColumn::make('role')
                ->searchable(),



            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAssignedPeople::route('/'),
        ];
    }
}
