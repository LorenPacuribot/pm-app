<?php

namespace App\Filament\Resources\WebsiteStructureResource\Pages;

use App\Filament\Resources\WebsiteStructureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteStructure extends EditRecord
{
    protected static string $resource = WebsiteStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
