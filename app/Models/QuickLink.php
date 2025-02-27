<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuickLink extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id', 'drive', 'project_plan', 'figma', 'devsite', 'livesite',
        'domain_credentials', 'hosting_credentials', 'ifr_sheet', 'ffr_sheet',
        'project_work_group', 'project_management', 'architecture_analysis',
        'template_design_creation', 'internal_td_review', 'template_designs_approval',
        'clients_design_comments', 'internal_pages_creation', 'final_project_documentation',
        'project_plan_approval', 'slicing_development', 'initial_full_review',
        'initial_full_review_fixes', 'initial_full_review_verification',
        'review_approval_uploading', 'devsite_clients_comments', 'user_video_manual',
        'project_uploading_launching', 'final_full_review', 'final_full_review_fixes',
        'final_full_review_verification', 'approval_project_closure',
        'livesite_clients_comments', 'project_closure'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
