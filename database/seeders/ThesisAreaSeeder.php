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
                'area' => 'SOFTWARE',
            ],
            [
                'area' => 'INTERNET DE LAS COSAS',
            ],
            [
                'area' => 'CYBERSEGURIDAD',
            ],
        ];

        foreach ($thesisAreas as $thesisAreasData) {
            ThesisArea::create($thesisAreasData);
        }
    }
}
