<?php

namespace Database\Seeders;

use App\Models\MealPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meal_plans = config('data.Seeders.meal-plans');

        foreach ($meal_plans as $meal_plan) {
            MealPlan::create($meal_plan);
        }
    }
}
