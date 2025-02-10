<?php

namespace App\Filament\Resources\TaskCardResource\Pages;

use App\Filament\Resources\TaskCardResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTaskCard extends CreateRecord
{
    protected static string $resource = TaskCardResource::class;
}
