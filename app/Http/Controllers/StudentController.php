<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::where('status', 1)->get();

        $courseController = new CourseController();
        $courses = $courseController->fetch();
        return Inertia::render('Students/Index', [
            'students' => $students,
            'courses' => $courses
        ]);
    }

    public function create()
    {
        $courseController = new CourseController();
        $courses = $courseController->fetch();

        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();
        return Inertia::render('Students/Create', [
            'courses' => $courses,
            'periods' => $periods
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'lastname' => 'required|string',
        //     'date_of_birth' => 'required|string',
        //     'identification' => 'required|string',
        //     'email' => 'required|email|unique:students',
        //     'banner_code' => 'required|email|unique:students',
        //     'sex' => 'required|integer',
        //     'status' => 'required|integer'
        // ]);

        // Student::create($request->all());
        // return redirect()->route('students.index');

        $params = $request->all();
        $data = [
            'name' => $params['name'],
            'lastname' => $params['lastname'],
            'date_of_birth' => $params['date_of_birth'],
            'identification' => $params['identification'],
            'email' => $params['email'],
            'banner_code' => $params['banner_code'],
            'sex' => $params['sex'],
            'course_id' => $params['course_id'],
            'academic_period_start_id' => $params['academic_period_start_id'],
            'status' => $params['status']
        ];
        Student::create($data);
        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        $student = Student::where('students.id', $student->id)
            ->join('courses', 'students.course_id', '=', 'courses.id')
            ->select('students.*', 'courses.name as course_name',)
            ->first();

        $courseController = new CourseController();
        $courses = $courseController->fetch();

        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();

        return Inertia::render('Students/Edit', [
            'student' => $student,
            'courses' => $courses,
            'periods' => $periods
        ]);
    }

    public function update(Request $request, Student $student)
    {
        //TODO: test update
        // $request->validate([
        //     'name' => 'required|string',
        //     'lastname' => 'required|string',
        //     'email' => 'required|email|unique:students',
        //     'date_of_birth' => 'required|date',
        //     'identification' => 'required|string',
        //     'banner_code' => 'required|string|unique:students',
        //     'sex' => 'required|integer',
        // ]);

        $student->update($request->all());
        return redirect()->route('students.index');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(null, 204);
    }
    public function profile(Student $student)
    {
        $student = Student::where('students.id', $student->id)
            ->join('courses', 'course_id', '=', 'courses.id')
            ->select('students.*', 'courses.name AS course_name')
            ->first();

        $graduationController = new GraduationController();
        $graduation = $graduationController->graduation($student->id);

        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();

        return Inertia::render('Students/Profile', [
            'student' => $student,
            'graduation' => $graduation,
            'periods' => $periods
        ]);
    }

    public function remove(Request $request, Student $student)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $student->update($request->only('status'));
        return redirect()->route('students.index');
    }

    public function fetch()
    {
        $students = Student::where('status', 1)->get();
        return response()->json($students);
    }

    public function fetchById($student_id)
    {
        $query = Student::where('students.id', $student_id)
            ->join('courses', 'course_id', '=', 'courses.id')
            ->select(
                'students.id',
                DB::raw("CONCAT(students.lastname, ' ', students.name) AS fullname"),
                'identification',
                'courses.name AS course_name'
            )
            ->first();
        return response()->json($query ? $query->toArray() : []);
    }

    public function apiIndex()
    {
        return response()->json(Student::all());
    }

    public function totalStudents()
    {
        $query = Student::where('status', 1)
            ->count();
        return response()->json($query);
    }
}
