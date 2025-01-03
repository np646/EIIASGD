<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Student;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');


        $students = Student::search($query)->get()->map(function ($student) {
            $student->type = 'students';
            return $student;
        });

        $professors = Professor::search($query)->get()->map(function ($professor) {
            $professor->type = 'professors';
            return $professor;
        });

        // Combine the results
        $results = $students->merge($professors);

        return inertia('Search/Results', [
            'results' => $results,
            'searchQuery' => $query,
        ]);
    }
}
