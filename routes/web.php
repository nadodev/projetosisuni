<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Admin\InstitutionInviteController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Chat;
use App\Livewire\Calendar;
use App\Http\Controllers\InvitedRegisterController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ReportController;

// Rota principal
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rotas de autenticação
require __DIR__.'/auth.php';

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Rota de dashboard padrão que redireciona baseado na role
    Route::get('/dashboard', function () {
        $user = auth()->user();

        return match($user->role) {
            'user_admin' => redirect()->route('admin.dashboard'),
            'user_teacher' => redirect()->route('teacher.dashboard'),
            'user_student' => redirect()->route('student.dashboard'),
            default => redirect()->route('home'),
        };
    })->name('dashboard');

    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/update-institution', [ProfileController::class, 'updateInstitution'])
        ->name('profile.update-institution');
    Route::patch('/profile/address', [ProfileController::class, 'updateAddress'])
        ->name('profile.address');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])
        ->name('profile.photo');
});

// Rotas para registro de convidados (coloque antes das rotas que usam middleware auth)
Route::middleware(['guest'])->group(function () {
    Route::get('/register/invited/{token}', [InvitedRegisterController::class, 'showRegistrationForm'])
        ->name('invited.register.form');

    Route::post('/register/invited/{token}', [InvitedRegisterController::class, 'register'])
        ->name('invited.register');
});

// Carrega as rotas específicas
require __DIR__.'/admin.php';
require __DIR__.'/teacher.php';
require __DIR__.'/student.php';

// Rotas públicas
Route::get('/chat', Chat::class)->name('chat');
Route::get('/calendar', function() {
    return view('calendar', [
        'title' => 'Calendário'
    ]);
})->name('calendar');

// Rotas de convite para instituição
Route::get('/institution/invite/{token}', [InstitutionInviteController::class, 'accept'])
    ->name('institution.invite.accept');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/institution/invites/create', [InstitutionInviteController::class, 'create'])
        ->name('institution.invites.create');
    Route::post('/institution/invites', [InstitutionInviteController::class, 'store'])
        ->name('institution.invites.store');

    // Rotas de planos
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::put('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');

    // Rotas de convites
    Route::get('/institution/invites', [InstitutionInviteController::class, 'index'])
        ->name('institution.invites.index');

    // Rotas de relatórios
    Route::prefix('admin/reports')->name('admin.reports.')->group(function () {
        Route::get('/turmas', [ReportController::class, 'turmas'])->name('turmas');
        Route::get('/turmas/pdf', [ReportController::class, 'exportTurmasPDF'])->name('turmas.pdf');
        Route::get('/categorias', [ReportController::class, 'categorias'])->name('categorias');
        Route::get('/categorias/pdf', [ReportController::class, 'exportCategoriasPDF'])->name('categorias.pdf');
        Route::get('/estudantes', [ReportController::class, 'estudantes'])->name('estudantes');
        Route::get('/professores', [ReportController::class, 'professores'])->name('professores');
        Route::get('/usuarios-por-categoria', [ReportController::class, 'usuariosPorCategoria'])->name('usuarios-por-categoria');
    });
});

// Rotas que precisam de endereço completo
Route::middleware(['auth', 'require.address'])->group(function () {
    // Suas rotas aqui
    Route::get('/calendar', function() {
        return view('calendar', [
            'title' => 'Calendário'
        ]);
    })->name('calendar');
});

// Rotas que não precisam de endereço completo
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // ... outras rotas ...
});

// Rotas do calendário específicas para cada tipo de usuário
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/calendar', function () {
        return view('admin.calendar');
    })->name('admin.calendar');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/teacher/calendar', function () {
        return view('teacher.calendar');
    })->name('teacher.calendar');
});

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/student/calendar', function () {
        return view('student.calendar');
    })->name('student.calendar');
});

Route::get('/admin/reports/usuarios-por-categoria/pdf', [ReportController::class, 'exportUsuariosPorCategoriaPDF'])
    ->name('admin.reports.usuarios-por-categoria.pdf');

Route::get('/admin/reports/professores/pdf', [ReportController::class, 'exportProfessoresPDF'])
    ->name('admin.reports.professores.pdf');

Route::get('/admin/reports/estudantes/pdf', [ReportController::class, 'exportEstudantesPDF'])
    ->name('admin.reports.estudantes.pdf');
