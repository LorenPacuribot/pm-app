<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taskcard extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id', 'name', 'instruction',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
