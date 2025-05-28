<?php

namespace App\Filament\Resources\AssignedPeopleResource\Pages;

use App\Filament\Resources\AssignedPeopleResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAssignedPeople extends ManageRecords
{
    protected static string $resource = AssignedPeopleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
