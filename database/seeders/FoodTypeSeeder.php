<?php

namespace Database\Seeders;

use App\Models\FoodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $food_types = config('data.Seeders.food-types');
        foreach ($food_types as $title_ar => $title_en) {
            FoodType::create([
                'title_ar' => $title_ar,
                'title_en' => $title_en,
                'status' => 'active',
                'image' => "",
            ]);
        }
    }
}
