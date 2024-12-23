<?php

namespace Database\Seeders;

use App\Models\ThesisArea;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ThesisAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $thesisAreas = [
            [
                'area' => 'DOMÓTICA Y COMUNICACIONES',
            ],
            [
                'area' => 'CULTURA ORGANIZACIONAL E INFORMÁTICA',
            ],
            [
                'area' => 'INGENIERÍA DE SOFTWARE, INNOVACIÓN Y EMPRENDIMIENTO EN TICS',
            ],
        ];

        foreach ($thesisAreas as $thesisAreasData) {
            ThesisArea::create($thesisAreasData);
        }
    }
}
