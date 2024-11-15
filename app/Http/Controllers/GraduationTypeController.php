<?php

namespace App\Http\Controllers;

use App\Models\GraduationType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GraduationTypeController extends Controller
{
    public function index()
    {
        $graduationTypes = GraduationType::where('status', 1)->get();
        return Inertia::render('GraduationTypes/Index', [
            'graduationTypes' => $graduationTypes
        ]);
    }

    public function create()
    {
        return Inertia::render('GraduationTypes/Create');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'type' => $params['type'],
            'status' => $params['status']
        ];
        GraduationType::create($data);
        return redirect()->route('graduationTypes.index');
    }

    public function edit(GraduationType $graduationType)
    {
        return Inertia::render('GraduationTypes/Edit', [
            'graduationType' => $graduationType
        ]);
    }

    public function update(Request $request, GraduationType $graduationType)
    {
        $graduationType->update($request->all());
        return redirect()->route('graduationTypes.index');
    }

    public function destroy(GraduationType $graduationType)
    {
        $graduationType->delete();
        return redirect()->route('graduationTypes.index');
    }

    public function remove(Request $request, GraduationType $graduationType)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $graduationType->update($request->only('status'));
        return redirect()->route('graduationTypes.index');
    }

    public function fetch()
    {
        $graduationTypes = GraduationType::where('status', 1)->get();
        return $graduationTypes;
    }
}
