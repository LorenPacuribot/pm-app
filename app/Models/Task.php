<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'phase_id', 'name', 'description', 'documentNeeded',
    ];

    public function phase()
    {
        return $this->belongsTo(Phase::class);
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


    protected static function boot()
{
    parent::boot();

    static::created(function ($task) {
        if ($task->phase_id) { // Ensure task has a phase_id
            $task->addToExistingProjects();

        }
    });
}

public function addToExistingProjects()
{
    $projects = Project::all(); // Get all existing projects

    foreach ($projects as $project) {
        Progress::create([
            'project_id' => $project->id,
            'phase_id' => $this->phase_id, // Ensure this is not null
            'task_id' => $this->id,
            'status' => '0', // Default status
        ]);
    }
}

}
