<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Progress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'task_type_id',
        'milestone_id',
        'phase_id',
        'task_id',
        'status',
        'actual_end_date',
        'budget_from_sales',
        'time_consumed_by_team',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    protected static function boot()
    {
        parent::boot();

        // When a progress entry is created or updated, update CPI, SPI, and Task Monitoring
        static::saved(function ($progress) {
            $progress->updateCPI();
            $progress->updateSPI();
            $progress->updateTaskMonitoring();
            $progress->updateGanttChart();
        });

        // When a progress entry is deleted, update CPI, SPI, and Task Monitoring
        static::deleted(function ($progress) {
            $progress->updateCPI();
            $progress->updateSPI();
            $progress->updateTaskMonitoring();
            $progress->updateGanttChart();
        });
    }


    public function updateCPI()
    {
        $projectId = $this->project_id;
        $budget = Progress::where('project_id', $projectId)->sum('budget_from_sales');
        $timeConsumed = Progress::where('project_id', $projectId)->sum('time_consumed_by_team');

        CPI::updateOrCreate(
            ['project_id' => $projectId], // Find the CPI entry by project_id
            [
                'estimates_from_sales' => $budget,
                'time_consumed_by_team' => $timeConsumed,
                'cpi_status' => ($timeConsumed == 0) ? 1 : ($budget / $timeConsumed),
                'cpi_value' => ($timeConsumed == 0) ? 1 : ($budget / $timeConsumed),
            ]
        );
    }

    public function updateSPI()
{
    $projectId = $this->project_id;
    $actualTasks = Progress::where('project_id', $this->project_id)->where('status', 1)->count();
    $totalTasks = Progress::where('project_id', $this->project_id)->count();

    SPI::updateOrCreate(
        ['project_id' => $projectId], // Find the CPI entry by project_id
        [
           'actual_task_done' => $actualTasks,
        'task_needed_to_be_done' => $totalTasks,
        'spi_status' => ($totalTasks == 0) ? 1 : ($actualTasks / $totalTasks),
        'spi_value' => ($totalTasks == 0) ? 1 : ($actualTasks / $totalTasks),
        ]
        );
}

public function updateTaskMonitoring()
{
    $taskMonitoring = TaskMonitoringStatus::where('project_id', $this->project_id)->first();

    if ($taskMonitoring) {
        $taskMonitoring->current_phase = Phase::where('id', $this->phase_id)->value('name') ?? 'Initial';
        $taskMonitoring->current_status = Task::where('id', $this->task_id)->value('name') ?? 'Not Started';
        $taskMonitoring->cpi = CPI::where('project_id', $this->project_id)->value('cpi_value') ?? 1;
        $taskMonitoring->spi = SPI::where('project_id', $this->project_id)->value('spi_value') ?? 1;

        $taskMonitoring->save(); // Save the updates
    }
}

    public function updateGanttChart()
    {
        $actualEndDate = GanttChart::where('project_id', $this->project_id)->first();

        if ($actualEndDate) {
            $actualEndDate->current_phase = Task::where('id', $this->task_id)->value('name') ?? 'Initial';

            $actualEndDate->save(); // Save the updates
        }
    }


}
