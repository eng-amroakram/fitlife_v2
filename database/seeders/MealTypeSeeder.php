<?php

namespace Database\Seeders;

use App\Models\MealType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meal_types = config('data.Seeders.meal-types');
        foreach ($meal_types as $title_ar => $title_en) {
            MealType::create([
                'title_ar' => $title_ar,
                'title_en' => $title_en,
                'status' => 'active',
                'image' => "",
            ]);
        }
    }
}
