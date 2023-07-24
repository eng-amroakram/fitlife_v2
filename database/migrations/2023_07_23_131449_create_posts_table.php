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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->nullable()->constrained('tags');
            $table->string('image')->nullable();
            $table->string('title_ar')->nullable()->unique();
            $table->string('title_en')->nullable()->unique();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->enum('type', ['exercise', 'nutrition']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('featured', ['yes', 'no']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
