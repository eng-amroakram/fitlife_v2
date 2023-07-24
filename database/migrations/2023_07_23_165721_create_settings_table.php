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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('site_url')->nullable();
            $table->string('video')->nullable();
            $table->longText('privacy_policy_en')->nullable();
            $table->longText('privacy_policy_ar')->nullable();
            $table->longText('terms_service_en')->nullable();
            $table->longText('terms_service_ar')->nullable();
            $table->longText('about_us_en')->nullable();
            $table->longText('about_us_ar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
