<?php

namespace Database\Seeders;

use App\Models\FoodExchange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fruits = config('data.Seeders.food.fruits');

        foreach ($fruits as $fruit => $quantity) {
            FoodExchange::create([
                'food_type_id' => 1,
                'measurement_unit_ids' => [],
                'image' => '',
                'title_ar' => __($fruit),
                'title_en' => $fruit,
                'quantity' => $quantity,
                'status' => 'active'
            ]);
        }

        $vegetables = config('data.Seeders.food.vegetables');

        foreach ($vegetables as $vegetable => $quantity) {
            FoodExchange::create([
                'food_type_id' => 2,
                'measurement_unit_ids' => [],
                'image' => '',
                'title_ar' => __($vegetable),
                'title_en' => $vegetable,
                'quantity' => $quantity,
                'status' => 'active'
            ]);
        }
    }
}
