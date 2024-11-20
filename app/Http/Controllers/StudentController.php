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
        return Inertia::render('Students/Create', [
            'courses' => $courses
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
        return Inertia::render('Students/Edit', [
            'student' => $student,
            'courses' => $courses
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

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }

    public function profile(Student $student)
    {
        $student = Student::where('students.id', $student->id)
            ->join('courses', 'course_id', '=', 'courses.id')
            ->select('students.*', 'courses.name AS course_name')
            ->first();

        $graduationController = new GraduationController();
        $graduation = $graduationController->graduation($student->id);

        return Inertia::render('Students/Profile', [
            'student' => $student,
            'graduation' => $graduation
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
        $query = Student::where('id', $student_id)
            ->select('id', 
            DB::raw("CONCAT(lastname, ' ', name) AS fullname"),
            'identification')
            ->first();
            return response()->json($query ? $query->toArray() : []);
    }
}
