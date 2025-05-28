<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
      //  'project_id',
        'name',
    ];

    public function phases()
    {
        return $this->hasMany(Phase::class);
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function projects()
    {
        return $this->hasManyThrough(Project::class, Phase::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


protected static function boot()
{
    parent::boot();

    static::created(function ($milestone) {
        // Get the latest or most relevant project (you may want to make this more specific)
        $projectId = ProjectInformation::latest()->first()?->project_id;

        if (!$projectId) {
            return; // Stop if no project found
        }

        $startDate = Carbon::now();
        $endDate = GanttChart::addBusinessDays($startDate, 1, 0);

        GanttChart::create([
            'project_id' => $projectId,
            'milestone_id' => $milestone->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'days' => 1,
            'delay' => 0,
            'actual_end_date' => $endDate,
            'total_qoutation' => 0,
            'total_estimated_time' => 0,
            'total_actual_time' => 0,
        ]);
    });
}


public static function addBusinessDays($startDate, $days, $delay = 0)
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


}

