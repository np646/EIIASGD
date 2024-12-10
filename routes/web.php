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
    Route::get('/inicio', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    //TODO: review: users cannot change user info
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Students
Route::get('estudiantes', [StudentController::class, 'index'])->name('students.index');
Route::get('estudiantes/crear', [StudentController::class, 'create'])->name('students.create');
Route::get('estudiantes/editar/{student}', [StudentController::class, 'edit'])->name('students.edit');
Route::put('estudiantes/actualizar/{student}', [StudentController::class, 'update'])->name('students.update');
Route::post('estudiantes/guardar', [StudentController::class, 'store'])->name('students.store');
Route::get('estudiantes/{student}/perfil', [StudentController::class, 'profile'])->name('students.profile');
Route::put('estudiantes/{student}/quitar', [StudentController::class, 'remove'])->name('students.remove');
Route::put('estudiantes/buscar', [StudentController::class, 'fetch'])->name('students.fetch');
Route::prefix('api')->group(function () {
    Route::get('/estudiantes', [StudentController::class, 'apiIndex'])->name('api.students.index');
    Route::delete('/estudiantes/{id}', [StudentController::class, 'destroy'])->name('api.students.destroy');
});

// Professors
Route::get('docentes', [ProfessorController::class, 'index'])->name('professors.index');
Route::get('docentes/crear', [ProfessorController::class, 'create'])->name('professors.create');
Route::get('docentes/editar/{professor}', [ProfessorController::class, 'edit'])->name('professors.edit');
Route::put('docentes/actualizar/{professor}', [ProfessorController::class, 'update'])->name('professors.update');
Route::post('docentes/guardar', [ProfessorController::class, 'store'])->name('professors.store');
Route::get('docentes/{professor}/perfil', [ProfessorController::class, 'profile'])->name('professors.profile');
Route::put('docentes/{professor}/quitar', [ProfessorController::class, 'remove'])->name('professors.remove');
Route::put('docentes/buscar', [ProfessorController::class, 'fetch'])->name('professors.fetch');
Route::prefix('api')->group(function () {
    Route::get('/docentes', [ProfessorController::class, 'apiIndex'])->name('api.professors.index');
    Route::delete('/docentes/{id}', [ProfessorController::class, 'destroy'])->name('api.professors.destroy');
});

//////////------------------------------------//////////
// SETTINGS MODULE START

// Academic periods
Route::prefix('api')->group(function () {
    Route::get('/periodos-academicos', [AcademicPeriodController::class, 'apiIndex']);
    Route::post('/periodos-academicos', [AcademicPeriodController::class, 'store']);
    Route::put('/periodos-academicos/{period}', [AcademicPeriodController::class, 'update']);
    Route::delete('/periodos-academicos/{period}', [AcademicPeriodController::class, 'destroy']);
});
Route::get('/configuracion/periodos-academicos', [AcademicPeriodController::class, 'index'])->name('academicPeriods.index');

// Courses
Route::prefix('api')->group(function () {
    Route::get('/carreras', [CourseController::class, 'apiIndex']);
    Route::post('/carreras', [CourseController::class, 'store']);
    Route::put('/carreras/{course}', [CourseController::class, 'update']);
    Route::delete('/carreras/{course}', [CourseController::class, 'destroy']);
});
Route::get('/configuracion/carreras', [CourseController::class, 'index'])->name('courses.index');

// Thesis areas
Route::prefix('api')->group(function () {
    Route::get('/areas-titulacion', [ThesisAreaController::class, 'apiIndex']);
    Route::post('/areas-titulacion', [ThesisAreaController::class, 'store']);
    Route::put('/areas-titulacion/{area}', [ThesisAreaController::class, 'update']);
    Route::delete('/areas-titulacion/{area}', [ThesisAreaController::class, 'destroy']);
});
Route::get('/configuracion/areas-titulacion', [ThesisAreaController::class, 'index'])->name('thesisAreas.index');

// Roles
Route::prefix('api')->group(function () {
    Route::get('/roles', [RoleController::class, 'apiIndex']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::put('/roles/{role}', [RoleController::class, 'update']);
    Route::delete('/roles/{role}', [RoleController::class, 'destroy']);
});
Route::get('/configuracion/roles', [RoleController::class, 'index'])->name('roles.index');

// Permissions
//TODO: check if permissions are needed at all
Route::prefix('api')->group(function () {
    Route::get('/permisos', [PermissionController::class, 'apiIndex']);
    Route::post('/permisos', [PermissionController::class, 'store']);
    Route::put('/permisos/{permission}', [PermissionController::class, 'update']);
    Route::delete('/permisos/{permission}', [PermissionController::class, 'destroy']);
});
Route::get('/configuracion/permisos', [PermissionController::class, 'index'])->name('permissions.index');

// Users
Route::prefix('api')->group(function () {
    Route::get('/usuarios', [UserController::class, 'apiIndex']);
    Route::post('/usuarios', [UserController::class, 'store']);
    Route::put('/usuarios/{user}', [UserController::class, 'update']);
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy']);
});
Route::get('/configuracion/usuarios', [UserController::class, 'index'])->name('users.index');

// Settings
Route::get('/configuracion', [SettingsController::class, 'index'])->name('settings.index');

// SETTINGS MODULE END
//////////------------------------------------//////////

// ALL ROUTES AFTER THIS POINT HAVE NOT BEEN FIXED NOR CHANGED TO SPANISH YET

// Titulación 
// Reportes
Route::get('/graduation/statistics', function () {
    return Inertia::render('Graduation/Statistics/Statistics');
});
Route::prefix('api')->group(function () {
    Route::get('/graduation/statistics/plans-due-to-expire', [GraduationController::class, 'getPlansDueToExpire']);
    Route::get('/graduation/statistics/registration-times', [GraduationController::class, 'getRegistrationTimes']);
    Route::get('/graduation/statistics/graduates-by-date/{start}/{end}', [GraduationController::class, 'getGraduatesByDate']);
});

/////////////////////////////////////////////////

// Titulación - estado del proceso 

Route::get('/graduation/process/{student}', [GraduationController::class, 'graduation'])->name('graduation.process');

Route::get('/graduation/process/edit/{student}', [GraduationController::class, 'edit'])->name('graduation.processEdit');

Route::put('/graduation/process/update/{graduation}', [GraduationController::class, 'update'])->name('graduation.update');

// FILE MANAGEMENT
Route::get('/graduation/documents/periods', [GraduationController::class, 'periods'])->name('graduation.periods');
Route::get('/graduation/documents/{period}/students', [GraduationController::class, 'studentsInPeriod'])->name('graduation.studentsInPeriod');
Route::get('/graduation/documents/{student}/files', [GraduationFilesController::class, 'studentFiles'])->name('graduationFiles.studentFiles');

Route::post('/files/{parentId}', [GraduationFilesController::class, 'storeFile'])->name('graduationfiles.storeFile');
Route::post('/graduation/files/{parentId}', [FileController::class, 'store'])->name('files.store');
Route::put('/files/update/{id}', [FileController::class, 'update']);
Route::delete('/files/delete/{student_id}/{index}/{file_id}', [FileController::class, 'destroy'])->name('files.destroy');
Route::get('/files/download/{id}', [FileController::class, 'download']);
Route::get('/files/open/{file_id}', [FileController::class, 'open']);


// REVIEWERS: ADVISORS AND READERS
Route::get('/graduation/reviewers', [GraduationController::class, 'reviewers'])->name('graduation.reviewers');
Route::get('/get-reviewers-by-students', [GraduationController::class, 'getReviewersByStudents'])
    ->name('graduation.getReviewersByStudents');
Route::get('/get-reviewers-by-professors', [GraduationController::class, 'getReviewersByProfessors'])
    ->name('graduation.getReviewersByProfessors');
Route::get('/reviewers/processes/professor/{professor}', [GraduationController::class, 'processesByProfessor'])->name('graduation.processesByProfessor');
Route::get('/get-processes-as-advisor/{id}', [GraduationController::class, 'getProcessesAsAdvisor'])
    ->name('graduation.getProcessesAsAdvisor');
Route::get('/get-processes-as-reader/{id}', [GraduationController::class, 'getProcessesAsReader'])
    ->name('graduation.getProcessesAsReader');


Route::get('/graduation/documents/students', [GraduationController::class, 'Students'])->name('graduation.students');
Route::get('/graduation/documents/{student}/files', [GraduationFilesController::class, 'studentFiles'])->name('graduationFiles.studentFiles');

/////////////////////////////////////////////////

// Temporary routes for testing
// Prácticas de vinculación
Route::get('/community', function () {
    return Inertia::render('Internships/Community/Index');
});

// Prácticas preprofesionales
Route::get('/preprofessional', function () {
    return Inertia::render('Internships/Preprofessional/Index');
});

require __DIR__ . '/auth.php';
