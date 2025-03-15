<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function projectInformation()
    {
        return $this->hasOne(ProjectInformation::class);
    }

    public function projectTeam()
    {
        return $this->hasMany(ProjectTeam::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function ganntcharts()
    {
        return $this->hasMany(GanttChart::class);
    }

    public function spi()
    {
        return $this->hasMany(SPI::class);
    }

    public function cpi()
    {
        return $this->hasMany(CPI::class);
    }

    public function taskmonitoringstatus()
    {
        return $this->hasMany(TaskMonitoringStatus::class);
    }

    public function communicationplan()
    {
        return $this->hasMany(CommunicationPlan::class);
    }

    public function quicklink()
    {
        return $this->hasMany(QuickLink::class);
    }

    public function roadblock()
    {
        return $this->hasMany(Roadblock::class);
    }




//     protected static function boot()
// {
//     parent::boot();

//     static::created(function ($project) {
//         $project->createProgressEntries(); // Fill Progress Table
//         $project->createGanttChartEntries(); // Fill Gantt Chart Table
//     });
// }

// public function createProgressEntries()
// {
//     // Get only tasks that match the project’s task type
//     $tasks = Task::where('task_type_id', $this->task_type_id)->get();

//     foreach ($tasks as $task) {
//         Progress::create([
//             'project_id' => $this->id,
//             'milestone_id' => $task->milestone_id,
//             'phase_id' => $task->phase_id,
//             'task_id' => $task->id,
//             'status' => '0', // Default status
//         ]);
//     }
// }

//   public function createGanttChartEntries()
// {
//     $milestones = [
//         'Site Architecture & Analysis' => 3,
//         'Template Design Creation' => 3,
//         'Template Design Review/Approval' => 3,
//         'Internal Pages Mockup Creation' => 3,
//         'Final Documentation' => 2,
//         'Project Plan Review/Approval' => 3,
//         'Slicing & Development' => 10,
//         'Initial Full Review (QA)' => 9,
//         'Review/Approval for Uploading' => 3,
//         'Uploading/Launching' => 1,
//         'Final Full Review (QA)' => 9,
//         'Review/Approval for Project Closure / Video Manual' => 3,
//         'Project Closure' => 3,
//     ];

//     $startDate = now(); // Start the project today

//     foreach ($milestones as $milestoneName => $duration) {
//         // Find or create the milestone
//         $milestone = Milestone::firstOrCreate(['name' => $milestoneName]);

//         // Calculate the end date based on duration
//         $endDate = $startDate->copy()->addDays($duration);

//         // Insert into Gantt Chart table
//         GanttChart::create([
//             'project_id' => $this->id,
//             'milestone_id' => $milestone->id,
//             'start_date' => $startDate,
//             'end_date' => $endDate,
//             'progress' => 0, // Default progress
//         ]);

//         // Set the next milestone's start date as the current milestone's end date
//         $startDate = $endDate->copy()->addDay(); // Add a gap of 1 day before the next milestone
//     }
}







