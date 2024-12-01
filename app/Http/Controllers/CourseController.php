<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;


class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 1)->get();
        return Inertia::render('Settings/Courses/Index', [
            'courses' => $courses
        ]);
    }

    public function create()
    {
        return Inertia::render('Settings/Courses/Create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'banner_id' => 'required|string|max:255',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course = Course::create(attributes: $request->all());
        return response()->json($course, 201);
    }

    public function edit(Course $course)
    {
        return Inertia::render('Settings/Courses/Edit', [
            'course' => $course
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'banner_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course->update($request->all());
        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(null, 204);
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
        return $courses;
    }

    public function apiIndex()
    {
        return response()->json(Course::all());
    }
}
