<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProjectTeam extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id', 'role', 'name', 'hours',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
