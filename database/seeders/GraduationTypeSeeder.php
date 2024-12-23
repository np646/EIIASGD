<?php

namespace Database\Seeders;

use App\Models\GraduationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GraduationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'type' => 'PROYECTO DE INVESTIGACIÓN',
            ],
            [
                'type' => 'EXAMEN COMPLEXIVO',
            ],
        ];

        foreach ($types as $typeData) {
            GraduationType::create($typeData);
        }
    }
}
