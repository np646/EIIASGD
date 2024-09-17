<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return Inertia::render('Students/Index', [
            'students' => $students
        ]);
    }

    public function create()
    {
        return Inertia::render('Students/Create');
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
            'status' => $params['status']
        ];
        Student::create($data);
        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        return Inertia::render('Students/Edit', [
            'student' => $student
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'age' => 'required|integer'
        ]);

        $student->update($request->all());
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }
}