<?php

namespace App\Filament\Resources\VerseResource\Pages;

use App\Filament\Resources\VerseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVerse extends EditRecord
{
    protected static string $resource = VerseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
