<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;


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


        $validator = Validator::make($request->all(), [
           'name' => 'required|string',
            'lastname' => 'required|string',
            'date_of_birth' => 'required|string',
            'identification' => 'required|string',
            'email' => 'required|email|unique:students',
            'banner_code' => 'required|string|unique:students',
            'sex' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    

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
            'academic_period_start_id' => $params['academic_period_start_id']
        ];
        Student::create($data);

        $last_id = Student::orderBy('id', 'desc')->first()->id;
        $graduationController = new GraduationController();
        $graduationController->store($last_id);

        $graduationFilesController = new GraduationFilesController();
        $graduationFilesController->store($last_id);

        $communityController = new CommunityController();
        $communityController->store($last_id);

        $preprofessionalController = new PreprofessionalController();
        $preprofessionalController->store($last_id);

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

    public function remove($id)
    {
        $student = Student::findOrFail($id);
        $student->update(['status' => 0]);
        return response()->json(null, 204);
    }

    public function fetch()
    {
        //TODO: check if the where column here is correct, review where this method is used so only active students are fetched
        $students = Student::where('status', 1)->get();
        return response()->json($students);
    }


    public function fetchFullStudent($student_id)
    {
        $student = Student::where('id', $student_id)->first();
        return $student;
    }
    public function fetchFullNames()
    {
        $students = Student::where('status', 1)
            ->select('id', DB::raw("CONCAT(lastname, ' ', name) AS name"))
            ->get();
        return  $students;
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
        return response()->json(Student::where('status', 1)->get());
    }

    public function totalStudents()
    {
        $query = Student::where('status', 1)
            ->count();
        return response()->json($query);
    }
}
