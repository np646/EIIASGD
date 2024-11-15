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

// Titulación TODO: cambiar por lo que sea en inglés "seguimiento"
// Route::get('/files', function () {
//     return Inertia::render('Graduation/Files');
// });

// Titulación - lectores
Route::get('/readers', function () {
    return Inertia::render('Graduation/Readers');
});



// Titulación 
Route::get('/period', function () {
    return Inertia::render('Graduation/Period');
});
// Titulación
// Route::get('/studentfiles', function () {
//     return Inertia::render('Graduation/StudentFiles');
// });
// Titulación
Route::get('/studentfolders', function () {
    return Inertia::render('Graduation/StudentFolders');
});

// Titulación - reportes
Route::get('/graduation/statistics', function () {
    return Inertia::render('Graduation/Statistics/Statistics');
});

/////////////////////////////////////////////////
use App\Http\Controllers\FileController;
use App\Http\Controllers\GraduationController;

Route::get('/studentfiles', [FileController::class, 'index'])->name('files.index');
Route::get('/studentfiles/{parentId?}', [FileController::class, 'index'])->name('files.index');
Route::post('/studentfiles/{parentId}', [FileController::class, 'store'])->name('files.store');
Route::put('/files/update/{id}', [FileController::class, 'update']);
Route::delete('/files/delete/{id}', [FileController::class, 'destroy']);
Route::get('/files/download/{id}', [FileController::class, 'download']);
Route::get('/files/open/{id}', [FileController::class, 'open']);


// Route::prefix('studentfiles')->group(function () {
//     Route::get('/{module}', [FileController::class, 'index'])->name('files.index');
//     Route::post('/{module}', [FileController::class, 'store'])->name('files.store');
//     Route::put('/{module}/update/{id}', [FileController::class, 'update'])->name('files.update');
//     Route::delete('/{module}/delete/{id}', [FileController::class, 'destroy'])->name('files.destroy');
//     Route::get('/{module}/download/{id}', [FileController::class, 'download'])->name('files.download');
//     Route::get('/{module}/open/{id}', [FileController::class, 'open'])->name('files.open');
// });


/////////////////////////////////////////////////
// Titulación - estado del proceso /students

Route::get('/graduation/process/{student}', [GraduationController::class, 'graduation'])->name('graduation.graduation');

Route::get('/graduation/process/edit/{student}', [GraduationController::class, 'edit'])->name('graduation.edit');

Route::put('/graduation/process/update/{graduation}', [GraduationController::class, 'update'])->name('graduation.update');


// Titulación - asesores
Route::get('/advisors', [GraduationController::class, 'advisors'])->name('graduation.advisors');
Route::get('/readers', [GraduationController::class, 'readers'])->name('graduation.readers');
/////////////////////////////////////////////////

require __DIR__ . '/auth.php';
