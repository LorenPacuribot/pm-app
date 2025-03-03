<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'milestone_id', 'phase_id', 'task_type_id', 'name','instructions','links',
    ];

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function tasktypes()
    {
        return $this->belongsTo(TaskType::class, 'task_types_id'); // Ensure correct foreign key
    }

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

    // protected static function boot()
    // {
    //     parent::boot();

    //     // Auto-set milestone_id based on phase_id
    //     static::creating(function ($task) {
    //         if ($task->phase_id) {
    //             $task->milestone_id = Phase::where('id', $task->phase_id)->value('milestone_id');
    //         }
    //     });

    //     static::updating(function ($task) {
    //         if ($task->isDirty('phase_id')) {
    //             $task->milestone_id = Phase::where('id', $task->phase_id)->value('milestone_id');
    //         }
    //     });

    //     // Add to existing projects after task is created
    //     static::created(function ($task) {
    //         if ($task->phase_id) {
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
}
