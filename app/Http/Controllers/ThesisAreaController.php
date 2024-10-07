<?php

namespace App\Http\Controllers;

use App\Models\ThesisArea;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisAreaController extends Controller
{
    public function index()
    {
        $thesisAreas = ThesisArea::where('status', 1)->get();
        return Inertia::render('ThesisAreas/Index', [
            'thesisAreas' => $thesisAreas
        ]);
    }

    public function create()
    {
        return Inertia::render('ThesisAreas/Create');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'area' => $params['area'],
            'status' => $params['status']
        ];
        ThesisArea::create($data);
        return redirect()->route('thesisAreas.index');
    }

    public function edit(ThesisArea $thesisArea)
    {
        return Inertia::render('ThesisAreas/Edit', [
            'thesisArea' => $thesisArea
        ]);
    }

    public function update(Request $request, ThesisArea $thesisArea)
    {
        $thesisArea->update($request->all());
        return redirect()->route('thesisAreas.index');
    }

    public function destroy(ThesisArea $thesisArea)
    {
        $thesisArea->delete();
        return redirect()->route('thesisAreas.index');
    }

    public function remove(Request $request, ThesisArea $thesisArea)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $thesisArea->update($request->only('status'));
        return redirect()->route('thesisAreas.index');
    }

    public function fetch()
    {
        $thesisAreas = ThesisArea::where('status', 1)->get();
        return response()->json($thesisAreas);
    }
}
