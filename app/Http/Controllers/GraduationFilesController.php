<?php

namespace App\Http\Controllers;

use App\Models\GraduationFiles;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

    public function fetch()
    {
        $graduationFiles = GraduationFiles::where('status', 1)->get();
        return response()->json($graduationFiles);
    }
}
