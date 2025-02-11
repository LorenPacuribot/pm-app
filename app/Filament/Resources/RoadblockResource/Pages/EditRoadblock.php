<?php

namespace App\Filament\Resources\RoadblockResource\Pages;

use App\Filament\Resources\RoadblockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoadblock extends EditRecord
{
    protected static string $resource = RoadblockResource::class;

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
