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
        Schema::create('task_monitoring_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('task_type_id')->constrained('task_types')->onDelete('cascade');
            $table->string('team');
            $table->date('activation_date');
            $table->date('original_closure');
            $table->date('extended_closure')->nullable();
            $table->date('actual_closure')->nullable();
            $table->string('status');
            $table->string('current_milestone');
            $table->string('current_phase');
            $table->string('current_status');
            $table->unsignedBigInteger('cpi');
            $table->unsignedBigInteger('spi');
            $table->integer('original_days');
            $table->integer('actual_days');
            $table->integer('delay_days')->default(0);
            $table->text('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_monitoring_statuses');
    }
};
