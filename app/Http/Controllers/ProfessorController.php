<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProfessorController extends Controller
{
    public function index()
    {
        $professors = Professor::where('status', 1)->get();
        return Inertia::render('Professors/Index', [
            'professors' => $professors
        ]);
    }

    public function create()
    {
        return Inertia::render('Professors/Create');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'name' => $params['name'],
            'lastname' => $params['lastname'],
            'date_of_birth' => $params['date_of_birth'],
            'identification' => $params['identification'],
            'email' => $params['email'],
            'banner_code' => $params['banner_code'],
            'sex' => $params['sex'],
            'status' => $params['status']
        ];
        Professor::create($data);
        return redirect()->route('professors.index');
    }

    public function edit(Professor $professor)
    {
        return Inertia::render('Professors/Edit', [
            'professor' => $professor
        ]);
    }

    public function update(Request $request, Professor $professor)
    {
        $professor->update($request->all());
        return redirect()->route('professors.index');
    }

    public function destroy(Professor $professor)
    {
        $professor->delete();
        return redirect()->route('professors.index');
    }

    public function profile(Professor $professor)
    {
        return Inertia::render('Professors/Profile', [
            'professor' => $professor
        ]);
    }

    public function remove(Request $request, Professor $professor)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $professor->update($request->only('status'));
        return redirect()->route('professors.index');
    }

    public function fetch()
    {
        $professors = Professor::where('status', 1)->get();
        return response()->json($professors);
    }

    public function advisors()
    {
        //TODO: get this logic working in the other modules
        $query = DB::table('graduates')
        ->whereNotNull('advisor_id')
        ->join('students', 'graduates.student_id', '=', 'students.id')
        ->join('academic_periods AS start_period', 'graduates.academic_period_start_id', '=', 'start_period.id')
        ->join('academic_periods AS end_period', 'graduates.academic_period_end_id', '=', 'end_period.id')
        ->join('professors', 'graduates.advisor_id', '=', 'professors.id')
        ->select(
            'graduates.*',
            DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
            'start_period.period AS start_period',
            'end_period.period AS end_period',
            DB::raw("CONCAT(professors.lastname, ' ', professors.name) AS professor")
        )
        ->get();
    

        return Inertia::render('Graduation/Advisors', [
            'advisors' => $query
        ]);
    }
}
