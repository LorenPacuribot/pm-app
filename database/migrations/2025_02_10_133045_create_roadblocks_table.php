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
        Schema::create('roadblocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('project')->onDelete('cascade');
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roadblocks');
    }
};
