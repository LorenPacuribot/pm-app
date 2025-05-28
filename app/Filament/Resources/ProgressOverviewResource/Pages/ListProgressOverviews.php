<?php

namespace App\Filament\Resources\ProgressOverviewResource\Pages;

use App\Filament\Resources\ProgressOverviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgressOverviews extends ListRecords
{
    protected static string $resource = ProgressOverviewResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }

    protected function getActions(): array
    {
        return []; // no create button
    }

}
