<?php

namespace App\Filament\Resources\ProgressOverviewResource\Pages;

use App\Filament\Resources\ProgressOverviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProgressOverview extends ViewRecord
{
    protected static string $resource = ProgressOverviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
          //  Actions\EditAction::make(),
        ];
    }
}
