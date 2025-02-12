<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'phase_id', 'subject', 'content', 'response',
    ];

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }
}
