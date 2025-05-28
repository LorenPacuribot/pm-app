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
        'milestone_id',
        'phase_id',
        'task_type_id',
        'task_id',
        'assigned_people_id',
        'status',
        'actual_end_date',
        'estimated_time',
        'actual_time',
        'time_start',
        'time_end',
        'notes'
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

        public function assignedPeople()
    {
        return $this->belongsTo(AssignedPeople::class);
    }

public function ganttChart()
{
    return \App\Models\GanttChart::where('milestone_id', $this->milestone_id)->first();
}



protected static function boot()
{
    parent::boot();

    static::saved(function ($progress) {
        $progress->updateCPI();
        $progress->updateSPI();
        $progress->updateTaskMonitoring();
        $progress->updateGanttChart();
        $progress->updateGanttChartTotals(); // ← Add this line
    });

    static::deleted(function ($progress) {
        $progress->updateCPI();
        $progress->updateSPI();
        $progress->updateTaskMonitoring();
        $progress->updateGanttChart();
        $progress->updateGanttChartTotals(); // ← Add this line
    });
}


    public function updateCPI()
    {
        $projectId = $this->project_id;
        $total_qoutation = Progress::where('project_id', $projectId)->sum('estimated_time');
        $timeConsumed = Progress::where('project_id', $projectId)->sum('actual_time');

        CPI::updateOrCreate(
            ['project_id' => $projectId], // Find the CPI entry by project_id
            [
                'estimated_time' => $total_qoutation,
                'actual_time' => $timeConsumed,
                'cpi_status' => ($timeConsumed == 0) ? 1 : ($total_qoutation / $timeConsumed),
                'cpi_value' => ($timeConsumed == 0) ? 1 : ($total_qoutation / $timeConsumed),
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
        $taskMonitoring->current_milestone = Milestone::where('id', $this->milestone_id)->value('name') ?? 'Initial';
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

public function updateGanttChartTotals()
{
    if (!$this->milestone_id) return;

    $ganttChart = GanttChart::where('milestone_id', $this->milestone_id)
        ->where('project_id', $this->project_id)
        ->first();

    if ($ganttChart) {
        $ganttChart->total_estimated_time = Progress::where('milestone_id', $this->milestone_id)
            ->where('project_id', $this->project_id)
            ->sum('estimated_time');

        $ganttChart->total_actual_time = Progress::where('milestone_id', $this->milestone_id)
            ->where('project_id', $this->project_id)
            ->sum('actual_time');

        $ganttChart->saveQuietly();
    }
}

}
