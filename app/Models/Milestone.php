<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

