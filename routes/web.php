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
Route::get('/calendar', Calendar::class)->name('calendar');

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
});

// Adicione o middleware nas rotas que precisam de endereço completo
Route::middleware(['auth', 'check.address'])->group(function () {
    // Rotas que precisam de endereço completo
});
