<?php

namespace Database\Seeders;

use App\Models\AcademicPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AcademicPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicPeriods = [
            [
                'period' => 'SEPTIEMBRE 2018 - ENERO 2019',
                'year' => '2018',
            ],
            [
                'period' => 'OCTUBRE 2024 - FEBRERO 2025',
                'year' => '2024',
            ],
        ];

        foreach ($academicPeriods as $academicPeriodData) {
            AcademicPeriod::create($academicPeriodData);
        }
    }
}
