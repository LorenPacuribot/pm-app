<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Urgent;
use App\Models\Project;
use App\Models\Roadblock;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::query()->count())
            ->icon('heroicon-o-users')
            ->description('Total Users')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7,  10, 3, 15, 4, 7])
            ->color('primary'),

            Stat::make('Project', Project::query()->count())
            ->icon('heroicon-o-heart')
            ->description('Total Projects')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7,  10, 3, 15, 4, 7])
            ->color('primary'),

            Stat::make('Roadblock', Roadblock::query()->count())
            ->icon('heroicon-o-face-frown')
            ->description('Total Roadblocks')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7,  10, 3, 15, 4, 7])
            ->color('primary'),

            Stat::make('Urgent', Urgent::query()->count())
            ->icon('heroicon-o-exclamation-triangle')
            ->description('Total Urgent')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7,  10, 3, 15, 4, 7])
            ->color('primary'),


        ];
    }
}
