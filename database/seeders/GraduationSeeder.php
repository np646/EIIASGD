<?php

namespace Database\Seeders;

use App\Models\Graduation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GraduationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $graduations = [
            [
                'student_id' => '1',
                'academic_period_start_id' => '7',
                'plan_approval_date' => '2023-03-29',
                'graduation_type' => '1',
                'thesis_name' => '"APLICACIÓN WEB DE FACTURACIÓN"',
                'thesis_area' => '3',
                'advisor_id' => '2',
                'academic_period_end_id' => '14',
                'reader1_id' => '1',
                'reader2_id' => '7',
                'graduation_date' => '2023-11-30',
                'registration_times' => '1',
            ],
            [
                'student_id' => '2',
                'academic_period_start_id' => '10',
                'plan_approval_date' => '2023-10-12',
                'graduation_type' => '1',
                'thesis_name' => '"PROTOTIPO IOT"',
                'thesis_area' => '1',
                'advisor_id' => '1',
                'academic_period_end_id' => '15',
                'reader1_id' => '7',
                'reader2_id' => '4',
                'graduation_date' => '2023-05-20',
                'registration_times' => '1',
            ],
            [
                'student_id' => '3',
                'academic_period_start_id' => '2',
                'plan_approval_date' => '2020-11-02',
                'graduation_type' => '1',
                'thesis_name' => '"APLICACIÓN MÓVIL DE DELIVERY"',
                'thesis_area' => '3',
                'advisor_id' => '8',
                'academic_period_end_id' => '12',
                'reader1_id' => '6',
                'reader2_id' => '5',
                'graduation_date' => '2021-11-05',
                'registration_times' => '3',
            ],
            [
                'student_id' => '4',
                'academic_period_start_id' => '10',
                'plan_approval_date' => '2023-10-15',
                'graduation_type' => '1',
                'thesis_name' => '"PROTOTIPO IOT PARA MONITOREO"',
                'thesis_area' => '1',
                'advisor_id' => '3',
                'academic_period_end_id' => '15',
                'reader1_id' => '4',
                'reader2_id' => '6',
                'graduation_date' => '2023-05-22',
                'registration_times' => '1',
            ],
            [
                'student_id' => '5',
                'academic_period_start_id' => '6',
                'plan_approval_date' => '2022-10-13',
                'graduation_type' => '1',
                'thesis_name' => '"AUDITORÍA A LA EMPRESA XYZ"',
                'thesis_area' => '2',
                'advisor_id' => '2',
                'academic_period_end_id' => '12',
                'reader1_id' => '5',
                'reader2_id' => '6',
                'graduation_date' => '2023-03-01',
                'registration_times' => '1',
            ],
            [
                'student_id' => '6',
                'academic_period_start_id' => '10',
                'plan_approval_date' => '2023-10-13',
                'graduation_type' => '1',
                'thesis_name' => '"APLICACIÓN WEB DE SEGUIMIENTO"',
                'thesis_area' => '3',
                'advisor_id' => '4',
                'academic_period_end_id' => '15',
                'reader1_id' => '7',
                'reader2_id' => '3',
                'graduation_date' => '2024-02-10',
                'registration_times' => '1',
            ],
            [
                'student_id' => '7',
                'academic_period_start_id' => '4',
                'plan_approval_date' => '2022-07-12',
                'graduation_type' => '1',
                'thesis_name' => '"AUDITORÍA A LA EMPRESA ABC"',
                'thesis_area' => '2',
                'advisor_id' => '1',
                'academic_period_end_id' => '12',
                'reader1_id' => '2',
                'reader2_id' => '5',
                'graduation_date' => '2023-07-13',
                'registration_times' => '2',
            ],
            [
                'student_id' => '8',
                'academic_period_start_id' => '6',
                'plan_approval_date' => '2022-10-15',
                'graduation_type' => '1',
                'thesis_name' => '"PROTOTIPO IOT PARA SEGUIMIENTO"',
                'thesis_area' => '1',
                'advisor_id' => '2',
                'academic_period_end_id' => '13',
                'reader1_id' => '5',
                'reader2_id' => '4',
                'graduation_date' => null,
                'registration_times' => '2',
            ],
            [
                'student_id' => '9',
                'academic_period_start_id' => '10',
                'plan_approval_date' => '2023-10-17',
                'graduation_type' => '1',
                'thesis_name' => '"ANÁLISIS DE VULNERABILIDADES"',
                'thesis_area' => '2',
                'advisor_id' => '5',
                'academic_period_end_id' => '12',
                'reader1_id' => '6',
                'reader2_id' => '3',
                'graduation_date' => '2024-02-09',
                'registration_times' => '1',
            ],
            [
                'student_id' => '10',
                'academic_period_start_id' => null,
                'plan_approval_date' => null,
                'graduation_type' => null,
                'thesis_name' => null,
                'thesis_area' => null,
                'advisor_id' => null,
                'academic_period_end_id' => null,
                'reader1_id' => null,
                'reader2_id' => null,
                'graduation_date' => null,
                'registration_times' => null,
            ],
        ];

        foreach ($graduations as $graduationData) {
            Graduation::create($graduationData);
        }
    }
}
