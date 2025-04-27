<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProjectDocumentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'page',
        'section_number',
        'section_name',
        'section_type',
        'elements',
        'placeholder',
        'functionality',
        'deliverable',
        'video_manual',
    ];

    // Relationship: ProjectDocumentation belongs to a Project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function sectionType()
{
    return $this->belongsTo(WebsiteStructure::class, 'section_type', 'section_type');
}
}
