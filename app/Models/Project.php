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

    public function projectDocumentation()
    {
        return $this->hasMany(ProjectDocumentation::class);
    }


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

    public function urgent()
    {
        return $this->hasMany(Urgent::class);
    }

}







