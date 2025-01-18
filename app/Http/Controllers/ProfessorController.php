<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'date_of_birth' => 'required|string',
            'identification' => 'required|string|unique:professors',
            'email' => 'required|email|unique:professors',
            'banner_code' => 'required|string|unique:professors',
            'sex' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $params = $request->all();
        $data = [
            'name' => $params['name'],
            'lastname' => $params['lastname'],
            'date_of_birth' => $params['date_of_birth'],
            'identification' => $params['identification'],
            'email' => $params['email'],
            'banner_code' => $params['banner_code'],
            'sex' => $params['sex']
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'date_of_birth' => 'required|string',
            'identification' => [
                'required',
                'string',
                Rule::unique('professors')->ignore($professor->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('professors')->ignore($professor->id),
            ],
            'banner_code' => [
                'required',
                'string',
                Rule::unique('professors')->ignore($professor->id),
            ],
            'sex' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $professor->update($request->all());
        return redirect()->route('professors.index');
    }

    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();
        return response()->json(null, 204);
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


    public function remove($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->update(['status' => 0]);
        return response()->json(null, 204);
    }


    public function fetch()
    {
        $professors = Professor::where('status', 1)
            ->select('id', DB::raw("CONCAT(lastname, ' ', name) AS name"))
            ->get();
        return $professors;
    }
    public function fetchById($id)
    {
        $professors = Professor::where('id', $id)
            ->select('id', DB::raw("CONCAT(lastname, ' ', name) AS name"))
            ->first();
        return response()->json($professors);
    }

    public function apiIndex()
    {
        return response()->json(Professor::where('status', 1)->get());
    }
}
