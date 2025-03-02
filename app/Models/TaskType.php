<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskType extends Model
{
    use HasFactory;



    protected $fillable = [
       'name',
    ];

    // public function milestone()
    // {
    //     return $this->belongsTo(Milestone::class);
    // }

    // public function phase()
    // {
    //     return $this->belongsTo(Phase::class);
    // }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function taskcard()
    {
        return $this->hasOne(Taskcard::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


//     protected static function boot()
// {
//     parent::boot();

//     static::created(function ($task) {
//         if ($task->phase_id) { // Ensure task has a phase_id
//             $task->addToExistingProjects();

//         }
//     });
// }

// public function addToExistingProjects()
// {
//     $projects = Project::all(); // Get all existing projects

//     foreach ($projects as $project) {
//         Progress::create([
//             'project_id' => $project->id,
//             'milestone_id' => $this->milestone_id,
//             'phase_id' => $this->phase_id, // Ensure this is not null
//             'task_id' => $this->id,
//             'status' => '0', // Default status
//         ]);
//     }
// }



// protected static function boot()
// {
//     parent::boot();

//     static::creating(function ($taskType) {
//         if ($taskType->phase_id) {
//             $taskType->milestone_id = Phase::where('id', $taskType->phase_id)->value('milestone_id');
//         }
//     });

//     static::updating(function ($taskType) {
//         if ($taskType->isDirty('phase_id')) {
//             $taskType->milestone_id = Phase::where('id', $taskType->phase_id)->value('milestone_id');
//         }
//     });
// }

}






