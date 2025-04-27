<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_type',
        'element',
        'placeholder',
        'functionality',
        'deliverable',
        'video_manual',
    ];
}
