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
        Schema::create('website_structures', function (Blueprint $table) {
            $table->id();
            $table->string('section_type');
            $table->text('element')->nullable();
            $table->text('placeholder')->nullable();
            $table->text('functionality')->nullable();
            $table->text('deliverable')->nullable(); // ✅ Added Deliverable
            $table->string('video_manual')->nullable(); // ✅ Added Video Manual (string for filename / URL)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_structures');
    }
};
