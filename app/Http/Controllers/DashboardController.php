<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $studentController = new StudentController();
        $students = $studentController->totalStudents();
       
        $graduationController = new GraduationController();
        $graduated = $graduationController->totalGraduated();
        $graduatedPerYear = $graduationController->studentsGraduatedPerYear();

        return Inertia::render('Dashboard', [
            'students' => $students,
            'graduated' => $graduated,
            'graduatedPerYear' => $graduatedPerYear
        ]);
    }

    public function reports()
    {
        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();
        return Inertia::render('Reports/Index', [
            'periods' => $periods
        ]);
    }
}
