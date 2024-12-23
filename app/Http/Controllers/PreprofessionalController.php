<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PreprofessionalController extends Controller
{
    public function students()
    {
        return Inertia::render('Internships/Preprofessional/Students');
    }
    public function periods()
    {
        return Inertia::render('Internships/Preprofessional/Documents/Periods');
    }

    public function studentsInPeriod($period_id)
    {
       
        return Inertia::render('Internships/Preprofessional/Documents/StudentsInPeriod');
    }

    public function projects()
    {
        return Inertia::render('Internships/Preprofessional/Projects/Index');
    }
}
