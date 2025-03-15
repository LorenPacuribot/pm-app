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

        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('task_type_id')->constrained('task_types')->onDelete('cascade');
            $table->foreignId('milestone_id')->constrained('milestones')->onDelete('cascade');
            $table->foreignId('phase_id')->constrained('phases')->onDelete('cascade');
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->decimal('budget_from_sales', 15, 2)->nullable();
            $table->decimal('time_consumed_by_team', 15, 2)->nullable();
            $table->boolean('status')->default(false);
            $table->date('actual_end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
