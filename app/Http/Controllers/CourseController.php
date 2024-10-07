<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 1)->get();
        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }

    public function create()
    {
        return Inertia::render('Courses/Create');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'name' => $params['name'],
            'banner_id' => $params['banner_id'],
            'status' => $params['status']
        ];
        Course::create($data);
        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        return Inertia::render('Courses/Edit', [
            'course' => $course
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->all());
        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index');
    }

    public function remove(Request $request, Course $course)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $course->update($request->only('status'));
        return redirect()->route('courses.index');
    }

    public function fetch()
    {
        $courses = Course::where('status', 1)->get();
        return response()->json($courses);
    }
}
