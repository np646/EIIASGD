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
                'period' => 'ABRIL 2017 - AGOSTO 2017',
                'year' => '2017',
            ],
            [
                'period' => 'SEPTIEMBRE 2017 - ENERO 2018',
                'year' => '2017',
            ],
            [
                'period' => 'ABRIL 2018 - JULIO 2018',
                'year' => '2018',
            ],
            [
                'period' => 'SEPTIEMBRE 2018 - ENERO 2019',
                'year' => '2018',
            ],
            [
                'period' => 'ABRIL 2019 - AGOSTO 2019',
                'year' => '2019',
            ],
            [
                'period' => 'SEPTIEMBRE 2019 - ENERO 2020',
                'year' => '2019',
            ],
            [
                'period' => 'MAYO 2020 - AGOSTO 2020',
                'year' => '2020',
            ],
            [
                'period' => 'SEPTIEMBRE 2020 - ENERO 2021',
                'year' => '2020',
            ],
            [
                'period' => 'ABRIL 2021 - AGOSTO 2021',
                'year' => '2021',
            ],
            [
                'period' => 'SEPTIEMBRE 2021 - ENERO 2022',
                'year' => '2021',
            ],
            [
                'period' => 'ABRIL 2022 - AGOSTO 2022',
                'year' => '2022',
            ],
            [
                'period' => 'OCTUBRE 2022 - FEBRERO 2023',
                'year' => '2022',
            ],
            [
                'period' => 'MAYO 2023 - AGOSTO 2023',
                'year' => '2023',
            ],
            [
                'period' => 'OCTUBRE 2023 - FEBRERO 2024',
                'year' => '2023',
            ],
            [
                'period' => 'MARZO 2024 - JULIO 2024',
                'year' => '2024',
            ],
            [
                'period' => 'SEPTIEMBRE 2024 - FEBRERO 2025',
                'year' => '2024',
            ],
        ];

        foreach ($academicPeriods as $academicPeriodData) {
            AcademicPeriod::create($academicPeriodData);
        }
    }
}
