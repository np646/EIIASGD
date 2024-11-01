<?php

namespace Database\Seeders;

use App\Models\Professor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $professors = [
            [
                'name' => 'PROF1 NOMBRE',
                'lastname' => 'PROF1 APELLIDO',
                'date_of_birth' => '1981-01-01',
                'identification' => '1001234561',
                'email' => 'prof1@example.com',
                'banner_code' => 'P001',
                'sex' => '1',
            ],
            [
                'name' => 'PROF2 NOMBRE',
                'lastname' => 'PROF2 APELLIDO',
                'date_of_birth' => '1975-01-01',
                'identification' => '1001234562',
                'email' => 'prof2@example.com',
                'banner_code' => 'P002',
                'sex' => '1',
            ],
            [
                'name' => 'PROF3 NOMBRE',
                'lastname' => 'PROF3 APELLIDO',
                'date_of_birth' => '1981-01-01',
                'identification' => '1001234563',
                'email' => 'prof3@example.com',
                'banner_code' => 'P003',
                'sex' => '0',
            ],
        ];

        foreach ($professors as $professorData) {
            Professor::create($professorData);
        }
    }
}
