<?php

namespace App\Filament\Widgets;

use App\Models\GanttChart;
use App\Models\Project;
use App\Models\Task;
use App\Models\Phase;
use Illuminate\Support\Carbon;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public \Illuminate\Database\Eloquent\Model | string | null $model = GanttChart::class;
    protected static ?int $sort = 2;

public function fetchEvents(array $fetchInfo): array
{
    $view = $fetchInfo['view'] ?? 'dayGridMonth';

    return match ($view) {
        'dayGridMonth' => $this->getMilestoneEvents($fetchInfo),
        'timeGridWeek' => $this->getPhaseEvents($fetchInfo),
        'timeGridDay'  => $this->getTaskEvents($fetchInfo),
        default        => [],
    };
}


    protected function getMilestoneEvents(array $fetchInfo): array
    {
        return GanttChart::query()
            ->whereDate('start_date', '<=', $fetchInfo['end'])
            ->whereDate('actual_end_date', '>=', $fetchInfo['start'])
            ->with(['milestone', 'project'])
            ->get()
            ->map(function (GanttChart $gantt) {
                $endDate = $gantt->actual_end_date
                    ? Carbon::parse($gantt->actual_end_date)->addDay()->toDateString()
                    : null;

                return EventData::make()
                    ->id($gantt->id)
                    ->title($gantt->project->name . ': ' . optional($gantt->milestone)->name)
                    ->start($gantt->start_date)
                    ->end($endDate);
            })
            ->toArray();
    }

    protected function getPhaseEvents(array $fetchInfo): array
    {
        return Phase::query()
            ->whereDate('start_date', '<=', $fetchInfo['end'])
            ->whereDate('end_date', '>=', $fetchInfo['start'])
            ->with('project')
            ->get()
            ->map(function (Phase $phase) {
                return EventData::make()
                    ->id($phase->id)
                    ->title($phase->project->name . ': ' . $phase->name)
                    ->start($phase->start_date)
                    ->end(Carbon::parse($phase->end_date)->addDay()->toDateString());
            })
            ->toArray();
    }

    protected function getTaskEvents(array $fetchInfo): array
    {
        return Task::query()
            ->whereDate('start_time', '<=', $fetchInfo['end'])
            ->whereDate('end_time', '>=', $fetchInfo['start'])
            ->with('project')
            ->get()
            ->map(function (Task $task) {
                return EventData::make()
                    ->id($task->id)
                    ->title($task->project->name . ': ' . $task->name)
                    ->start($task->start_time)
                    ->end(Carbon::parse($task->end_time)->addDay()->toDateString());
            })
            ->toArray();
    }

    public function getFormSchema(): array
    {
        return [];
    }

    protected function modalActions(): array
    {
        return [];
    }
}
