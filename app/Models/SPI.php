<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SPI extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'spi';

    protected $fillable = [
        'project_id',
        'actual_task_done',
        'task_needed_to_be_done',
        'spi_status',
        'spi_value'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
