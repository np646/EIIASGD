<?php

namespace App\Http\Controllers;

use App\Models\GraduationFile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GraduationFileController extends Controller
{
    public function index()
    {
        $graduationFiles = GraduationFile::where('status', 1)->get();
        return Inertia::render('GraduationFiles/Index', [
            'graduationFiles' => $graduationFiles
        ]);
    }

    public function create()
    {
        return Inertia::render('GraduationFile/Create');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'student_id' => $params['student_id'],
            'international_cert_path' => $params['international_cert_path'],
            'english_cert_path' => $params['english_cert_path'],
            'community_internship_path' => $params['community_internship_path'],
            'preprofessional_internship_path' => $params['preprofessional_internship_path'],
            'graduation_type_path' => $params['graduation_type_path'],
            'readers_path' => $params['readers_path'],
            'plan_approval_path' => $params['plan_approval_path'],
            'status' => $params['status']
        ];
        GraduationFile::create($data);
        return redirect()->route('graduationFiles.index');
    }

    public function edit(GraduationFile $graduationFile)
    {
        return Inertia::render('GraduationFiles/Edit', [
            'graduationFile' => $graduationFile
        ]);
    }

    public function update(Request $request, GraduationFile $graduationFile)
    {
        $graduationFile->update($request->all());
        return redirect()->route('graduationFiles.index');
    }

    public function destroy(GraduationFile $graduationFile)
    {
        $graduationFile->delete();
        return redirect()->route('graduationFiles.index');
    }

    public function remove(Request $request, GraduationFile $graduationFile)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $graduationFile->update($request->only('status'));
        return redirect()->route('graduationFiles.index');
    }

    public function fetch()
    {
        $graduationFiles = GraduationFile::where('status', 1)->get();
        return response()->json($graduationFiles);
    }
}
