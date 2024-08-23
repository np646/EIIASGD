<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentThesesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentTheses = [
            [
                'student_course_id' => 1,
                'thesis_name' => 'TESIS1 NOMBRE',
                'thesis_area_id' => 2,
                'advisor_professor_id' => 1,
                'reader1_professor_id' => 2,
                'reader2_professor_id' => 3,
            ],
        ];

        DB::table('student_theses')->insert($studentTheses);
    }
}
