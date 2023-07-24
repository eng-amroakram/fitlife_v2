<?php

namespace Database\Seeders;

use App\Models\Muscle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MuscleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $muscles = config('data.Seeders.muscles');

        app()->setLocale('ar');

        foreach ($muscles as $muscle) {
            Muscle::create([
                'image' => "",
                'title_ar' => __("$muscle"),
                'title_en' => $muscle,
                'status' => 'active',
            ]);
        }
    }
}
