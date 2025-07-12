<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InstituicaoController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\InstitutionInviteController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TurmaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\Chat;
use App\Livewire\Calendar;
use App\Http\Controllers\InvitedRegisterController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;


Route::get('/', App\Livewire\Landing::class)->name('landing');

// Rotas legais
Route::get('/termos-uso', App\Livewire\TermosUso::class)->name('legal.terms');
Route::get('/politica-privacidade', App\Livewire\Privacidade::class)->name('legal.privacy');





// Rotas públicas para formulários
Route::get('forms/{uuid}', [FormController::class, 'show'])->name('forms.show');
Route::post('forms/{uuid}/submit', [FormController::class, 'submit'])->name('forms.submit');

// Rotas de autenticação
require __DIR__.'/auth.php';

// Rotas protegidas por autenticação
Route::middleware(['auth', 'verified'])->group(function () {
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

    // Student Routes
    Route::get('/students', \App\Livewire\Students\Index::class)->name('students.index');
    Route::get('/students/create', \App\Livewire\Students\Create::class)->name('students.create');
    Route::get('/students/{student}', \App\Livewire\Students\Show::class)->name('students.show');
    Route::get('/students/{student}/edit', \App\Livewire\Students\Edit::class)->name('students.edit');
    Route::get('/students/{student}/educational-profile', \App\Livewire\Students\EducationalProfile::class)
        ->name('students.educational-profile');
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

// Rotas administrativas
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Turmas
    Route::resource('turmas', TurmaController::class);
    
    // Instituições
    Route::resource('instituicoes', InstituicaoController::class);
    
    // Usuários
    Route::resource('users', UserController::class);
    
    // Planos
    Route::resource('plans', PlanController::class);
    
    // Convites
    Route::resource('institution-invites', InstitutionInviteController::class);
    
    // Relatórios
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
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


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return response()->json([
        'message' => 'Cache limpo com sucesso!'
    ]);
})->name('cache.clear');

// Rotas protegidas para visualização de respostas
Route::middleware(['auth'])->group(function () {
    Route::get('forms/{form}/responses', [FormController::class, 'responses'])->name('forms.responses');
    Route::get('forms/responses/{response}', [FormController::class, 'responseDetails'])->name('forms.responses.show');
});
