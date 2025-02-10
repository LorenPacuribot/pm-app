<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function phases()
    {
        return $this->hasMany(Phase::class);
    }

    public function projects()
    {
        return $this->hasManyThrough(Project::class, Phase::class);
    }
}

