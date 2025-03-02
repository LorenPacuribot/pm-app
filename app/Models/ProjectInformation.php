<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectInformation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'client',
        'contact_person',
        'project_type',
        'platform',
        'purpose',
        'target_audience',
        'project_deadline',
        'project_scope',
        'developing_language',
        'server_requirement',
        'browser',
        'resolution',
        'mobile_devices',
        'pages_to_test',
        'pages_not_to_test',
        'mockup_links',
        'wireframe',
        'erd',
        'use_case_diagram',
        'flowchart',
        'final_template_design',
        'prototype_invision_mockup',
        'content_checklist',
        'sitemap',
        'project_drive_link',
        'assigned_pm',
        'designer',
        'developer',
        'qa',
        'test_site_link',
        'access',
        'livesite_link',
        'wp',
        'ftp_cpanel',
        'db',
        'domain_registry'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
