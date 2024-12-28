<?php

namespace App\Http\Controllers;

use App\Models\PreprofessionalInternship;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PreprofessionalController extends Controller
{
    public function store($student_id)
    {
        $data = [
            'student_id' => $student_id,
        ];
        PreprofessionalInternship::create($data);
    }
    public function students()
    {
        $query = PreprofessionalInternship::join('students', 'preprofessional_internships.student_id', '=', 'students.id')
            ->join('internship_statuses', 'preprofessional_internships.status', '=', 'internship_statuses.id')
            ->select(
                'preprofessional_internships.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
                'internship_statuses.name as status_name'
            )
            ->get();

        return Inertia::render('Internships/Preprofessional/Students', [
            'students' => $query
        ]);
    }

    public function studentFiles($student_id)
    {
        $studentController = new StudentController();
        $student = $studentController->fetchById($student_id);
        return Inertia::render('Internships/Preprofessional/Documents/Files', [
            'student' => $student
        ]);
    }

    public function apiPreprofessionalFiles($student_id)
    {
        $files = PreprofessionalInternship::where('student_id', $student_id)->first();
        $fileArray = json_decode($files, true);

        $files = [
            ["id" => 1, "file" => "Certificado externo", "file_id" => $fileArray['external_report_id']],
            ["id" => 2, "file" => "Informe del estudiante", "file_id" => $fileArray['student_report_id']],
            ["id" => 3, "file" => "Certificado de Banner", "file_id" => $fileArray['banner_cert_id']],
        ];

        if (request()->wantsJson()) {
            return response()->json(['files' => $files]);
        }

        return back()->with(['files' => $files]);
    }

    public function periods()
    {
        return Inertia::render('Internships/Preprofessional/Documents/Periods');
    }

    public function studentsInPeriod($period_id)
    {
        return Inertia::render('Internships/Preprofessional/Documents/StudentsInPeriod');
    }

    public function projects()
    {
        return Inertia::render('Internships/Preprofessional/Projects/Index');
    }
}
