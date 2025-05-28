<?php

namespace App\Filament\Resources\ProgressOverviewResource\Pages;

use App\Filament\Resources\ProgressOverviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgressOverview extends EditRecord
{
    protected static string $resource = ProgressOverviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }


    
}
