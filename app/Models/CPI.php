<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CPI extends Model
{

    use HasFactory;
    use SoftDeletes;


    protected $table = 'cpi';

    protected $fillable = [
        'project_id',
        'estimates_from_sales',
        'time_consumed_by_team',
        'cpi_status',
        'cpi_value'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
