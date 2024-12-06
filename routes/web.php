<?php



use App\Http\Controllers\DashboardController;
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
use App\Http\Controllers\FileController;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\GraduationFilesController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


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
Route::prefix('api')->group(function () {
    Route::get('/students', [StudentController::class, 'apiIndex']);
    Route::delete('/students/{student}', [StudentController::class, 'destroy']);
});
// Professors
Route::resource('professors', ProfessorController::class);
Route::get('professors/{professor}/profile', [ProfessorController::class, 'profile'])->name('professors.profile');
Route::put('professors/{professor}/remove', [ProfessorController::class, 'remove'])->name('professors.remove');
Route::put('professors/fetch', [ProfessorController::class, 'fetch'])->name('professors.fetch');
Route::prefix('api')->group(function () {
    Route::get('/professors', [ProfessorController::class, 'apiIndex']);
    Route::delete('/professors/{professor}', [ProfessorController::class, 'destroy']);
});
//////////------------------------------------//////////

// SETTINGS MODULE
// Academic periods
Route::prefix('api')->group(function () {
    Route::get('/academic-periods', [AcademicPeriodController::class, 'apiIndex']);
    Route::post('/academic-periods', [AcademicPeriodController::class, 'store']);
    Route::put('/academic-periods/{period}', [AcademicPeriodController::class, 'update']);
    Route::delete('/academic-periods/{period}', [AcademicPeriodController::class, 'destroy']);
});
Route::get('/settings/academic-periods', [AcademicPeriodController::class, 'index'])->name('academicPeriods.index');

Route::put('academic-periods/{academicPeriod}/remove', [AcademicPeriodController::class, 'remove'])->name('academicPeriods.remove');
Route::put('academic-periods/fetch', [AcademicPeriodController::class, 'fetch'])->name('academicPeriods.fetch');

// Courses
Route::prefix('api')->group(function () {
    Route::get('/courses', [CourseController::class, 'apiIndex']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{course}', [CourseController::class, 'update']);
    Route::delete('/courses/{course}', [CourseController::class, 'destroy']);
});

Route::resource('settings/courses', CourseController::class);


// Thesis areas
Route::prefix('api')->group(function () {
    Route::get('/thesis-areas', [ThesisAreaController::class, 'apiIndex']);
    Route::post('/thesis-areas', [ThesisAreaController::class, 'store']);
    Route::put('/thesis-areas/{area}', [ThesisAreaController::class, 'update']);
    Route::delete('/thesis-areas/{area}', [ThesisAreaController::class, 'destroy']);
});
Route::get('/settings/thesis-areas', [ThesisAreaController::class, 'index'])->name('thesisAreas.index');

// Roles

Route::prefix('api')->group(function () {
    Route::get('/roles', [RoleController::class, 'apiIndex']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::put('/roles/{role}', [RoleController::class, 'update']);
    Route::delete('/roles/{role}', [RoleController::class, 'destroy']);
});

// Route::resource('settings/roles', RoleController::class);
Route::get('/settings/roles', [RoleController::class, 'index'])->name('roles.index');

Route::put('roles/{role}/remove', [RoleController::class, 'remove'])->name('roles.remove');
Route::put('roles/fetch', [RoleController::class, 'fetch'])->name('roles.fetch');

// Permissions

Route::prefix('api')->group(function () {
    Route::get('/permissions', [PermissionController::class, 'apiIndex']);
    Route::post('/permissions', [PermissionController::class, 'store']);
    Route::put('/permissions/{permission}', [PermissionController::class, 'update']);
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy']);
});

//Route::resource('settings/permissions', PermissionController::class);
Route::get('/settings/permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::put('permissions/{permission}/remove', [PermissionController::class, 'remove'])->name('permissions.remove');
Route::put('permissions/fetch', [PermissionController::class, 'fetch'])->name('permissions.fetch');

// Users
Route::prefix('api')->group(function () {
    Route::get('/users', [UserController::class, 'apiIndex']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});

Route::get('/settings/users', [UserController::class, 'index'])->name('users.index');
// Settings
Route::resource('settings', SettingsController::class);
//////////------------------------------------//////////

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

Route::prefix('api')->group(function () {
    Route::get('/graduation/statistics/plans-due-to-expire', [GraduationController::class, 'getPlansDueToExpire']);
    Route::get('/graduation/statistics/registration-times', [GraduationController::class, 'getRegistrationTimes']);
    Route::get('/graduation/statistics/graduates-by-date/{start}/{end}', [GraduationController::class, 'getGraduatesByDate']);
});

/////////////////////////////////////////////////


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

// FILE MANAGEMENT
Route::get('/graduation/documents/periods', [GraduationController::class, 'periods'])->name('graduation.periods');
Route::get('/graduation/documents/{period}/students', [GraduationController::class, 'studentsInPeriod'])->name('graduation.studentsInPeriod');
Route::get('/graduation/documents/{student}/files', [GraduationFilesController::class, 'studentFiles'])->name('graduationFiles.studentFiles');

Route::get('/studentfiles/{parentId?}', [FileController::class, 'index'])->name('files.index');
Route::post('/studentfiles/{parentId}', [FileController::class, 'store'])->name('files.store');

Route::post('/files/{parentId}', [GraduationFilesController::class, 'storeFile'])->name('graduationfiles.storeFile');


Route::post('/graduation/files/{parentId}', [FileController::class, 'store'])->name('files.store');
Route::put('/files/update/{id}', [FileController::class, 'update']);
Route::delete('/files/delete/{student_id}/{index}/{file_id}', [FileController::class, 'destroy'])->name('files.destroy');
Route::get('/files/download/{id}', [FileController::class, 'download']);
Route::get('/files/open/{file_id}', [FileController::class, 'open']);


// REVIEWERS: ADVISORS AND READERS
Route::get('/graduation/reviewers', [GraduationController::class, 'reviewers'])->name('graduation.reviewers');
// Route::get('/reviewersByStudents', [GraduationController::class, 'reviewersByStudents']);
// Route::get('/reviewers', [GraduationController::class, 'reviewersByProfessors'])->name('graduation.reviewersByProfessors');
Route::get('/get-reviewers-by-students', [GraduationController::class, 'getReviewersByStudents'])
    ->name('graduation.getReviewersByStudents');
Route::get('/get-reviewers-by-professors', [GraduationController::class, 'getReviewersByProfessors'])
    ->name('graduation.getReviewersByProfessors');

Route::get('/reviewers/processes/professor/{professor}', [GraduationController::class, 'processesByProfessor'])->name('graduation.processesByProfessor');

Route::get('/get-processes-as-advisor/{id}', [GraduationController::class, 'getProcessesAsAdvisor'])
    ->name('graduation.getProcessesAsAdvisor');
Route::get('/get-processes-as-reader/{id}', [GraduationController::class, 'getProcessesAsReader'])
    ->name('graduation.getProcessesAsReader');

// ya no se usa
// Route::get('/oldfiles', function () {
//   return Inertia::render('Graduation/OldFiles');
//   });
/////////////////////////////////////////////////

// Users


require __DIR__ . '/auth.php';
