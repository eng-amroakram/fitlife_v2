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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->json('muscle_ids')->unique();
            $table->json('equipment_ids')->unique();

            $table->string('title_ar')->unique();
            $table->string('title_en')->unique();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->text('tips_ar')->nullable();
            $table->text('tips_en')->nullable();

            $table->json('place')->nullable();
            $table->enum('type', ['cardio', 'warming', 'cooling', 'exercise']);
            $table->enum('level', ['beginner', 'intermediate', 'advanced']);
            $table->enum('status', ['active', 'inactive']);

            $table->string('image')->nullable();
            $table->string('video')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
