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
        $query = PreprofessionalInternship::where('students.status', 1)
            ->join('students', 'preprofessional_internships.student_id', '=', 'students.id')
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
            ["id" => 1, "file" => "Certificado externo", "file_id" => $fileArray['external_cert_id']],
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
        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();

        return Inertia::render('Internships/Preprofessional/Documents/Periods', [
            'periods' => $periods
        ]);
    }

    public function studentsInPeriod($period_id)
    {
        $query = PreprofessionalInternship::where('students.status', 1)
            ->where('preprofessional_internships.academic_period_id', $period_id)
            ->join('students', 'preprofessional_internships.student_id', '=', 'students.id')
            ->select(
                'preprofessional_internships.id',
                'preprofessional_internships.student_id',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
            )
            ->orderBy('preprofessional_internships.status', 'asc')
            ->get();
        return Inertia::render('Internships/Preprofessional/Documents/StudentsInPeriod', [
            'students' => $query
        ]);
    }

    public function fetchByStudentId($student_id)
    {
        return PreprofessionalInternship::find($student_id);
    }

    public function storeFile(Request $request, $parentId)
    {
        $fileController = new FileController();
        $fileController->store($request, $parentId);
        $fileId = $fileController->getLastId();

        $preprofessionalFile = PreprofessionalInternship::where('student_id', $request['student_id'])->first();

        $file_column = $request['preprofessional_files_id'];

        switch ($file_column) {
            case 1:
                $preprofessionalFile->external_cert_id = $fileId;
                break;
            case 2:
                $preprofessionalFile->student_report_id = $fileId;
                break;
            case 3:
                $preprofessionalFile->banner_cert_id = $fileId;
                break;
        };

        $preprofessionalFile->save();
    }

    public function fetchById($student_id)
    {
        $query = PreprofessionalInternship::where('student_id', $student_id)
            ->leftJoin('students', 'preprofessional_internships.student_id', '=', 'students.id')
            ->leftJoin('academic_periods', 'preprofessional_internships.academic_period_id', '=', 'academic_periods.id')
            ->leftJoin('internship_statuses', 'preprofessional_internships.status', '=', 'internship_statuses.id')
            ->select(
                'preprofessional_internships.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student_name"),
                'academic_periods.period AS academic_period',
                'internship_statuses.name as status_name'
            )
            ->first();
        return $query;
    }

    public function preprofessional($student_id)
    {
        $query = $this->fetchById($student_id);

        return Inertia::render('Internships/Preprofessional/Process/Index', [
            'process' => $query
        ]);
    }

    public function edit($student_id)
    {
        $process = $this->fetchById($student_id);

        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();

        $statusController = new InternshipStatusController();
        $statuses = $statusController->fetch();

        return Inertia::render('Internships/Preprofessional/Process/Edit', [
            'process' => $process,
            'periods' => $periods,
            'statuses' => $statuses
        ]);
    }

    public function updateProcess(Request $request, $student_id)
    {
        $process = $this->fetchById($student_id);
        $process->update($request->all());
        return redirect()->route('preprofessional.process', ['student' => $student_id]);
    }

    public function getSentDocumentation($id)
    {
        $query = PreprofessionalInternship::where('preprofessional_internships.academic_period_id', '=', $id)
            ->join('students', 'preprofessional_internships.student_id', '=', 'students.id')
            ->select(
                'preprofessional_internships.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
            )
            ->get();

        $query->each(function ($item) {
            $item->external_cert_is_null = !is_null($item->external_cert_id) ? true : false;
            $item->student_report_is_null = !is_null($item->student_report_id) ? true : false;
            $item->banner_cert_is_null = !is_null($item->banner_cert_id) ? true : false;
        });

        return response()->json($query);
    }

    public function getProcessStatus($id)
    {
        $query = PreprofessionalInternship::where('students.status', 1)
            ->where('preprofessional_internships.academic_period_id', '=', $id)
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->join('academic_periods', 'graduations.academic_period_end_id', '=', 'academic_periods.id')
            ->join('internship_statuses', 'preprofessional_internships.status', '=', 'internship_statuses.id')
            ->select(
                'preprofessional_internships.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
                'academic_periods.period AS academic_period',
                'internship_statuses.name as status_name'
            )
            ->get();
        return response()->json($query);
    }
}
