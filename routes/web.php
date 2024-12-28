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
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommunityFilesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\ThesisAreaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\GraduationFilesController;
use App\Http\Controllers\PreprofessionalController;
use App\Http\Controllers\PreprofessionalFilesController;
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


// Login: Iniciar sesión
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

// Dashboard: Inicio
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/inicio', [DashboardController::class, 'index'])->name('dashboard');
});

// User profile: Perfil de usuario
Route::middleware('auth')->group(function () {
    //TODO: review: users cannot change user info
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Students: Estudiantes
Route::get('/estudiantes', [StudentController::class, 'index'])->name('students.index');
Route::get('/estudiantes/crear', [StudentController::class, 'create'])->name('students.create');
Route::get('/estudiantes/editar/{student}', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/estudiantes/actualizar/{student}', [StudentController::class, 'update'])->name('students.update');
Route::post('/estudiantes/guardar', [StudentController::class, 'store'])->name('students.store');
Route::get('/estudiantes/{student}/perfil', [StudentController::class, 'profile'])->name('students.profile');
Route::put('/estudiantes/{student}/quitar', [StudentController::class, 'remove'])->name('students.remove');
Route::put('/estudiantes/buscar', [StudentController::class, 'fetch'])->name('students.fetch');
Route::prefix('api')->group(function () {
    Route::get('/estudiantes', [StudentController::class, 'apiIndex'])->name('api.students.index');
    Route::delete('/estudiantes/{id}', [StudentController::class, 'destroy'])->name('api.students.destroy');
});

// Professors: Docentes
Route::get('/docentes', [ProfessorController::class, 'index'])->name('professors.index');
Route::get('/docentes/crear', [ProfessorController::class, 'create'])->name('professors.create');
Route::get('/docentes/editar/{professor}', [ProfessorController::class, 'edit'])->name('professors.edit');
Route::put('/docentes/actualizar/{professor}', [ProfessorController::class, 'update'])->name('professors.update');
Route::post('/docentes/guardar', [ProfessorController::class, 'store'])->name('professors.store');
Route::get('/docentes/{professor}/perfil', [ProfessorController::class, 'profile'])->name('professors.profile');
Route::put('/docentes/{professor}/quitar', [ProfessorController::class, 'remove'])->name('professors.remove');
Route::put('/docentes/buscar', [ProfessorController::class, 'fetch'])->name('professors.fetch');
Route::prefix('api')->group(function () {
    Route::get('/docentes', [ProfessorController::class, 'apiIndex'])->name('api.professors.index');
    Route::delete('/docentes/{id}', [ProfessorController::class, 'destroy'])->name('api.professors.destroy');
});

//////////------------------------------------//////////
// SETTINGS MODULE START

// Academic periods: Periodos académicos
Route::prefix('api')->group(function () {
    Route::get('/periodos-academicos', [AcademicPeriodController::class, 'apiIndex'])->name('api.academicPeriods.index');
    Route::post('/periodos-academicos', [AcademicPeriodController::class, 'store'])->name('api.academicPeriods.store');
    Route::put('/periodos-academicos/{period}', [AcademicPeriodController::class, 'update'])->name('api.academicPeriods.update');
    Route::delete('/periodos-academicos/{period}', [AcademicPeriodController::class, 'destroy'])->name('api.academicPeriods.destroy');
});
Route::get('/configuracion/periodos-academicos', [AcademicPeriodController::class, 'index'])->name('academicPeriods.index');

// Courses: Carreras
Route::prefix('api')->group(function () {
    Route::get('/carreras', [CourseController::class, 'apiIndex'])->name('api.courses.index');
    Route::post('/carreras', [CourseController::class, 'store'])->name('api.courses.store');
    Route::put('/carreras/{course}', [CourseController::class, 'update'])->name('api.courses.update');
    Route::delete('/carreras/{course}', [CourseController::class, 'destroy'])->name('api.courses.destroy');
});
Route::get('/configuracion/carreras', [CourseController::class, 'index'])->name('courses.index');

// Thesis areas: Áreas de titulación
Route::prefix('api')->group(function () {
    Route::get('/areas-titulacion', [ThesisAreaController::class, 'apiIndex'])->name('api.thesisAreas.index');
    Route::post('/areas-titulacion', [ThesisAreaController::class, 'store'])->name('api.thesisAreas.store');
    Route::put('/areas-titulacion/{area}', [ThesisAreaController::class, 'update'])->name('api.thesisAreas.update');
    Route::delete('/areas-titulacion/{area}', [ThesisAreaController::class, 'destroy'])->name('api.thesisAreas.destroy');
});
Route::get('/configuracion/areas-titulacion', [ThesisAreaController::class, 'index'])->name('thesisAreas.index');

// Roles
Route::prefix('api')->group(function () {
    Route::get('/roles', [RoleController::class, 'apiIndex'])->name('api.roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('api.roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('api.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('api.roles.destroy');
});
Route::get('/configuracion/roles', [RoleController::class, 'index'])->name('roles.index');

// Permissions: Permisos
//TODO: check if permissions are needed at all
Route::prefix('api')->group(function () {
    Route::get('/permisos', [PermissionController::class, 'apiIndex'])->name('api.permissions.index');
    Route::post('/permisos', [PermissionController::class, 'store'])->name('api.permissions.store');
    Route::put('/permisos/{permission}', [PermissionController::class, 'update'])->name('api.permissions.update');
    Route::delete('/permisos/{permission}', [PermissionController::class, 'destroy'])->name('api.permissions.destroy');
});
Route::get('/configuracion/permisos', [PermissionController::class, 'index'])->name('permissions.index');

// Users: Usuarios
Route::prefix('api')->group(function () {
    Route::get('/usuarios', [UserController::class, 'apiIndex'])->name('api.users.index');
    Route::post('/usuarios', [UserController::class, 'store'])->name('api.users.store');
    Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('api.users.update');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('api.users.destroy');
});
Route::get('/configuracion/usuarios', [UserController::class, 'index'])->name('users.index');

// Settings: Configuración
Route::get('/configuracion', [SettingsController::class, 'index'])->name('settings.index');

// SETTINGS MODULE END

//////////------------------------------------//////////

// GRADUATIONS MODULE START

// Graduation by students: Titulación por estudiantes
Route::get('/titulacion/estudiantes', [GraduationController::class, 'Students'])->name('graduation.students');

// Graduation process by student: Proceso de titulación por estudiante
Route::get('/titulacion/estudiantes/proceso/{student}', [GraduationController::class, 'graduation'])->name('graduation.process');
Route::get('/titulacion/estudiantes/proceso/editar/{student}', [GraduationController::class, 'edit'])->name('graduation.processEdit');
Route::put('/titulacion/estudiantes/proceso/actualizar/{graduation}', [GraduationController::class, 'update'])->name('graduation.update');

// Graduation process by academic period: Proceso de titulación por periodo académico
Route::get('/titulacion/periodos-academicos', [GraduationController::class, 'periods'])->name('graduation.periods');
Route::get('/titulacion/periodos-academicos/{period}/estudiantes', [GraduationController::class, 'studentsInPeriod'])->name('graduation.studentsInPeriod');
Route::get('/titulacion/estudiantes/{student}/documentos', [GraduationFilesController::class, 'studentFiles'])->name('graduationFiles.studentFiles');
Route::get('/api/graduationFiles/{student}', [GraduationFilesController::class, 'apiStudentFiles'])->name('api.graduationFiles.studentFiles');
//TODO: change studentFiles for graduationFiles for consistency

// Reviewers: Evaluadores
Route::get('/titulacion/evaluadores', [GraduationController::class, 'reviewers'])->name('graduation.reviewers');
Route::get('/titulacion/evaluadores/docente/{professor}', [GraduationController::class, 'processesByProfessor'])->name('graduation.processesByProfessor');
Route::prefix('api/titulacion/evaluadores')->group(function () {
    Route::get('/get-reviewers-by-students', [GraduationController::class, 'getReviewersByStudents'])
        ->name('api.graduation.getReviewersByStudents');
    Route::get('/get-reviewers-by-professors', [GraduationController::class, 'getReviewersByProfessors'])
        ->name('api.graduation.getReviewersByProfessors');
    Route::get('/reviewers/processes/professor/{professor}', [GraduationController::class, 'processesByProfessor'])->name('graduation.processesByProfessor');
    Route::get('/get-processes-as-advisor/{id}', [GraduationController::class, 'getProcessesAsAdvisor'])
        ->name('api.graduation.getProcessesAsAdvisor');
    Route::get('/get-processes-as-reader/{id}', [GraduationController::class, 'getProcessesAsReader'])
        ->name('api.graduation.getProcessesAsReader');
});

// Graduation statistics: Reportes de titulación
Route::get('/titulacion/reportes', [GraduationController::class, 'statistics'])->name('graduation.statistics');
Route::prefix('api/titulacion/reportes')->group(function () {
    Route::get('/rezagados', [GraduationController::class, 'getDelayedStudents'])->name('api.graduation.delayedStudents');
    Route::get('/numero-de-matricula', [GraduationController::class, 'getRegistrationTimes'])->name('api.graduation.registrationTimes');
    Route::get('/graduados-por-fecha/{start}/{end}', [GraduationController::class, 'getGraduatesByDate'])->name('api.graduation.graduatesByDate');
    Route::get('/documentacion-entregada', [GraduationFilesController::class, 'getSentDocummentation'])->name('api.graduationFiles.sentDocummentation');
});


// File management: Gestión de archivos

// General file management: Gestión de archivos en general
Route::put('/documentos/actualizar/{id}', [FileController::class, 'update'])->name('files.update');
Route::get('/documentos/descargar/{id}', [FileController::class, 'download'])->name('files.download');
Route::get('/documentos/abrir/{file_id}', [FileController::class, 'open'])->name('files.open');
Route::post('/documentos/guardar/{parentId}', [FileController::class, 'store'])->name('files.store');

// For graduation files: Para archivos de titulación
Route::post('/documentos/titulacion/{parentId}', [GraduationFilesController::class, 'storeFile'])->name('graduationFiles.storeFile');
Route::delete('/documentos/titulacion/eliminar/{student_id}/{index}/{file_id}', [FileController::class, 'destroyGraduation'])->name('files.destroyGraduation');

// GRADUATIONS MODULE END

/////////////////////////////////////////////////

// Temporary routes for testing
// Prácticas de vinculación
Route::get('/vinculacion/estudiantes', [CommunityController::class, 'Students'])->name('community.students');

// Community internship process by student: Proceso de prácticas de vinculación por estudiante
Route::get('/vinculacion/estudiantes/proceso/{student}', [CommunityController::class, 'graduation'])->name('community.process');
Route::get('/vinculacion/estudiantes/proceso/editar/{student}', [CommunityController::class, 'edit'])->name('community.processEdit');
Route::put('/vinculacion/estudiantes/proceso/actualizar/{graduation}', [CommunityController::class, 'update'])->name('community.update');

// Community internship by academic period: Proceso de prácticas de vinculación por periodo académico
Route::get('/vinculacion/periodos-academicos', [CommunityController::class, 'periods'])->name('community.periods');
Route::get('/vinculacion/periodos-academicos/{period}/estudiantes', [CommunityController::class, 'studentsInPeriod'])->name('community.studentsInPeriod');
Route::get('/vinculacion/estudiantes/{student}/documentos', [CommunityController::class, 'studentFiles'])->name('communityFiles.studentFiles');

Route::get('/vinculacion/proyectos', [CommunityController::class, 'projects'])->name('community.projects');


// Prácticas preprofesionales
Route::get('/laborales/estudiantes', [PreprofessionalController::class, 'Students'])->name('preprofessional.students');

// Preprofessional internship process by student: Proceso de prácticas preprofesionales por estudiante
Route::get('/laborales/estudiantes/proceso/{student}', [PreprofessionalController::class, 'preprofessional'])->name('preprofessional.process');
Route::get('/laborales/estudiantes/proceso/editar/{student}', [PreprofessionalController::class, 'edit'])->name('preprofessional.processEdit');
Route::put('/laborales/estudiantes/proceso/actualizar/{student}', [PreprofessionalController::class, 'updateProcess'])->name('preprofessional.updateProcess');

// Preprofessional internship process by academic period: Proceso de prácticas preprofesionales por periodo académico
Route::get('/laborales/periodos-academicos', [PreprofessionalController::class, 'periods'])->name('preprofessional.periods');
Route::get('/laborales/periodos-academicos/{period}/estudiantes', [PreprofessionalController::class, 'studentsInPeriod'])->name('preprofessional.studentsInPeriod');
Route::get('/laborales/estudiantes/{student}/documentos', [PreprofessionalController::class, 'studentFiles'])->name('preprofessional.studentFiles');
Route::get('/api/laborales/documentos/{student}', [PreprofessionalController::class, 'apiPreprofessionalFiles'])->name('api.preprofessional.preprofessionalFiles');
// For graduation files: Para archivos de titulación
Route::post('/documentos/laborales/{parentId}', [PreprofessionalController::class, 'storeFile'])->name('preprofessional.storeFile');
Route::delete('/documentos/laborales/eliminar/{student_id}/{index}/{file_id}', [FileController::class, 'destroyPreprofessional'])->name('files.destroyPreprofessional');

///////////
require __DIR__ . '/auth.php';
