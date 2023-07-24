<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipments = config('data.Seeders.equipment');

        app()->setLocale('ar');

        foreach ($equipments as $equipment) {
            Equipment::create([
                'image' => "",
                'title_ar' => __("$equipment"),
                'title_en' => $equipment,
                'status' => 'active',
            ]);
        }
    }
}
