<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'phase_id', 'message', 'sentTo',
    ];

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }
}

