<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_documentations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('page');
            $table->integer('section_number')->nullable();
            $table->string('section_name')->nullable();
            $table->string('section_type')->nullable();
            $table->text('elements')->nullable();
            $table->text('placeholder')->nullable();
            $table->text('functionality')->nullable();
            $table->text('deliverable')->nullable();
            $table->string('video_manual')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_documentations');
    }
};
