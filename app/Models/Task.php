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


}
