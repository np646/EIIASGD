<?php
namespace App\Http\Controllers;

use App\Models\AcademicPeriod;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        $params = $request->all();
        $data = [
            'period' => $params['period'],
            'year' => $params['year'],
            'status' => $params['status']
        ];
        AcademicPeriod::create($data);
        return redirect()->route('academicPeriods.index');
    }

    public function edit(AcademicPeriod $academicPeriod)
    {
        return Inertia::render('Settings/AcademicPeriods/Edit', [
            'academicPeriod' => $academicPeriod
        ]);
    }

    public function update(Request $request, AcademicPeriod $academicPeriod)
    { 
        $academicPeriod->update($request->all());
        return redirect()->route('academicPeriods.index');
    }

    public function destroy(AcademicPeriod $academicPeriod)
    {
        $academicPeriod->delete();
        return redirect()->route('academicPeriods.index');
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
        $academicPeriods = AcademicPeriod ::where('status', 1)->get();
        return $academicPeriods;

    }
}
