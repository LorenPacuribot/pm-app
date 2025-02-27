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
                'milestone_id' => $task->milestone_id, // Automatically get the corresponding phase
                'phase_id' => $task->phase_id, // Automatically get the corresponding phase
                'task_id' => $task->id,
                'status' => '0', // Default status
            ]);
        }
    }






}
