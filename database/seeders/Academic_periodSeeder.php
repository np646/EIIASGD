<?php

namespace Database\Seeders;

use App\Models\Academic_period;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Academic_periodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academic_periods = [
            [
                'period' => 'SEPTIEMBRE 2018 - ENERO 2019',
                'year' => '2018',
            ],
            [
                'period' => 'OCTUBRE 2024 - FEBRERO 2025',
                'year' => '2024',
            ],
        ];

        foreach ($academic_periods as $academic_periodData) {
            Academic_period::create($academic_periodData);
        }
    }
}
