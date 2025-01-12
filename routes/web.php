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
use App\Http\Controllers\CommunityProjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ThesisAreaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\GraduationFilesController;
use App\Http\Controllers\PreprofessionalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RoleUserController;

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
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/inicio', [DashboardController::class, 'index'])->name('dashboard');
});

// User profile: Perfil de usuario
Route::middleware('auth:sanctum')->group(function () {
    //TODO: review: users cannot change user info
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Students: Estudiantes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/estudiantes', [StudentController::class, 'index'])->name('students.index');
    Route::get('/estudiantes/crear', [StudentController::class, 'create'])->name('students.create');
    Route::get('/estudiantes/editar/{student}', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/estudiantes/actualizar/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::post('/estudiantes/guardar', [StudentController::class, 'store'])->name('students.store');
    Route::get('/estudiantes/{student}/perfil', [StudentController::class, 'profile'])->name('students.profile');
    Route::put('/estudiantes/buscar', [StudentController::class, 'fetch'])->name('students.fetch');
    Route::prefix('api')->group(function () {
        Route::get('/estudiantes', [StudentController::class, 'apiIndex'])->name('api.students.index');
        Route::delete('/estudiantes/{id}', [StudentController::class, 'destroy'])->name('api.students.destroy');
        Route::put('/estudiantes/quitar/{id}', [StudentController::class, 'remove'])->name('api.students.remove');

    });
});

// Professors: Docentes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/docentes', [ProfessorController::class, 'index'])->name('professors.index');
    Route::get('/docentes/crear', [ProfessorController::class, 'create'])->name('professors.create');
    Route::get('/docentes/editar/{professor}', [ProfessorController::class, 'edit'])->name('professors.edit');
    Route::put('/docentes/actualizar/{professor}', [ProfessorController::class, 'update'])->name('professors.update');
    Route::post('/docentes/guardar', [ProfessorController::class, 'store'])->name('professors.store');
    Route::get('/docentes/{professor}/perfil', [ProfessorController::class, 'profile'])->name('professors.profile');
    Route::put('/docentes/buscar', [ProfessorController::class, 'fetch'])->name('professors.fetch');
    Route::prefix('api')->group(function () {
        Route::get('/docentes', [ProfessorController::class, 'apiIndex'])->name('api.professors.index');
        Route::delete('/docentes/{id}', [ProfessorController::class, 'destroy'])->name('api.professors.destroy');
        Route::put('/docentes/quitar/{id}', [ProfessorController::class, 'remove'])->name('api.professors.remove');
    });
});

////---------Settings----------////
// Academic periods: Periodos académicos
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/periodos-academicos', [AcademicPeriodController::class, 'apiIndex'])->name('api.academicPeriods.index');
        Route::post('/periodos-academicos', [AcademicPeriodController::class, 'store'])->name('api.academicPeriods.store');
        Route::put('/periodos-academicos/{period}', [AcademicPeriodController::class, 'update'])->name('api.academicPeriods.update');
        Route::put( '/periodos-academicos/quitar/{id}', [AcademicPeriodController::class, 'remove'])->name('api.academicPeriods.remove');
        Route::delete('/periodos-academicos/{period}', [AcademicPeriodController::class, 'destroy'])->name('api.academicPeriods.destroy');
    });
});
// Courses: Carreras
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/carreras', [CourseController::class, 'apiIndex'])->name('api.courses.index');
        Route::post('/carreras', [CourseController::class, 'store'])->name('api.courses.store');
        Route::put('/carreras/{course}', [CourseController::class, 'update'])->name('api.courses.update');
        Route::put('/carreras/quitar/{id}', [CourseController::class, 'remove'])->name('api.courses.remove');
        Route::delete('/carreras/{course}', [CourseController::class, 'destroy'])->name('api.courses.destroy');
    });
});

// Thesis areas: Áreas de titulación
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/areas-titulacion', [ThesisAreaController::class, 'apiIndex'])->name('api.thesisAreas.index');
        Route::post('/areas-titulacion', [ThesisAreaController::class, 'store'])->name('api.thesisAreas.store');
        Route::put('/areas-titulacion/{area}', [ThesisAreaController::class, 'update'])->name('api.thesisAreas.update');
        Route::put('/areas-titulacion/quitar/{id}', [ThesisAreaController::class, 'remove'])->name('api.thesisAreas.remove');
        Route::delete('/areas-titulacion/{area}', [ThesisAreaController::class, 'destroy'])->name('api.thesisAreas.destroy');
    });
});

// Roles
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/roles', [RoleController::class, 'apiIndex'])->name('api.roles.index');
        Route::post('/roles', [RoleController::class, 'store'])->name('api.roles.store');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->name('api.roles.update');
        Route::put('/roles/quitar/{id}', [RoleController::class, 'remove'])->name('api.roles.remove');
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('api.roles.destroy');
    });
});

// Permissions: Permisos
//TODO: check if permissions are needed at all
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/permisos', [PermissionController::class, 'apiIndex'])->name('api.permissions.index');
        Route::post('/permisos', [PermissionController::class, 'store'])->name('api.permissions.store');
        Route::put('/permisos/{permission}', [PermissionController::class, 'update'])->name('api.permissions.update');
        Route::delete('/permisos/{permission}', [PermissionController::class, 'destroy'])->name('api.permissions.destroy');
    });
});

// Users: Usuarios
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/usuarios', [RoleUserController::class, 'apiIndex'])->name('api.users.index');
        Route::post('/usuarios', [RoleUserController::class, 'store'])->name('api.users.store');
        Route::put('/usuarios/{role_user}', [RoleUserController::class, 'update'])->name('api.users.update');
        Route::put('/usuarios/quitar/{id}', [UserController::class, 'remove'])->name('api.users.remove');
        Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('api.users.destroy');
    });
});

// Settings menu: Menú de configuración
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/configuracion/periodos-academicos', [AcademicPeriodController::class, 'index'])->name('academicPeriods.index');
    Route::get('/configuracion/carreras', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/configuracion/areas-titulacion', [ThesisAreaController::class, 'index'])->name('thesisAreas.index');
    Route::get('/configuracion/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/configuracion/permisos', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/configuracion/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/configuracion', [SettingsController::class, 'index'])->name('settings.index');
});


////---------Graduations----------////
// Graduation process by student: Proceso de titulación por estudiante
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/titulacion/estudiantes', [GraduationController::class, 'Students'])->name('graduation.students');
    Route::get('/titulacion/estudiantes/proceso/{student}', [GraduationController::class, 'graduation'])->name('graduation.process');
    Route::get('/titulacion/estudiantes/proceso/editar/{student}', [GraduationController::class, 'edit'])->name('graduation.processEdit');
    Route::put('/titulacion/estudiantes/proceso/actualizar/{graduation}', [GraduationController::class, 'update'])->name('graduation.update');
});
// Graduation process by academic period: Proceso de titulación por periodo académico
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/titulacion/periodos-academicos', [GraduationController::class, 'periods'])->name('graduation.periods');
    Route::get('/titulacion/periodos-academicos/{period}/estudiantes', [GraduationController::class, 'studentsInPeriod'])->name('graduation.studentsInPeriod');
    Route::get('/titulacion/estudiantes/{student}/documentos', [GraduationFilesController::class, 'studentFiles'])->name('graduationFiles.studentFiles');
    Route::get('/api/documentos/titulacion/{student}', [GraduationFilesController::class, 'apiStudentFiles'])->name('api.graduationFiles.studentFiles');
});
// Reviewers: Evaluadores
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/titulacion/evaluadores', [GraduationController::class, 'reviewers'])->name('graduation.reviewers');
    Route::get('/titulacion/evaluadores/docente/procesos/{professor}', [GraduationController::class, 'processesByProfessor'])->name('graduation.processesByProfessor');
    Route::prefix('api/titulacion/evaluadores')->group(function () {
        Route::get('/get-reviewers-by-students/{id}', [GraduationController::class, 'getReviewersByStudents'])
            ->name('api.graduation.getReviewersByStudents');
        Route::get('/get-reviewers-by-professors', [GraduationController::class, 'getReviewersByProfessors'])
            ->name('api.graduation.getReviewersByProfessors');
        Route::get('/get-processes-as-advisor/{professor}/{period}', [GraduationController::class, 'getProcessesAsAdvisor'])
            ->name('api.graduation.getProcessesAsAdvisor');
        Route::get('/get-processes-as-reader/{professor}/{period}', [GraduationController::class, 'getProcessesAsReader'])
            ->name('api.graduation.getProcessesAsReader');
    });
});
// General file management: Gestión de archivos en general
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/documentos/actualizar/{id}', [FileController::class, 'update'])->name('files.update');
    Route::get('/documentos/descargar/{id}', [FileController::class, 'download'])->name('files.download');
    Route::get('/documentos/abrir/{file_id}', [FileController::class, 'open'])->name('files.open');
    Route::get('/documentos/info/{id}', [FileController::class, 'fileInfo'])->name('files.info');
    Route::post('/documentos/guardar/{parentId}', [FileController::class, 'store'])->name('files.store');
});
// Graduation files: Archivos de titulación
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/documentos/titulacion/{parentId}', [GraduationFilesController::class, 'storeFile'])->name('graduationFiles.storeFile');
    Route::delete('/documentos/titulacion/eliminar/{student_id}/{index}/{file_id}', [FileController::class, 'destroyGraduation'])->name('files.destroyGraduation');
});

////---------Community internships----------////
// Community internship process: Proceso de prácticas de vinculación
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/vinculacion/estudiantes', [CommunityController::class, 'Students'])->name('community.students');
    Route::get('/vinculacion/estudiantes/proceso/{student}', [CommunityController::class, 'community'])->name('community.process');
    Route::get('/vinculacion/estudiantes/proceso/editar/{student}', [CommunityController::class, 'edit'])->name('community.processEdit');
    Route::put('/vinculacion/estudiantes/proceso/actualizar/{student}', [CommunityController::class, 'updateProcess'])->name('community.updateProcess');
    Route::get('/vinculacion/periodos-academicos', [CommunityController::class, 'periods'])->name('community.periods');
    Route::get('/vinculacion/periodos-academicos/{period}/estudiantes', [CommunityController::class, 'studentsInPeriod'])->name('community.studentsInPeriod');
    Route::get('/vinculacion/estudiantes/{student}/documentos', [CommunityController::class, 'studentFiles'])->name('community.studentFiles');
    Route::get('/api/vinculacion/documentos/{student}', [CommunityController::class, 'apiCommunityFiles'])->name('api.community.communityFiles');
    Route::post('/documentos/vinculacion/{parentId}', [CommunityController::class, 'storeFile'])->name('community.storeFile');
    Route::delete('/documentos/vinculacion/eliminar/{student_id}/{index}/{file_id}', [FileController::class, 'destroyCommunity'])->name('files.destroyCommunity');
});

////---------Community internship projects----------////
// Community internship projects: Proyectos de prácticas de vinculación
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/vinculacion/proyectos', [CommunityProjectController::class, 'projects'])->name('community.projects.index');
    Route::prefix('api/vinculacion')->group(function () {
        Route::get('/proyectos', [CommunityProjectController::class, 'apiIndex'])->name('api.community.projects.index');
        Route::post('/proyectos', [CommunityProjectController::class, 'store'])->name('api.community.projects.store');
        Route::put('/proyectos/{project}', [CommunityProjectController::class, 'update'])->name('api.community.projects.update');
        Route::put('/proyectos/quitar/{id}', [CommunityProjectController::class, 'remove'])->name('api.community.projects.remove');
        Route::delete('/proyectos/{project}', [CommunityProjectController::class, 'destroy'])->name('api.community.projects.destroy');
    });
    Route::get('/vinculacion/proyectos/{project}/estudiantes', [CommunityController::class, 'studentsInProject'])->name('community.projects.studentsInProject');
    Route::get('/api/vinculacion/proyectos/{project}/estudiantes', [CommunityController::class, 'apiStudentsInProject'])->name('api.community.projects.studentsInProject');
    Route::put('/api/vinculacion/proyectos/quitar/estudiante/{student}', [CommunityController::class, 'removeStudentFromProject'])->name('api.community.projects.removeStudentFromProject');
    Route::put('/api/vinculacion/proyectos/agregar/{student}/{project}', [CommunityController::class, 'addStudentToProject'])->name('api.community.projects.addStudentToProject');
});
// Community internship files: Archivos de projectos de vinculación
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/api/vinculacion/documentos/proyecto/{project}', [CommunityProjectController::class, 'apiProjectFiles'])->name('api.community.project.projectFiles');
    Route::post('/documentos/vinculacion/proyecto/{parentId}', [CommunityProjectController::class, 'storeFile'])->name('community.project.storeFile');
    Route::delete('/documentos/vinculacion/proyecto/eliminar/{project_id}/{index}/{file_id}', [FileController::class, 'destroyProject'])->name('files.destroyProject');
});

////---------Preprofessional internships----------////
// Preprofessional internship process: Proceso de prácticas preprofesionales
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/laborales/estudiantes', [PreprofessionalController::class, 'Students'])->name('preprofessional.students');
    Route::get('/laborales/estudiantes/proceso/{student}', [PreprofessionalController::class, 'preprofessional'])->name('preprofessional.process');
    Route::get('/laborales/estudiantes/proceso/editar/{student}', [PreprofessionalController::class, 'edit'])->name('preprofessional.processEdit');
    Route::put('/laborales/estudiantes/proceso/actualizar/{student}', [PreprofessionalController::class, 'updateProcess'])->name('preprofessional.updateProcess');
    Route::get('/laborales/periodos-academicos', [PreprofessionalController::class, 'periods'])->name('preprofessional.periods');
    Route::get('/laborales/periodos-academicos/{period}/estudiantes', [PreprofessionalController::class, 'studentsInPeriod'])->name('preprofessional.studentsInPeriod');
    Route::get('/laborales/estudiantes/{student}/documentos', [PreprofessionalController::class, 'studentFiles'])->name('preprofessional.studentFiles');
    Route::get('/api/laborales/documentos/{student}', [PreprofessionalController::class, 'apiPreprofessionalFiles'])->name('api.preprofessional.preprofessionalFiles');
});
// Preprofessional internship files: Archivos de prácticas laborales
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/documentos/laborales/{parentId}', [PreprofessionalController::class, 'storeFile'])->name('preprofessional.storeFile');
    Route::delete('/documentos/laborales/eliminar/{student_id}/{index}/{file_id}', [FileController::class, 'destroyPreprofessional'])->name('files.destroyPreprofessional');
});

////---------Search----------////
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/buscar', action: [SearchController::class, 'search'])->name('search');
});

// Statistical reports: Reportes estadisticos
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/reportes', [DashboardController::class, 'reports'])->name('menu.reports');
    Route::prefix('api/reportes')->group(function () {
        Route::get('/titulacion/rezagados/{id}', [GraduationController::class, 'getDelayedStudents'])->name('api.graduation.delayedStudents');
        Route::get('/titulacion/numero-de-matricula/{id}', [GraduationController::class, 'getRegistrationTimes'])->name('api.graduation.registrationTimes');
        Route::get('/titulacion/graduados-por-fecha/{start}/{end}', [GraduationController::class, 'getGraduatesByDate'])->name('api.graduation.graduatesByDate');
        Route::get('/titulacion/documentacion-entregada/{id}', [GraduationFilesController::class, 'getSentDocumentation'])->name('api.graduationFiles.sentDocumentation');
        Route::get('/vinculacion/documentacion-entregada/{id}', [CommunityController::class, 'getSentDocumentation'])->name('api.community.sentDocumentation');
        Route::get('/preprofesionales/documentacion-entregada/{id}', [PreprofessionalController::class, 'getSentDocumentation'])->name('api.preprofessional.sentDocumentation');
        Route::get('/proyecto-vinculacion/documentacion-entregada/{id}', [CommunityProjectController::class, 'getSentDocumentation'])->name('api.community.project.sentDocumentation');
    });
});

////
require __DIR__ . '/auth.php';
