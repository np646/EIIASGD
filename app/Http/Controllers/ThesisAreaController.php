<?php

namespace App\Http\Controllers;

use App\Models\ThesisArea;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class ThesisAreaController extends Controller
{
    public function index()
    {
        $thesisAreas = ThesisArea::where('status', 1)->get();
        return Inertia::render('Settings/ThesisAreas/Index', [
            'thesisAreas' => $thesisAreas
        ]);
    }

    public function create()
    {
        return Inertia::render('Settings/ThesisAreas/Create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'area' => 'required|string|max:255',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $area = ThesisArea::create($request->all());
        return response()->json($area, 201);
    }

    public function edit(ThesisArea $thesisArea)
    {
        return Inertia::render('Settings/ThesisAreas/Edit', [
            'thesisArea' => $thesisArea
        ]);
    }

    public function update(Request $request, ThesisArea $area)
    {
        $validator = Validator::make($request->all(), [
            'area' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $area->update($request->all());
        return response()->json($area);
    }

    public function destroy(ThesisArea $area)
    {
        $area->delete();
        return response()->json(null, 204);
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
        return $thesisAreas;
    }

    public function apiIndex()
    {
        return response()->json(ThesisArea::all());
    }
}
