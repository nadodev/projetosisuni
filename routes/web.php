<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Chat;
use App\Livewire\Calendar;

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
});

// Carrega as rotas específicas
require __DIR__.'/admin.php';
require __DIR__.'/teacher.php';
require __DIR__.'/student.php';

// Rotas públicas
Route::get('/chat', Chat::class)->name('chat');
Route::get('/calendar', Calendar::class)->name('calendar');
