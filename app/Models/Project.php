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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($project) {
            $project->createProgressEntries();
        });
    }

    public function createProgressEntries()
    {
        $tasks = Task::all(); // Get all tasks

        foreach ($tasks as $task) {
            Progress::create([
                'project_id' => $this->id,
                'phase_id' => $task->phase_id, // Automatically get the corresponding phase
                'task_id' => $task->id,
                'status' => '0', // Default status
            ]);
        }
    }
    





}
