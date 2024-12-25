<?php

namespace App\Http\Controllers;

use App\Models\Graduation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GraduationController extends Controller
{
    public function statistics()
    {
        return Inertia::render('Graduation/Statistics/Index', []);
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
        return redirect()->route('graduation.process', [$graduation->id]);
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

    public function advisors()
    {
        $query = Graduation::whereNotNull('advisor_id')
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->join('academic_periods AS start_period', 'graduations.academic_period_start_id', '=', 'start_period.id')
            ->join('academic_periods AS end_period', 'graduations.academic_period_end_id', '=', 'end_period.id')
            ->join('professors', 'graduations.advisor_id', '=', 'professors.id')
            ->join('graduation_statuses', 'graduations.status', '=', 'graduation_statuses.id')
            ->select(
                'graduations.*',
                'graduation_statuses.name as status_name',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
                'start_period.period AS start_period',
                'end_period.period AS end_period',
                DB::raw("CONCAT(professors.lastname, ' ', professors.name) AS professor")
            )
            ->orderBy('professor', 'asc')
            ->orderBy('graduations.status', 'asc')
            ->get();

        return Inertia::render('Graduation/Advisors', [
            'advisors' => $query
        ]);
    }

    public function readers()
    {
        $query = Graduation::whereNotNull('reader1_id')
            ->whereNotNull('reader2_id')
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->join('academic_periods AS start_period', 'graduations.academic_period_start_id', '=', 'start_period.id')
            ->join('academic_periods AS end_period', 'graduations.academic_period_end_id', '=', 'end_period.id')
            ->join('professors', function ($join) {
                $join->on('graduations.reader1_id', '=', 'professors.id')
                    ->orOn('graduations.reader2_id', '=', 'professors.id');
            })->join('graduation_statuses', 'graduations.status', '=', 'graduation_statuses.id')
            ->select(
                'graduations.*',
                'graduation_statuses.name as status_name',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
                'start_period.period AS start_period',
                'end_period.period AS end_period',
                DB::raw("CONCAT(professors.lastname, ' ', professors.name) AS professor")
            )
            ->orderBy('professor', 'asc')
            ->orderBy('graduations.status', 'asc')
            ->get();

        return Inertia::render('Graduation/Readers', [
            'readers' => $query
        ]);
    }

    public function periods()
    {
        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();

        return Inertia::render('Graduation/Documents/Periods', [
            'periods' => $periods
        ]);
    }

    public function studentsInPeriod($period_id)
    {
        $query = Graduation::where('graduations.academic_period_start_id', $period_id)
            ->orWhere('graduations.academic_period_end_id', $period_id)
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->select(
                'graduations.id',
                'graduations.student_id',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
            )
            ->orderBy('graduations.status', 'asc')
            ->get();
        return Inertia::render('Graduation/Documents/StudentsInPeriod', [
            'students' => $query
        ]);
    }

    public function reviewers()
    {
        return Inertia::render('Graduation/Reviewers/Index');
    }

    public function getReviewersByStudents()
    {
        $graduations = Graduation::join('students', 'graduations.student_id', '=', 'students.id')
            ->join('professors AS advisors', 'graduations.advisor_id', '=', 'advisors.id')
            ->join('professors AS reader1s', 'graduations.reader1_id', '=', 'reader1s.id')
            ->join('professors AS reader2s', 'graduations.reader2_id', '=', 'reader2s.id')
            ->select(
                'graduations.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
                DB::raw("CONCAT(advisors.lastname, ' ', advisors.name) AS advisor"),
                DB::raw("CONCAT(reader1s.lastname, ' ', reader1s.name) AS reader1"),
                DB::raw("CONCAT(reader2s.lastname, ' ', reader2s.name) AS reader2")
            )
            ->get();

        if (request()->wantsJson()) {
            return response()->json(['graduations' => $graduations]);
        }

        return back()->with(['graduations' => $graduations]);
    }

    public function getReviewersByProfessors()
    {
        $professors = Graduation::select(
            'professors.id',
            DB::raw("CONCAT(professors.lastname, ' ', professors.name) AS professor"),
            DB::raw('
            COUNT(CASE WHEN graduations.advisor_id = professors.id THEN 1 END) AS advisor_count,
            COUNT(CASE WHEN graduations.reader1_id = professors.id THEN 1 END) +
            COUNT(CASE WHEN graduations.reader2_id = professors.id THEN 1 END) AS reader_count,
            COUNT(CASE WHEN graduations.advisor_id = professors.id AND graduations.status != 1 THEN 1 END) AS advisor_not_graduated_count,
            COUNT(CASE WHEN graduations.reader1_id = professors.id AND graduations.status != 1 THEN 1 END) +
            COUNT(CASE WHEN graduations.reader2_id = professors.id AND graduations.status != 1 THEN 1 END) AS reader_not_graduated_count
        ')
        )
            ->join('professors', function ($join) {
                $join->on('professors.id', '=', 'graduations.advisor_id')
                    ->orOn('professors.id', '=', 'graduations.reader1_id')
                    ->orOn('professors.id', '=', 'graduations.reader2_id');
            })
            ->groupBy('professors.id', 'professor')
            ->get();


        if (request()->wantsJson()) {
            return response()->json(['professors' => $professors]);
        }

        return back()->with(['professors' => $professors]);
    }

    public function professorAsAdvisor($professor_id)
    {
        $query = Graduation::where(
            'advisor_id',
            $professor_id
        )->select(
            'graduations.*',
            DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
            'graduation_statuses.name as status_name',
        )
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->join('graduation_statuses', 'graduations.status', '=', 'graduation_statuses.id')
            ->get();

        return Inertia::render('Graduation/Reviewers/Partials/AsAdvisor', [
            'advisors' => $query
        ]);
    }

    public function processesByProfessor($id)
    {
        $professorController = new ProfessorController();
        $professor = $professorController->fetchById($id);

        return Inertia::render('Graduation/Reviewers/Processes', [
            'professor_id' => $id,
            'professor' => $professor
        ]);
    }

    public function getProcessesAsAdvisor($professor_id)
    {
        $query = Graduation::where(
            'advisor_id',
            $professor_id
        )->select(
            'graduations.*',
            DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
            'graduation_statuses.name as status_name',
        )
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->join('graduation_statuses', 'graduations.status', '=', 'graduation_statuses.id')
            ->get();


        if (request()->wantsJson()) {
            return response()->json(['processes' => $query]);
        }

        return back()->with(['processes' => $query]);
    }

    public function getProcessesAsReader($professor_id)
    {
        $query = Graduation::where(function ($q) use ($professor_id) {
            $q->where('graduations.advisor_id', $professor_id)
                ->orWhere('graduations.reader1_id', $professor_id)
                ->orWhere('graduations.reader2_id', $professor_id);
        })->select(
            'graduations.*',
            DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
            'graduation_statuses.name as status_name',
        )
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->join('graduation_statuses', 'graduations.status', '=', 'graduation_statuses.id')
            ->get();


        if (request()->wantsJson()) {
            return response()->json(['processes' => $query]);
        }

        return back()->with(['processes' => $query]);
    }

    public function students()
    {
        $query = Graduation::join('students', 'graduations.student_id', '=', 'students.id')
            ->join('graduation_statuses', 'graduations.status', '=', 'graduation_statuses.id')
            ->select(
                'graduations.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
                'graduation_statuses.name as status_name'
            )
            ->get();

        return Inertia::render('Graduation/Students', [
            'students' => $query
        ]);
    }

    // Statistics in dashboard
    public function totalGraduated()
    {
        $query = Graduation::where('status', 2)
            ->count();
        return response()->json($query);
    }

    public function studentsGraduatedPerYear()
    {
        $query = Graduation::selectRaw('YEAR(graduation_date) as year, COUNT(*) as total_graduated')
            ->where('status', 2)
            ->groupBy(DB::raw('YEAR(graduation_date)'))
            ->orderBy('year', 'asc')
            ->get();

        return response()->json($query);
    }

    // Statistics module

    //is this one being used ever?
    public function getStudentsRetaking()
    {
        $query = Graduation::where('registration_times', '>', 1)
            ->get();

        if (request()->wantsJson()) {
            return response()->json(['processes' => $query]);
        }

        return back()->with(['processes' => $query]);
    }

    public function getPlansDueToExpire()
    {
        $query = Graduation::whereNotNull('academic_period_start_id')
            ->whereNot('graduations.status', 2)
            ->whereNull('academic_period_end_id')
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->join('academic_periods AS start_period', 'graduations.academic_period_start_id', '=', 'start_period.id')
            ->select(
                'graduations.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
                'start_period.period AS start_period',
                DB::raw("CASE WHEN DATEDIFF(now(), plan_approval_date) > 365 THEN 'Sí' ELSE 'No' END AS is_delayed")
            )
            ->get();

        return response()->json($query);
    }

    public function getRegistrationTimes()
    {
        $query = Graduation::where('registration_times', '>', 1)
            ->whereNot('graduations.status', 2)
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->join('academic_periods AS end_period', 'graduations.academic_period_end_id', '=', 'end_period.id')
            ->select(
                'graduations.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
                'end_period.period AS end_period',
            )
            ->get();
        return response()->json($query);
    }

    public function getGraduatesByDate($start, $end)
    {
        $query = Graduation::where('graduations.status', 2)
            ->whereBetween('graduation_date', [$start, $end])
            ->join('students', 'graduations.student_id', '=', 'students.id')
            ->select(
                'graduations.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
            )
            ->get();
        return response()->json($query);
    }
}
