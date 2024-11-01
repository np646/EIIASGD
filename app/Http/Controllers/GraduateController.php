<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GraduateController extends Controller
{
    public function index()
    {
        $graduationTypes = Graduate::where('status', 1)->get();
        return Inertia::render('Graduates/Index', [
            'graduates' => $graduationTypes
        ]);
    }

    public function create()
    {
        return Inertia::render('Graduate/Create');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'student_id' => $params['student_id'],
            'academic_period_start_id' => $params['academic_period_start_id'],
            'plan_approval_date' => $params['plan_approval_date'],
            'graduation_type' => $params['graduation_type'],
            'thesis_name' => $params['thesis_name'],
            'thesis_area' => $params['thesis_area'],
            'advisor_id' => $params['advisor_id'],
            'academic_period_end_id' => $params['academic_period_end_id'],
            'reader1_id' => $params['reader1_id'],
            'reader2_id' => $params['reader2_id'],
            'graduation_date' => $params['graduation_date'],
            'registration_times' => $params['registration_times'],
            'status' => $params['status']
        ];
        Graduate::create($data);
        return redirect()->route('graduates.index');
    }

    public function edit(Graduate $graduate)
    {
        return Inertia::render('Graduates/Edit', [
            'graduate' => $graduate
        ]);
    }

    public function update(Request $request, Graduate $graduate)
    {
        $graduate->update($request->all());
        return redirect()->route('graduates.index');
    }

    public function destroy(Graduate $graduate)
    {
        $graduate->delete();
        return redirect()->route('graduates.index');
    }

    public function remove(Request $request, Graduate $graduate)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $graduate->update($request->only('status'));
        return redirect()->route('graduates.index');
    }

    public function fetch()
    {
        $graduates = Graduate::where('status', 1)->get();
        return response()->json($graduates);
    }
}
