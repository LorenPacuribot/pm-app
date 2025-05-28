<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'milestone_id', 'phase_id', 'task_type_id', 'to_delegate','name','instructions','links',
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

    protected static function boot()
{
    parent::boot();

    static::created(function ($task) {
        // Prevents error if task_type_id or milestone_id is not set yet
        if (!$task->task_type_id || !$task->milestone_id) {
            return;
        }

        // Find related Gantt chart info for that milestone
        $gantt = \App\Models\GanttChart::where('milestone_id', $task->milestone_id)->first();

        \App\Models\Progress::create([
            'project_id' => $gantt?->project_id,
            'task_type_id' => $task->task_type_id,
            'milestone_id' => $task->milestone_id,
            'phase_id' => $task->phase_id,
            'task_id' => $task->id,
            'assigned_people_id' => 1, // Default/fallback, adjust as needed
            'status' => 0,
            'estimated_time' => 0,
            'actual_time' => 0,
            'time_start' => '08:00:00',
            'time_end' => '17:00:00',
            'notes' => '',
            'start_date' => $gantt?->start_date,
            'end_date' => $gantt?->end_date,
        ]);
    });
}


}
