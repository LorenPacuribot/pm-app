<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quick_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('drive')->nullable();
            $table->string('project_plan')->nullable();
            $table->string('figma')->nullable();
            $table->string('devsite')->nullable();
            $table->string('livesite')->nullable();
            $table->string('domain_credentials')->nullable();
            $table->string('hosting_credentials')->nullable();
            $table->string('ifr_sheet')->nullable();
            $table->string('ffr_sheet')->nullable();
            $table->string('project_work_group')->nullable();
            $table->string('project_management')->nullable();
            $table->string('architecture_analysis')->nullable();
            $table->string('template_design_creation')->nullable();
            $table->string('internal_td_review')->nullable();
            $table->string('template_designs_approval')->nullable();
            $table->string('clients_design_comments')->nullable();
            $table->string('internal_pages_creation')->nullable();
            $table->string('final_project_documentation')->nullable();
            $table->string('project_plan_approval')->nullable();
            $table->string('slicing_development')->nullable();
            $table->string('initial_full_review')->nullable();
            $table->string('initial_full_review_fixes')->nullable();
            $table->string('initial_full_review_verification')->nullable();
            $table->string('review_approval_uploading')->nullable();
            $table->string('devsite_clients_comments')->nullable();
            $table->string('user_video_manual')->nullable();
            $table->string('project_uploading_launching')->nullable();
            $table->string('final_full_review')->nullable();
            $table->string('final_full_review_fixes')->nullable();
            $table->string('final_full_review_verification')->nullable();
            $table->string('approval_project_closure')->nullable();
            $table->string('livesite_clients_comments')->nullable();
            $table->string('project_closure')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_links');
    }
};
