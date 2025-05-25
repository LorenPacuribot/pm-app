<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel ='Active Tasks';

    protected static ?string $modelLabel = 'Active Tasks';

    protected static ?string $slug = 'calendar';

    protected static ?string $navigationGroup = 'PROJECT';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
              return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->rows(4),

            Forms\Components\DateTimePicker::make('starts_at')
                ->required(),

            Forms\Components\DateTimePicker::make('ends_at')
                ->after('starts_at'),

            Forms\Components\Select::make('status')
                ->required()
                ->options([
                    'planned' => 'Planned',
                    'ongoing' => 'Ongoing',
                    'completed' => 'Completed',
                ])
                ->default('planned'),

            Forms\Components\ColorPicker::make('color')
                ->label('Event Color')
                ->default('#3b82f6'),

            Forms\Components\Select::make('repeat')
                ->label('Repeat')
                ->options([
                    'none' => 'Do not repeat',
                    'daily' => 'Daily',
                    'weekly' => 'Weekly',
                    'monthly' => 'Monthly',
                ])
                ->default('none'),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'planned' => 'primary',
                        'ongoing' => 'warning',
                        'completed' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\ColorColumn::make('color')
                    ->label('Color'),

                Tables\Columns\TextColumn::make('repeat')
                    ->sortable(),

                Tables\Columns\TextColumn::make('starts_at')
                    ->label('Starts')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('ends_at')
                    ->label('Ends')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
                    'view' => Pages\ViewEvent::route('/{record}'),

        ];
    }
}
