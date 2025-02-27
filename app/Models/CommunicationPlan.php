<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunicationPlan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id','milestone_id','phase_id', 'email_id', 'status',
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

    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}
