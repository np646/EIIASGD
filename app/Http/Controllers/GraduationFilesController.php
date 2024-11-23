<?php

namespace App\Http\Controllers;

use App\Models\GraduationFiles;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\DB;

class GraduationFilesController extends Controller
{
    public function index()
    {
        $graduationFiles = GraduationFiles::where('status', 1)->get();
        return Inertia::render('GraduationFiles/Index', [
            'graduationFiles' => $graduationFiles
        ]);
    }

    public function create()
    {
        return Inertia::render('GraduationFiles/Create');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'student_id' => $params['student_id'],
            'international_cert_id' => $params['international_cert_id'],
            'english_cert_id' => $params['english_cert_id'],
            'community_internship_id' => $params['community_internship_id'],
            'preprofessional_internship_id' => $params['preprofessional_internship_id'],
            'graduation_type_id' => $params['graduation_type_id'],
            'readers_id' => $params['readers_id'],
            'plan_approval_id' => $params['plan_approval_id'],
        ];
        GraduationFiles::create($data);
        return redirect()->route('graduateFiles.index');
    }

    public function edit(GraduationFiles $graduationFile)
    {
        return Inertia::render('GraduationFiles/Edit', [
            'graduationFile' => $graduationFile
        ]);
    }

    public function update(Request $request, GraduationFiles $graduationFile)
    {
        $graduationFile->update($request->all());
        return redirect()->route('graduationFiles.index');
    }

    public function destroy(GraduationFiles $graduateFile)
    {
        $graduateFile->delete();
        return redirect()->route('graduateFiles.index');
    }

    public function remove(Request $request, GraduationFiles $graduationFile)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $graduationFile->update($request->only('status'));
        return redirect()->route('graduationFiles.index');
    }

    public function studentFiles($student_id)
    {
        $files = GraduationFiles::where('student_id', $student_id)->get();
        $studentController = new StudentController();
        $student = $studentController->fetchById($student_id);
        return Inertia::render('Graduation/Documents/Files', [
            'files' => $files,
            'student' => $student
        ]);
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
}
