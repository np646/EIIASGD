<?php

namespace Database\Seeders;

use App\Models\Thesis_area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Thesis_areaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $thesis_areas = [
            [
                'area' => 'SOFTWARE',
            ],
            [
                'area' => 'INTERNET DE LAS COSAS',
            ],
            [
                'area' => 'CYBERSEGURIDAD',
            ],
        ];

        foreach ($thesis_areas as $thesis_areasData) {
            Thesis_area::create($thesis_areasData);
        }
    }
}
