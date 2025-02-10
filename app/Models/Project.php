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
}
