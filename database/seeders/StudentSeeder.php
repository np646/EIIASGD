<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * DATOS FALSOS PARA PRUEBAS
     */
    public function run(): void
    {
        $students = [
            [
                'name' => 'MARÍA JOSÉ',
                'lastname' => 'DOMINGUEZ GUERRA',
                'date_of_birth' => '1995-05-05',
                'identification' => '2477684319',
                'sex' => '0',
                'email' => 'mjdominguez@pucesi.edu.ec',
                'banner_code' => 'EST001',
                'course_id' => '2',
            ],
            [
                'name' => 'JUAN DANIEL',
                'lastname' => 'PRADO GONZALEZ',
                'date_of_birth' => '2001-06-05',
                'identification' => '2133371320',
                'sex' => '1',
                'email' => 'jdprado@pucesi.edu.ec',
                'banner_code' => 'EST002',
                'course_id' => '2',
            ],
            [
                'name' => 'JOSÉ EMILIO',
                'lastname' => 'PEREZ SUAREZ',
                'date_of_birth' => '1998-07-06',
                'identification' => '2200533405',
                'sex' => '1',
                'email' => 'jmperez@pucesi.edu.ec',
                'banner_code' => 'EST003',
                'course_id' => '1',
            ],
            [
                'name' => 'JUAN CARLOS',
                'lastname' => 'SORIA GARCÍA',
                'date_of_birth' => '1999-08-16',
                'identification' => '2415208589',
                'sex' => '1',
                'email' => 'jcgarcia@pucesi.edu.ec',
                'banner_code' => 'EST004',
                'course_id' => '2',
            ],
            [
                'name' => 'MAURICIO HECTOR',
                'lastname' => 'GUTIERREZ GÓMEZ',
                'date_of_birth' => '1998-02-14',
                'identification' => '0561106595',
                'sex' => '1',
                'email' => 'mhgutierrez@pucesi.edu.ec',
                'banner_code' => 'EST005',
                'course_id' => '2',
            ],
            [
                'name' => 'JUANA ALICIA',
                'lastname' => 'ÁLVAREZ GARCÍA',
                'date_of_birth' => '2002-05-24',
                'identification' => '2351707260',
                'sex' => '0',
                'email' => 'jaalvarez@pucesi.edu.ec',
                'banner_code' => 'EST006',
                'course_id' => '2',
            ],
            [
                'name' => 'CLAUDIA GRACIELA',
                'lastname' => 'JIMENEZ FERNANDEZ',
                'date_of_birth' => '2001-10-07',
                'identification' => '1138994193',
                'sex' => '0',
                'email' => 'cgjimenez@pucesi.edu.ec',
                'banner_code' => 'EST007',
                'course_id' => '2',
            ],
            [
                'name' => 'SERGIO HORACIO',
                'lastname' => 'RUIZ SOSA',
                'date_of_birth' => '2000-10-17',
                'identification' => '0291969565',
                'sex' => '1',
                'email' => 'shruiz@pucesi.edu.ec',
                'banner_code' => 'EST008',
                'course_id' => '2',
            ],
            [
                'name' => 'JUAN ANTONIO',
                'lastname' => 'SÁNCHEZ GUZMÁN',
                'date_of_birth' => '1999-11-15',
                'identification' => '1985182916',
                'sex' => '1',
                'email' => 'jasanchez@pucesi.edu.ec',
                'banner_code' => 'EST009',
                'course_id' => '2',
            ],
            [
                'name' => 'JOSÉ FRANCISCO',
                'lastname' => 'LÓPEZ CASTRO',
                'date_of_birth' => '2001-06-15',
                'identification' => '2490611003',
                'sex' => '1',
                'email' => 'jflopez@pucesi.edu.ec',
                'banner_code' => 'EST010',
                'course_id' => '3',
            ],

        ];

        foreach ($students as $studentData) {
            Student::create($studentData);
        }
    }
}
