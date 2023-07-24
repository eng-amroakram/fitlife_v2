<?php

namespace Database\Seeders;

use App\Models\MeasurementUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasurementUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $measurement_units = config('data.Seeders.measurement-units');
        foreach ($measurement_units as $ar => $en) {
            MeasurementUnit::create([
                'title_ar' => $ar,
                'title_en' => $en,
            ]);
        }
    }
}
