<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentCourses = [
            [
                'student_id' => 1,
                'course_id' => 2,
                'academic_period_start_id' => 1,
                'academic_period_end_id' => 2,
                'status_p_profesionales' => 1,
                'status_p_vinculacion' => 1,
                'status_titulacion' => 0,
            ],
        ];

        DB::table('student_courses')->insert($studentCourses);
    }
}
