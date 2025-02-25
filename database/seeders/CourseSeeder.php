<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'INGENIERÍA EN SISTEMAS',
                'banner_code' => 'C001',
            ],
            [
                'name' => 'INGENIERÍA EN TECNOLOGÍAS DE LA INFORMACIÓN',
                'banner_code' => 'C002',
            ],
            [
                'name' => 'INGENIERÍA EN SOFTWARE',
                'banner_code' => 'C003',
            ],
        ];

        foreach ($courses as $courseData) {
            Course::create($courseData);
        }
    }
}
