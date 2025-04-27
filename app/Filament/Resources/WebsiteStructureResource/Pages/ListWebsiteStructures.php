<?php

namespace App\Filament\Resources\WebsiteStructureResource\Pages;

use App\Filament\Resources\WebsiteStructureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteStructures extends ListRecords
{
    protected static string $resource = WebsiteStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
