<?php

namespace Database\Seeders;

use App\Models\InternshipStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternshipStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'SIN INICIAR',
            ],
            [
                'name' => 'ACTIVO',
            ],
            [
                'name' => 'REPROBADO',
            ],
            [
                'name' => 'APROBADO',
            ],
        ];

        foreach ($statuses as $statusData) {
            InternshipStatus::create($statusData);
        }
    }
}
