<?php

namespace App\Http\Controllers;

use App\Models\AcademicPeriod;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class AcademicPeriodController extends Controller
{
    public function index()
    {
        $academicPeriods = AcademicPeriod::where('status', 1)->get();
        return Inertia::render('Settings/AcademicPeriods/Index', [
            'academicPeriods' => $academicPeriods
        ]);
    }

    public function create()
    {
        return Inertia::render('Settings/AcademicPeriods/Create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'period' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $period = AcademicPeriod::create($request->all());
        return response()->json($period, 201);
    }

    public function edit(AcademicPeriod $academicPeriod)
    {
        return Inertia::render('Settings/AcademicPeriods/Edit', [
            'academicPeriod' => $academicPeriod
        ]);
    }

    public function update(Request $request, AcademicPeriod $period)
    {
        $validator = Validator::make($request->all(), [
            'period' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $period->update($request->all());
        return response()->json($period);
    }

    public function destroy(AcademicPeriod $period)
    {
        $period->delete();
        return response()->json(null, 204);
    }

    public function remove(Request $request, AcademicPeriod $academicPeriod)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $academicPeriod->update($request->only('status'));
        return redirect()->route('academicPeriods.index');
    }

    public function fetch()
    {
        $academicPeriods = AcademicPeriod::where('status', 1)->get();
        return $academicPeriods;
    }

    public function apiIndex()
    {
        return response()->json(AcademicPeriod::all());
    }
}
