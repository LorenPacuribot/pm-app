<?php

namespace App\Filament\Resources;

use App\Models\WebsiteStructure;
use App\Filament\Resources\WebsiteStructureResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class WebsiteStructureResource extends Resource
{
    protected static ?string $model = WebsiteStructure::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Website Setup';
    protected static ?string $navigationLabel = 'Sections';
    protected static ?string $pluralModelLabel = 'Sections';
    protected static ?string $modelLabel = 'Section';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('section_type')
                    ->label('Section Type')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('element')
                    ->label('Elements')
                    ->rows(5)
                    ->required(),

                Forms\Components\Textarea::make('placeholder')
                    ->label('Placeholder')
                    ->rows(5)
                    ->nullable(),

                Forms\Components\Textarea::make('functionality')
                    ->label('Functionality')
                    ->rows(5)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_type')
                    ->label('Section Type')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('element')
                    ->label('Elements')
                    ->html()
                    ->formatStateUsing(function ($state) {
                        return nl2br(e($state));
                    })
                    ->limit(300)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('placeholder')
                    ->label('Placeholder')
                    ->html()
                    ->formatStateUsing(function ($state) {
                        return nl2br(e($state));
                    })
                    ->limit(300)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('functionality')
                    ->label('Functionality')
                    ->html()
                    ->formatStateUsing(function ($state) {
                        return nl2br(e($state));
                    })
                    ->limit(300)
                    ->toggleable(),
            ])
            ->filters([])
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('section_type')
                    ->label('Section Type')
                    ->size('large')
                    ->weight('bold'),

                TextEntry::make('element')
                    ->label('Elements')
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->columnSpanFull(),

                TextEntry::make('placeholder')
                    ->label('Placeholder')
                    ->columnSpanFull(),

                TextEntry::make('functionality')
                    ->label('Functionality')
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->columnSpanFull(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebsiteStructures::route('/'),
            'create' => Pages\CreateWebsiteStructure::route('/create'),
            'edit' => Pages\EditWebsiteStructure::route('/{record}/edit'),
        ];
    }
}
