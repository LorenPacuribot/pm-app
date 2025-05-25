<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taskcard extends Model
{
    use HasFactory;

    protected $fillable = [
        'phase_id', 'name', 'instruction',
    ];

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }
}
