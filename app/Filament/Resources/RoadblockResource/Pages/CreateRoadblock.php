<?php

namespace App\Filament\Resources\RoadblockResource\Pages;

use App\Filament\Resources\RoadblockResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRoadblock extends CreateRecord
{
    protected static string $resource = RoadblockResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
