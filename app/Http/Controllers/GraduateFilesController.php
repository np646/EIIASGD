<?php

namespace App\Http\Controllers;

use App\Models\GraduateFiles;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GraduateFilesController extends Controller
{
    public function index()
    {
        $graduateFiles = GraduateFiles::where('status', 1)->get();
        return Inertia::render('GraduateFiles/Index', [
            'graduateFiles' => $graduateFiles
        ]);
    }

    public function create()
    {
        return Inertia::render('GraduateFiles/Create');
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
        GraduateFiles::create($data);
        return redirect()->route('graduateFiles.index');
    }

    public function edit(GraduateFiles $graduateFile)
    {
        return Inertia::render('GraduateFiles/Edit', [
            'graduateFile' => $graduateFile
        ]);
    }

    public function update(Request $request, GraduateFiles $graduateFile)
    {
        $graduateFile->update($request->all());
        return redirect()->route('graduateFiles.index');
    }

    public function destroy(GraduateFiles $graduateFile)
    {
        $graduateFile->delete();
        return redirect()->route('graduateFiles.index');
    }

    public function remove(Request $request, GraduateFiles $graduateFile)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $graduateFile->update($request->only('status'));
        return redirect()->route('graduateFiles.index');
    }

    public function fetch()
    {
        $graduateFiles = GraduateFiles::where('status', 1)->get();
        return response()->json($graduateFiles);
    }
}
