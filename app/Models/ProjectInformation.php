<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectInformation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'client',
        'contact_person',
        'task_type_id' ,
        'platform',
        'purpose',
        'target_audience',
        'project_startdate',
        'project_deadline',
        'project_scope',
        'developing_language',
        'server_requirement',
        'browser',
        'resolution',
        'mobile_devices',
        'pages_to_test',
        'pages_not_to_test',
        'mockup_links',
        'wireframe',
        'erd',
        'use_case_diagram',
        'flowchart',
        'final_template_design',
        'prototype_invision_mockup',
        'content_checklist',
        'sitemap',
        'project_drive_link',
        'assigned_pm',
        'designer',
        'developer',
        'qa',
        'test_site_link',
        'access',
        'livesite_link',
        'wp',
        'ftp_cpanel',
        'db',
        'domain_registry'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tasktypes()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }


//     protected static function boot()
//     {
//         parent::boot();

//         static::saved(function ($projectInfo) {
//             if ($projectInfo->isDirty('project_startdate')) {
//                 $firstMilestone = GanttChart::where('project_id', $projectInfo->project_id)
//                     ->orderBy('start_date', 'asc')
//                     ->first();

//                 if ($firstMilestone) {
//                     $firstMilestone->start_date = $projectInfo->project_startdate;
//                     $firstMilestone->end_date = $firstMilestone->addBusinessDays(
//                         $firstMilestone->start_date,
//                         $firstMilestone->days,
//                         $firstMilestone->delay
//                     );
//                     $firstMilestone->save();
//                 }
//             }
//         });

// }


protected static function boot()
{
    parent::boot();

    static::created(function ($projectInformation) {
        $projectInformation->createGanttChartEntries();
         $projectInformation->createProgressEntries();
         $projectInformation->createCPIEntries();
         $projectInformation->createSPIEntries();
         $projectInformation->createTaskMonitoringEntries();
       //  $projectInformation->createCommunicationPlanEntries();
    });

    static::updating(function ($projectInformation) {
        if ($projectInformation->isDirty('project_startdate')) {
            $projectInformation->updateGanttChartStartDate();
        }
    });

    static::deleted(function ($projectInformation) {
        Progress::where('project_id', $projectInformation->project_id)->delete();

        $projectInformation->createGanttChartEntries();
        $projectInformation->createProgressEntries(); // Re-run the creation method
        $projectInformation->createCPIEntries();
        $projectInformation->createSPIEntries();
       // $projectInformation->createCommunicationPlanEntries();
    });


    static::updating(function ($projectInformation) {
        if ($projectInformation->isDirty( 'task_type_id')) {
            $projectInformation->createProgressEntries();
        }
    });


    static::saved(function ($projectInformation) {
        $projectInformation->updateTaskMonitoringStatus();

    });


}

public function createGanttChartEntries()
{
    // Remove old Gantt Chart entries for this project
    GanttChart::where('project_id', $this->project_id)->delete();

    $milestones = Milestone::all();
    $startDate = Carbon::parse($this->project_startdate);

    foreach ($milestones as $index => $milestone) {
        $endDate = $startDate->copy()->addDays(1);
        while ($endDate->isWeekend()) {
            $endDate->addDay();
        }

        GanttChart::create([
            'project_id' => $this->project_id,
            'milestone_id' => $milestone->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'days' => 1,
            'delay' => 0,
            'budget' => 0,
            'actual_end_date'=> $endDate,
        ]);

        $startDate = $endDate->copy()->addDay();
    }
}



public function updateGanttChartStartDate()
{
    // Explicitly get the first milestone (ID 1)
    $firstMilestone = GanttChart::where('project_id', $this->project_id)
        ->where('id', 1) // Ensure we are targeting ID 1 first
        ->first();

    if (!$firstMilestone) {
        return;
    }

    // Update start date of the first milestone
    $firstMilestone->start_date = Carbon::parse($this->project_startdate);
    $firstMilestone->end_date = $this->addBusinessDays(
        $firstMilestone->start_date,
        $firstMilestone->days,
        $firstMilestone->delay
    );
    $firstMilestone->save();

    // Get all other milestones ordered by start_date
    $milestones = GanttChart::where('project_id', $this->project_id)
        ->where('id', '>', 1) // Exclude the first milestone (already updated)
        ->orderBy('start_date', 'asc')
        ->get();

    // Set next milestone's start date based on the first milestone's end date
    $previousEndDate = $firstMilestone->end_date->copy()->addDay();
    while ($previousEndDate->isWeekend()) {
        $previousEndDate->addDay();
    }

    foreach ($milestones as $milestone) {
        // Update start date
        $milestone->start_date = $previousEndDate;

        // Adjust end date
        $milestone->end_date = $this->addBusinessDays(
            $milestone->start_date,
            $milestone->days,
            $milestone->delay
        );

        // Save updated milestone
        $milestone->save();

        // Move to the next milestone's start date
        $previousEndDate = $milestone->end_date->copy()->addDay();
        while ($previousEndDate->isWeekend()) {
            $previousEndDate->addDay();
        }
    }
}




    /**
     * Add business days to a date, considering weekends.
     */
    public static function addBusinessDays($startDate, $days, $delay)
    {
        $date = Carbon::parse($startDate)->addDays($delay);
        $addedDays = 0;

        while ($addedDays < $days) {
            $date->addDay();
            if (!$date->isWeekend()) {
                $addedDays++;
            }
        }

        return $date;
    }

    /**
     * Get the next available business day as the start date.
     */
    public static function getNextMilestoneStartDate($previousEndDate)
    {
        $date = Carbon::parse($previousEndDate)->addDay();

        while ($date->isWeekend()) {
            $date->addDay();
        }

        return $date;
    }

    public function createProgressEntries()
    {
        // Remove old progress entries for this project
        Progress::where('project_id', $this->project_id)->delete();

        $tasks = Task::where('task_type_id', $this->task_type_id)->get();

        foreach ($tasks as $task) {
            Progress::create([
                'project_id' => $this->project_id,
                'task_type_id' => $this->task_type_id,
                'milestone_id' => $task->milestone_id,
                'phase_id' => $task->phase_id,
                'task_id' => $task->id,
                'start_date' => GanttChart::where('milestone_id', $task->milestone_id)->value('start_date'),
                'end_date' => GanttChart::where('milestone_id', $task->milestone_id)->value('end_date'),
                'budget_from_sales' => 0,
                'time_consumed' => 0,
                'status' => 0,
            ]);
        }
    }


public function createCPIEntries()
{
    CPI::where('project_id', $this->project_id)->delete();

    $budget = Progress::where('project_id', $this->project_id)->sum('budget_from_sales');
    $timeConsumed = Progress::where('project_id', $this->project_id)->sum('time_consumed_by_team');
    CPI::create([
        'project_id' => $this->project_id,
        'estimates_from_sales' => $budget,
        'time_consumed_by_team' => $timeConsumed,
        'cpi_status' => ($timeConsumed == 0) ? 1 : ($budget / $timeConsumed),
        'cpi_value' => ($timeConsumed == 0) ? 1 : ($budget / $timeConsumed),
    ]);
}

public function createSPIEntries()
{

    SPI::where('project_id', $this->project_id)->delete();

    $actualTasks = Progress::where('project_id', $this->project_id)->where('status', 1)->count();
    $totalTasks = Progress::where('project_id', $this->project_id)->count();
    SPI::create([
        'project_id' => $this->project_id,
        'actual_task_done' => $actualTasks,
        'task_needed_to_be_done' => $totalTasks,
        'spi_status' => ($totalTasks == 0) ? 1 : ($actualTasks / $totalTasks),
        'spi_value' => ($totalTasks == 0) ? 1 : ($actualTasks / $totalTasks),
    ]);
}

public function createTaskMonitoringEntries()
{
    TaskMonitoringStatus::create([
        'project_id' => $this->project_id,
       'task_type_id' => $this->task_type_id,
        'team' => $this->assigned_pm,
        'activation_date' => $this->project_startdate,
        'original_closure' => $this->project_deadline,
        'extended_closure' => GanttChart::where('project_id', $this->project_id)->orderBy('end_date', 'desc')->value('end_date'),
        'actual_closure' => GanttChart::where('project_id', $this->project_id)->orderBy('end_date', 'desc')->value('end_date'),
        'status' => 0,
        'current_milestone' => Milestone::where('id', Progress::where('project_id', $this->project_id)->where('status', 1)->orderBy('milestone_id', 'desc')->value('milestone_id'))->first()->name ?? 'Project Activation',
        'current_phase' => Phase::where('id', Progress::where('project_id', $this->project_id)->where('status', 1)->orderBy('phase_id', 'desc')->value('phase_id'))->first()->name ?? 'Project Activation',
        'current_status' => Task::where('id', Progress::where('project_id', $this->project_id)->where('status', 1)->orderBy('task_id', 'desc')->value('task_id'))->first()->name ?? 'Not Started',
        'cpi' => CPI::where('project_id', $this->project_id)->value('cpi_value') ?? 0,
        'spi' => SPI::where('project_id', $this->project_id)->value('spi_value')?? 0,
        'original_days' => GanttChart::where('project_id', $this->project_id)->sum('days'),
        'actual_days' => GanttChart::where('project_id', $this->project_id)->sum('days') + GanttChart::where('project_id', $this->project_id)->sum('delay'),
        'delay_days' => GanttChart::where('project_id', $this->project_id)->sum('delay'),
        'reason' => '',
    ]);
}
public function updateTaskMonitoringStatus()
{
    $taskMonitoring = TaskMonitoringStatus::where('project_id', $this->id)->latest()->first();

    if ($taskMonitoring) {
        $taskMonitoring->update([
            'current_milestone' => Milestone::where('id', Progress::where('project_id', $this->project_id)->where('status', 1)->orderBy('milestone_id', 'desc')->value('milestone_id'))->first()->name ?? 'Project Activation',
            'current_phase' => Phase::where('id', Progress::where('project_id', $this->id)->where('status', 1)->orderBy('phase_id', 'desc')->value('phase_id'))->first()->name ??  'Project Activation',
            'current_status' => Task::where('id', Progress::where('project_id', $this->id)->where('status', 1)->orderBy('task_id', 'desc')->value('task_id'))->first()->name ?? 'Not Started',
            'cpi' => CPI::where('project_id', $this->id)->value('cpi_value') ?? 1,
            'spi' => SPI::where('project_id', $this->id)->value('spi_value') ?? 1,
        ]);
    }
}

// public function createCommunicationPlanEntries()
// {
//     // Remove old communication plan entries for this project
//     CommunicationPlan::where('project_id', $this->project_id)->delete();

//     // Retrieve all milestones for the project
//     $milestones = Milestone::where('project_id', $this->project_id)->get();

//     foreach ($milestones as $milestone) {
//         // Retrieve all phases under the milestone
//         $phases = Phase::where('milestone_id', $milestone->id)->get();

//         foreach ($phases as $phase) {
//             // Retrieve all tasks under the phase
//             $tasks = Task::where('phase_id', $phase->id)->get();

//             foreach ($tasks as $task) {
//                 // Ensure there is a corresponding email entry for the phase
//                 $email = Email::where('phase_id', $phase->id)->first();

//                 if ($email) {
//                     CommunicationPlan::create([
//                         'project_id'    => $this->project_id,
//                         'milestone_id'  => $milestone->id,
//                         'phase_id'      => $phase->id,
//                         'task_id'       => $task->id, // Now linked to tasks
//                         'email_id'      => $email->id,
//                         'status'        => 0,
//                     ]);
//                 }
//             }
//         }
//     }
// }

}





