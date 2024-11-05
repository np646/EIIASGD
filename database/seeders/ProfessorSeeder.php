<?php

namespace Database\Seeders;

use App\Models\Professor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * DATOS FALSOS PARA PRUEBAS
     */
    public function run(): void
    {
        $professors = [
            [
                'name' => 'MARCO ANTONIO',
                'lastname' => 'GONZÁLEZ GUZMÁN',
                'date_of_birth' => '1981-01-01',
                'identification' => '1079565607',
                'email' => 'magonzalez@pucesi.edu.ec',
                'banner_code' => 'P001',
                'sex' => '1',
            ],
            [
                'name' => 'JOSÉ RAFAEL',
                'lastname' => 'PÉREZ DÍAZ',
                'date_of_birth' => '1975-01-01',
                'identification' => '1962430202',
                'email' => 'jfperez@pucesi.edu.ec',
                'banner_code' => 'P002',
                'sex' => '1',
            ],
            [
                'name' => 'CARLA DANIELA',
                'lastname' => 'DOMINGUEZ DÍAZ',
                'date_of_birth' => '1981-05-12',
                'identification' => '1001234563',
                'email' => 'cddominguez@pucesi.edu.ec',
                'banner_code' => 'P003',
                'sex' => '0',
            ],
            [
                'name' => 'FERNANDO FRANCISCO',
                'lastname' => 'PÉREZ CASTRO',
                'date_of_birth' => '1979-11-27',
                'identification' => '0716327672',
                'email' => 'ffperez@pucesi.edu.ec',
                'banner_code' => 'P004',
                'sex' => '1',
            ],
            [
                'name' => 'JOSÉ MIGUEL',
                'lastname' => 'MARTÍNEZ SILVA',
                'date_of_birth' => '1969-10-12',
                'identification' => '0928245276',
                'email' => 'jmmartinez@pucesi.edu.ec',
                'banner_code' => 'P005',
                'sex' => '1',
            ],
            [
                'name' => 'RICARDO ALEJANDRO',
                'lastname' => 'RAMÍREZ MORALES',
                'date_of_birth' => '1967-07-22',
                'identification' => '1430735863',
                'email' => 'raramirez@pucesi.edu.ec',
                'banner_code' => 'P006',
                'sex' => '1',
            ],
            [
                'name' => 'JUAN ANTONIO',
                'lastname' => 'HERNÁNDEZ DÍAZ',
                'date_of_birth' => '1985-12-24',
                'identification' => '0457871931',
                'email' => 'jahernandez@pucesi.edu.ec',
                'banner_code' => 'P007',
                'sex' => '1',
            ],
            [
                'name' => 'ANA LUCÍA',
                'lastname' => 'HERNÁNDEZ SILVA',
                'date_of_birth' => '1984-03-09',
                'identification' => '0452914961',
                'email' => 'alhernandez@pucesi.edu.ec',
                'banner_code' => 'P008',
                'sex' => '0',
            ],
        ];

        foreach ($professors as $professorData) {
            Professor::create($professorData);
        }
    }
}
