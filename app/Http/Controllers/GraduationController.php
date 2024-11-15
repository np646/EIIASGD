<?php

namespace App\Http\Controllers;

use App\Models\Graduation;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GraduationController extends Controller
{
    public function index()
    {
        $graduationTypes = Graduation::where('status', 1)->get();
        return Inertia::render('Graduation/Index', [
            'graduation' => $graduationTypes
        ]);
    }

    public function create()
    {
        return Inertia::render('Graduation/Create');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'student_id' => $params['student_id'],
            'academic_period_start_id' => $params['academic_period_start_id'],
            'plan_approval_date' => $params['plan_approval_date'],
            'graduation_type' => $params['graduation_type'],
            'thesis_name' => $params['thesis_name'],
            'thesis_area' => $params['thesis_area'],
            'advisor_id' => $params['advisor_id'],
            'academic_period_end_id' => $params['academic_period_end_id'],
            'reader1_id' => $params['reader1_id'],
            'reader2_id' => $params['reader2_id'],
            'graduation_date' => $params['graduation_date'],
            'registration_times' => $params['registration_times'],
            'status' => $params['status']
        ];
        Graduation::create($data);
        return redirect()->route('graduates.index');
    }

    public function destroy(Graduation $graduate)
    {
        $graduate->delete();
        return redirect()->route('graduation.index');
    }

    public function remove(Request $request, Graduation $graduation)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $graduation->update($request->only('status'));
        return redirect()->route('graduation.index');
    }

    public function fetch()
    {
        $graduations = Graduation::where('status', 1)->get();
        return response()->json($graduations);
    }

    public function fetchById($student_id)
    {
        $query = Graduation::where('student_id', $student_id)
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->join('graduation_types', 'graduations.graduation_type', '=', 'graduation_types.id')
            ->join('thesis_areas', 'graduations.thesis_area', '=', 'thesis_areas.id')
            ->join('professors AS advisor', 'graduations.advisor_id', '=', 'advisor.id')
            ->join('professors AS reader1', 'graduations.reader1_id', '=', 'reader1.id')
            ->join('professors AS reader2', 'graduations.reader2_id', '=', 'reader2.id')
            ->join('academic_periods AS start_period', 'graduations.academic_period_start_id', '=', 'start_period.id')
            ->join('academic_periods AS end_period', 'graduations.academic_period_end_id', '=', 'end_period.id')
            ->join('graduation_statuses', 'graduations.status', '=', 'graduation_statuses.id')
            ->select(
                'graduations.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student_name"),
                'graduation_types.type AS type',
                'thesis_areas.area AS area',
                'start_period.period AS start_period',
                'end_period.period AS end_period',
                DB::raw("CONCAT(advisor.lastname, ' ', advisor.name) AS advisor_name"),
                DB::raw("CONCAT(reader1.lastname, ' ', reader1.name) AS reader1_name"),
                DB::raw("CONCAT(reader2.lastname, ' ', reader2.name) AS reader2_name"),
                'graduation_statuses.name as status_name'
            )
            ->get();
        return $query;
    }

    public function graduation($student_id)
    {
        $query = $this->fetchById($student_id);

        return Inertia::render('Graduation/Process/Index', [
            'graduation' => $query
        ]);
    }

    public function edit($student_id)
    {
        $graduation = $this->fetchById($student_id);

        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();

        $typeController = new GraduationTypeController();
        $types = $typeController->fetch();

        $areaController = new ThesisAreaController();
        $areas = $areaController->fetch();

        $professorController = new ProfessorController();
        $professors = $professorController->fetch();

        $statusController = new GraduationStatusController();
        $statuses = $statusController->fetch();

        return Inertia::render('Graduation/Process/Edit', [
            'graduation' => $graduation,
            'periods' => $periods,
            'types' => $types,
            'areas' => $areas,
            'professors' => $professors,
            'statuses' => $statuses
        ]);
    }

    public function update(Request $request, Graduation $graduation)
    {
        $graduation->update($request->all());
        return redirect()->route('graduation.graduation', [$graduation->id]);
    }

    public function professorProcesses($professor_id)
    {
        $query = Graduation::where(function ($q) use ($professor_id) {
            $q->where('graduations.advisor_id', $professor_id)
                ->orWhere('graduations.reader1_id', $professor_id)
                ->orWhere('graduations.reader2_id', $professor_id);
        })
            ->select(
                'graduations.*',
                'graduation_statuses.name as status_name',
                DB::raw(" 
                CASE 
                WHEN graduations.advisor_id = $professor_id THEN 'ASESOR' 
                WHEN graduations.reader1_id = $professor_id THEN 'LECTOR(I)' 
                WHEN graduations.reader2_id = $professor_id THEN 'LECTOR(II)' 
                END AS role"),
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student_name"),
                'students.identification'
            )
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->join('graduation_statuses', 'graduations.status', '=', 'graduation_statuses.id')
            ->get();

        return $query;
    }
}
