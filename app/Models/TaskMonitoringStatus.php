<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskMonitoringStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id',
      'task_type_id' ,
        'team',
        'activation_date',
        'original_closure',
        'extended_closure',
        'actual_closure',
        'status',
         'current_milestone',
        'current_phase',
        'current_status',
        'cpi',
        'spi',
        'original_days',
        'actual_days',
        'delay_days',
        'reason'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tasktypes()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }


}
