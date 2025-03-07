<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Progress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id','task_type_id','milestone_id','phase_id', 'task_id', 'status','qoute_from_sales','time_consumed',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }






}
