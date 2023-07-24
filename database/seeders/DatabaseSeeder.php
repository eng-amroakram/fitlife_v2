<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            EquipmentSeeder::class,
            MuscleSeeder::class,
            GoalSeeder::class,
            FoodTypeSeeder::class,
            MeasurementUnitSeeder::class,
            FoodExchangeSeeder::class,
            RecipeSeeder::class,
            MealTypeSeeder::class,
            MealSeeder::class,
            MealPlanSeeder::class,

            // LevelSeeder::class,
            // ChallengeSeeder::class,
            // WorkoutSeeder::class,
            // ExerciseSeeder::class,
            SettingsSeeder::class,

        ]);
    }
}
