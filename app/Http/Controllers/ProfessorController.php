<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfessorController extends Controller
{
    public function index()
    {
        $professors = Professor::all();
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
    { //TODO: Get update working from students
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:professors,email,' . $professor->id,
            'age' => 'required|integer'
        ]);

        $professor->update($request->all());
        return redirect()->route('professors.index');
    }

    public function destroy(Professor $professor)
    {
        $professor->delete();
        return redirect()->route('professors.index');
    }
}
