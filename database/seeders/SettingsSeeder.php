<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'email' => "email@gmial.com",
            'mobile' => "",
            'site_url' => "",
            'video' => "",
            'privacy_policy_en' => "email@gmial.com",
            'privacy_policy_ar' => "email@gmial.com",
            'terms_service_en' => "",
            'terms_service_ar' => "",
            'about_us_en' => "",
            'about_us_ar' => "",
        ]);
    }
}
