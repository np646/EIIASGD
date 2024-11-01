<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'name' => 'EST1 NOMBRE',
                'lastname' => 'EST1 APELLIDO',
                'date_of_birth' => '1995-05-05',
                'identification' => '1001234564',
                'sex' => '0',
                'email' => 'est1@example.com',
                'banner_code' => 'EST001',
                'course_id' => '2',
                'academic_period_start_id' => '2'
            ],
            [
                'name' => 'EST2 NOMBRE',
                'lastname' => 'EST2 APELLIDO',
                'date_of_birth' => '2001-06-05',
                'identification' => '1001234565',
                'sex' => '1',
                'email' => 'est2@example.com',
                'banner_code' => 'EST002',
                'course_id' => '2',
                'academic_period_start_id' => '2'
            ],
            [
                'name' => 'EST3 NOMBRE',
                'lastname' => 'EST3 APELLIDO',
                'date_of_birth' => '1998-07-06',
                'identification' => '1001234566',
                'sex' => '1',
                'email' => 'est3@example.com',
                'banner_code' => 'EST003',
                'course_id' => '1',
                'academic_period_start_id' => '2'
            ],

        ];

        foreach ($students as $studentData) {
            Student::create($studentData);
        }
    }
}
