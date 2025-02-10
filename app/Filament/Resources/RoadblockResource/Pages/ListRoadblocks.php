<?php

namespace App\Filament\Resources\RoadblockResource\Pages;

use App\Filament\Resources\RoadblockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoadblocks extends ListRecords
{
    protected static string $resource = RoadblockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
