<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use App\Models\Phase;
use App\Models\Message;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MessageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MessageResource\RelationManagers;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left';

    protected static ?string $navigationLabel ='Messages';

    protected static ?string $slug = 'messages';

    protected static ?string $navigationGroup = 'TEMPLATES';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Messages')
            ->schema([
                Select::make('phase_id')
                    ->label('Phase')
                    ->options(Phase::all()->pluck('name', 'id'))
                    ->searchable()
                   ->required(),
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                    Select::make('sentTo')
                    ->options([
                        'client' => 'Client',
                        'team' => 'Team',
                        'sales' => 'Sales',
                                 ])
                            ])
                        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Phase')
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return Phase::find($record->phase_id)->name;
                    }),
                Tables\Columns\TextColumn::make('message')
                ->copyable()
                ->copyableState(fn ($state) => str_replace(['\\n'], "\n", $state))
                ->searchable()
                ->sortable()
                ->wrap()
                ->formatStateUsing(fn ($state) => str_replace(['\\n'], "\n", $state))
                ->html(), // This renders actual line breaks if styled properly
                Tables\Columns\TextColumn::make('sentTo')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
