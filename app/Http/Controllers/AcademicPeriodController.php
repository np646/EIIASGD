<?php
// TODO: THIS HASN'T BEEN TESTED NOR CONFIRMED WORKING YET
namespace App\Http\Controllers;

use App\Models\AcademicPeriod;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AcademicPeriodController extends Controller
{
    public function index()
    {
        $academicPeriods = AcademicPeriod::all();
        return Inertia::render('AcademicPeriods/Index', [
            'academicPeriods' => $academicPeriods
        ]);
    }

    public function create()
    {
        return Inertia::render('AcademicPeriods/Create');
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
        return Inertia::render('AcademicPeriods/Edit', [
            'academicPeriod' => $academicPeriod
        ]);
    }

    public function update(Request $request, AcademicPeriod $academicPeriod)
    { //TODO: Get update working from students
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:academicPeriods,email,' . $academicPeriod->id,
            'age' => 'required|integer'
        ]);

        $academicPeriod->update($request->all());
        return redirect()->route('academicPeriods.index');
    }

    public function destroy(AcademicPeriod $academicPeriod)
    {
        $academicPeriod->delete();
        return redirect()->route('academicPeriods.index');
    }
}
