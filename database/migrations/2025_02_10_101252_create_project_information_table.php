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
        Schema::create('project_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('client');
        $table->string('contact_person');
        $table->string('project_type');
        $table->string('platform');
        $table->text('purpose');
        $table->string('target_audience');
        $table->date('project_deadline');
        $table->text('project_scope');
        $table->string('developing_language');
        $table->string('server_requirement');
        $table->string('browser');
        $table->string('resolution');
        $table->string('mobile_devices');
        $table->text('pages_to_test');
        $table->text('pages_not_to_test');
        $table->string('mockup_links')->nullable();
        $table->string('wireframe')->nullable();
        $table->string('erd')->nullable();
        $table->string('use_case_diagram')->nullable();
        $table->string('flowchart')->nullable();
        $table->string('final_template_design')->nullable();
        $table->string('prototype_invision_mockup')->nullable();
        $table->text('content_checklist')->nullable();
        $table->text('sitemap')->nullable();
        $table->string('project_drive_link')->nullable();
        $table->string('assigned_pm');
        $table->string('designer');
        $table->string('developer');
        $table->string('qa');
        $table->string('test_site_link')->nullable();
        $table->string('access')->nullable();
        $table->string('livesite_link')->nullable();
        $table->string('wp')->nullable();
        $table->string('ftp_cpanel')->nullable();
        $table->string('db')->nullable();
        $table->string('domain_registry')->nullable();
        $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_information');
    }
};
