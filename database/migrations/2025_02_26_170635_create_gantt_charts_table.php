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
        Schema::create('ganttcharts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('milestone_id')->constrained('milestones')->onDelete('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('days')->nullable();
            $table->integer('delay')->default(0)->nullable();
            $table->string('current_phase')->nullable();
            $table->date('actual_end_date')->nullable();
            $table->decimal('total_qoutation', 15, 2)->nullable();
            $table->decimal('total_actual_time', 15, 2)->nullable();
             $table->decimal('total_estimated_time', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ganttcharts');
    }
};
