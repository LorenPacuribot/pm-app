<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    protected $fillable = [
        'milestone_id', 'name', 'description',
    ];

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
