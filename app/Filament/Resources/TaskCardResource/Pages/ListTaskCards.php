<?php

namespace App\Filament\Resources\TaskCardResource\Pages;

use App\Filament\Resources\TaskCardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaskCards extends ListRecords
{
    protected static string $resource = TaskCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
