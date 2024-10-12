<?php



use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AcademicPeriodController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\ThesisAreaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

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

// Students
Route::resource('students', StudentController::class);
Route::get('students/{student}/profile', [StudentController::class, 'profile'])->name('students.profile');
Route::put('students/{student}/remove', [StudentController::class, 'remove'])->name('students.remove');
Route::put('students/fetch', [StudentController::class, 'fetch'])->name('students.fetch');

// Professors
Route::resource('professors', ProfessorController::class);
Route::get('professors/{professor}/profile', [ProfessorController::class, 'profile'])->name('professors.profile');
Route::put('professors/{professor}/remove', [ProfessorController::class, 'remove'])->name('professors.remove');
Route::put('professors/fetch', [ProfessorController::class, 'fetch'])->name('professors.fetch');

// Academic periods
Route::resource('academicPeriods', AcademicPeriodController::class);
Route::put('academicPeriods/{academicPeriod}/remove', [AcademicPeriodController::class, 'remove'])->name('academicPeriods.remove');
Route::put('academicPeriods/fetch', [AcademicPeriodController::class, 'fetch'])->name('academicPeriods.fetch');

// Courses
Route::resource('settings/courses', CourseController::class);
Route::put('courses/{course}/remove', [CourseController::class, 'remove'])->name('courses.remove');
Route::put('courses/fetch', [CourseController::class, 'fetch'])->name('courses.fetch');

// Thesis areas
Route::resource('settings/thesisAreas', ThesisAreaController::class);
Route::put('thesisAreas/{thesisArea}/remove', [ThesisAreaController::class, 'remove'])->name('thesisAreas.remove');
Route::put('thesisAreas/fetch', [ThesisAreaController::class, 'fetch'])->name('thesisAreas.fetch');

// Roles
Route::resource('settings/roles', RoleController::class);
Route::put('roles/{role}/remove', [RoleController::class, 'remove'])->name('roles.remove');
Route::put('roles/fetch', [RoleController::class, 'fetch'])->name('roles.fetch');

// Permissions
Route::resource('settings/permissions', PermissionController::class);
Route::put('permissions/{permission}/remove', [PermissionController::class, 'remove'])->name('permissions.remove');
Route::put('permissions/fetch', [PermissionController::class, 'fetch'])->name('permissions.fetch');

// Settings
Route::resource('settings', SettingsController::class);

// Temporary routes for testing
// Prácticas de vinculación
Route::get('/community', function () {
    return Inertia::render('Internships/Community/Index');
});

// Prácticas preprofesionales
Route::get('/preprofessional', function () {
    return Inertia::render('Internships/Preprofessional/Index');
});

// Estadísticas
Route::get('/statistics', function () {
    return Inertia::render('Statistics/Index');
});

// Titulación
Route::get('/graduation', function () {
    return Inertia::render('Graduation/Index');
});

require __DIR__ . '/auth.php';
