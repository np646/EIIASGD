<?php

namespace App\Http\Controllers;

use App\Models\CommunityInternship;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class CommunityController extends Controller
{
    public function store($student_id)
    {
        $data = [
            'student_id' => $student_id,
        ];
        CommunityInternship::create($data);
    }
    public function students()
    {
        $query = CommunityInternship::join('students', 'community_internships.student_id', '=', 'students.id')
            ->join('internship_statuses', 'community_internships.status', '=', 'internship_statuses.id')
            ->select(
                'community_internships.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
                'internship_statuses.name as status_name'
            )
            ->get();

        return Inertia::render('Internships/Community/Students', [
            'students' => $query
        ]);
    }

    public function studentFiles($student_id)
    {
        $studentController = new StudentController();
        $student = $studentController->fetchById($student_id);
        return Inertia::render('Internships/Community/Documents/Files', [
            'student' => $student
        ]);
    }

    public function apiCommunityFiles($student_id)
    {
        $files = CommunityInternship::where('student_id', $student_id)->first();
        $fileArray = json_decode($files, true);

        $files = [
            ["id" => 1, "file" => "Informe del estudiante", "file_id" => $fileArray['student_report_id']],
        ];

        if (request()->wantsJson()) {
            return response()->json(['files' => $files]);
        }

        return back()->with(['files' => $files]);
    }

    public function periods()
    {
        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();

        return Inertia::render('Internships/Community/Documents/Periods', [
            'periods' => $periods
        ]);
    }

    public function studentsInPeriod($period_id)
    {
        $query = CommunityInternship::where('community_internships.academic_period_id', $period_id)
            ->join('students', 'community_internships.student_id', '=', 'students.id')
            ->select(
                'community_internships.id',
                'community_internships.student_id',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student"),
            )
            ->orderBy('community_internships.status', 'asc')
            ->get();
        return Inertia::render('Internships/Community/Documents/StudentsInPeriod', [
            'students' => $query
        ]);
    }

    public function fetchByStudentId($student_id)
    {
        return CommunityInternship::find($student_id);
    }

    public function storeFile(Request $request, $parentId)
    {
        $fileController = new FileController();
        $fileController->store($request, $parentId);
        $fileId = $fileController->getLastId();

        $communityFile = CommunityInternship::where('student_id', $request['student_id'])->first();

        $file_column = $request['community_files_id'];

        switch ($file_column) {
            case 1:
                $communityFile->student_report_id = $fileId;
                break;
        };

        $communityFile->save();
    }

    public function fetchById($student_id)
    {
        $query = CommunityInternship::where('student_id', $student_id)
            ->leftJoin('students', 'community_internships.student_id', '=', 'students.id')
            ->leftJoin('academic_periods', 'community_internships.academic_period_id', '=', 'academic_periods.id')
            ->leftJoin('internship_statuses', 'community_internships.status', '=', 'internship_statuses.id')
            ->leftJoin('community_projects', 'community_internships.project_id', '=', 'community_projects.id')
            ->select(
                'community_internships.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student_name"),
                'academic_periods.period AS academic_period',
                'internship_statuses.name as status_name',
                'community_projects.name as project_name'
            )
            ->first();
        return $query;
    }

    public function community($student_id)
    {
        $query = $this->fetchById($student_id);

        return Inertia::render('Internships/Community/Process/Index', [
            'process' => $query
        ]);
    }

    public function edit($student_id)
    {
        $process = $this->fetchById($student_id);

        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();

        $statusController = new InternshipStatusController();
        $statuses = $statusController->fetch();

        $projectController = new CommunityProjectController();
        $projects = $projectController->fetch();

        return Inertia::render('Internships/Community/Process/Edit', [
            'process' => $process,
            'periods' => $periods,
            'statuses' => $statuses,
            'projects' => $projects
        ]);
    }

    public function updateProcess(Request $request, $student_id)
    {
        $process = $this->fetchById($student_id);
        $process->update($request->all());
        return redirect()->route('community.process', ['student' => $student_id]);
    }

    //Students in a community project
    public function studentsInProject(Request $request)
    {
        $studentController = new StudentController();
        $students = $studentController->fetchFullNames();

        $project = $request->project;
        $projectController = new CommunityProjectController();
        $projectName = $projectController->fetchByProjectId($project);
        return Inertia::render('Internships/Community/Projects/StudentsInProject', [
            'project' => $project,
            'students' => $students,
            'projectName' => $projectName
        ]);
    }
    public function apiStudentsInProject($project_id)
    {
        $query = CommunityInternship::where('project_id', $project_id)
            ->leftJoin('students', 'community_internships.student_id', '=', 'students.id')
            ->leftJoin('academic_periods', 'community_internships.academic_period_id', '=', 'academic_periods.id')
            ->leftJoin('internship_statuses', 'community_internships.status', '=', 'internship_statuses.id')
            ->select(
                'community_internships.*',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS student_name"),
                'academic_periods.period AS academic_period',
                'internship_statuses.name as status_name'
            )
            ->get();
        return response()->json($query);
    }

    public function removeStudentFromProject(Request $request, $student_id)
    {
        $project = $this->fetchById($student_id);
        $project->update(['project_id' => null]);
    }
    public function addStudentToProject($student_id, $project_id)
    {
        $project = (new CommunityProjectController())->fetchByProjectId($project_id);
        $projectPeriod = $project->academic_period_id;

        CommunityInternship::where('student_id', $student_id)
            ->update([
                'project_id' => $project_id,
                'academic_period_id' => $projectPeriod
            ]);
        $studentController = new StudentController();
        $student = $studentController->fetchFullStudent($student_id);
        return $student;
    }
}
