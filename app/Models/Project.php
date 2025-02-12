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

        static::created(function ($task) {
            $task->addToExistingProjects();
        });
    }

    public function addToExistingProjects()
    {
        $projects = Project::all(); // Get all existing projects

        foreach ($projects as $project) {
            Progress::create([
                'project_id' => $project->id,
                'phase_id' => $this->phase_id, // Use the task's phase_id
                'task_id' => $this->id,
                'status' => '0', // Default status
            ]);
        }
    }





}
