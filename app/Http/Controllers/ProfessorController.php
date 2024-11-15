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
        $graduationController = new GraduationController();
        $processes = $graduationController->professorProcesses($professor->id);
        return Inertia::render('Professors/Profile', [
            'professor' => $professor,
            'processes' => $processes
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
        $professors = Professor::where('status', 1)
        ->select('id', DB::raw("CONCAT(lastname, ' ', name) AS name"))
        ->get();
        return $professors;
    }
}
