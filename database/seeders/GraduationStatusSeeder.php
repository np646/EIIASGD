<?php

namespace Database\Seeders;
use App\Models\GraduationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GraduationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                'name' => 'SIN INICIAR',
            ],
            [
                'name' => 'ACTIVO',
            ],
            [
                'name' => 'GRADUADO',
            ],
            [
                'name' => 'SIN TERMINAR',
            ],
        ];

        foreach ($status as $statusData) {
            GraduationStatus::create($statusData);
        }
    }
}
