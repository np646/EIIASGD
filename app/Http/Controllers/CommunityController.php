<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CommunityController extends Controller
{
    public function students()
    {
        return Inertia::render('Internships/Community/Students');
    }
    public function periods()
    {
        return Inertia::render('Internships/Community/Documents/Periods');
    }

    public function studentsInPeriod($period_id)
    {
       
        return Inertia::render('Internships/Community/Documents/StudentsInPeriod');
    }

    public function projects()
    {
        return Inertia::render('Internships/Community/Projects/Index');
    }
}
