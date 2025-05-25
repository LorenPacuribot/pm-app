<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'starts_at',
        'ends_at',
        'status',
        'color',
        'repeat',
    ];

    protected static function booted()
    {
        static::creating(function ($event) {
            $event->uuid = (string) Str::uuid();
        });
    }
}
