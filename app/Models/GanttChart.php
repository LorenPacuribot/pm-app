<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GanttChart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ganttcharts';

    protected $fillable = [
        'project_id',
        'milestone_id',
        'start_date',
        'end_date',
        'days',
        'delay',
        'budget'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }




}
