<?php

namespace App\Http\Controllers;

use App\Models\GraduationFiles;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class GraduationFilesController extends Controller
{
    public function studentFiles($student_id)
    {
        $studentController = new StudentController();
        $student = $studentController->fetchById($student_id);
        return Inertia::render('Graduation/Documents/Files', [
            'student' => $student
        ]);
    }
    public function apiStudentFiles($student_id)
    {
        $files = GraduationFiles::where('student_id', $student_id)->first();
        $fileArray = json_decode($files, true);

        $files = [
            ["id" => 1, "file" => "Certificación internacional", "file_id" => $fileArray['international_cert_id']],
            ["id" => 2, "file" => "Certificación de inglés", "file_id" => $fileArray['english_cert_id']],
            ["id" => 3, "file" => "Certificación de prácticas de Vinculación", "file_id" => $fileArray['community_internship_id']],
            ["id" => 4, "file" => "Certificación de prácticas Preprofesionales", "file_id" => $fileArray['preprofessional_internship_id']],
            ["id" => 5, "file" => "Solicitud de modalidad de titulación", "file_id" => $fileArray['graduation_type_id']],
            ["id" => 6, "file" => "Solicitud de asignación de lectores", "file_id" => $fileArray['readers_id']],
            ["id" => 7, "file" => "Solicitud de aprobación de plan de titulación", "file_id" => $fileArray['plan_approval_id']],

        ];

        if (request()->wantsJson()) {
            return response()->json(['files' => $files]);
        }

        return back()->with(['files' => $files]);
    }

    public function storeFile(Request $request, $parentId)
    {
        $fileController = new FileController();
        $fileController->store($request, $parentId);
        $fileId = $fileController->getLastId();

        $graduationFile = GraduationFiles::where('student_id', $request['student_id'])->first();

        $file_column = $request['graduation_files_id'];

        switch ($file_column) {
            case 1:
                $graduationFile->international_cert_id = $fileId;
                break;
            case 2:
                $graduationFile->english_cert_id = $fileId;
                break;
            case 3:
                $graduationFile->community_internship_id = $fileId;
                break;
            case 4:
                $graduationFile->preprofessional_internship_id = $fileId;
                break;
            case 5:
                $graduationFile->graduation_type_id = $fileId;
                break;
            case 6:
                $graduationFile->readers_id = $fileId;
                break;
            case 7:
                $graduationFile->plan_approval_id = $fileId;
                break;
        };

        $graduationFile->save();
    }

    public function fetchByStudentId($student_id)
    {
        return GraduationFiles::find($student_id);
    }

    //Statistics module
    public function getSentDocummentation()
    {
        $query = GraduationFiles::whereNot('graduations.status', 2)
            ->join('graduations', 'graduations.student_id', '=', 'graduation_files.student_id')
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->select(
                'graduations.id',
                'graduations.student_id',
                'graduation_files.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
            )
            ->get();

        $query->each(function ($item) {
            $item->int_cert_is_null = is_null($item->international_cert_id) ? true : false;
            $item->english_cert_is_null = is_null($item->english_cert_id) ? true : false;
            $item->community_cert_is_null = is_null($item->community_internship_id) ? true : false;
            $item->prep_cert_is_null = is_null($item->preprofessional_internship_id) ? true : false;
            $item->grad_type_is_null = is_null($item->graduation_type_id) ? true : false;
            $item->readers_is_null = is_null($item->readers_id) ? true : false;
            $item->plan_approval_is_null = is_null($item->plan_approval_id) ? true : false;
        });

        return response()->json($query);
    }
}
