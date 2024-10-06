<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AcademicPeriodController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserPermissionController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return Inertia::render('Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Original log in and welcome routes

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user-permissions', [UserPermissionController::class, 'index'])->name('user.permissions');
    // For authenticated routes
});

//Students
Route::resource('students', StudentController::class);
Route::get('students/{student}/profile', [StudentController::class, 'profile'])->name('students.profile');
Route::put('students/{student}/remove', [StudentController::class, 'remove'])->name('students.remove');
Route::put('students/fetch', [StudentController::class, 'fetch'])->name('students.fetch');


//Professors
Route::resource('professors', ProfessorController::class);
Route::get('professors/{professor}/profile', [ProfessorController::class, 'profile'])->name('professors.profile');
Route::put('professors/{professor}/remove', [ProfessorController::class, 'remove'])->name('professors.remove');
Route::put('professors/fetch', [ProfessorController::class, 'fetch'])->name('professors.fetch');

//Academic periods
Route::resource('academicPeriods', AcademicPeriodController::class);
Route::put('academicPeriods/{academicPeriod}/remove', [AcademicPeriodController::class, 'remove'])->name('academicPeriods.remove');
Route::put('academicPeriods/fetch', [AcademicPeriodController::class, 'fetch'])->name('academicPeriods.fetch');

//Settings
Route::resource('settings', SettingsController::class);


require __DIR__ . '/auth.php';
