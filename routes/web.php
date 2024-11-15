<?php

use Illuminate\Support\Facades\Route;

// Rota para a página inicial
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rotas de autenticação (Breeze já configura automaticamente)
require __DIR__.'/auth.php';

// Rota de redirecionamento após login
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'user_admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'user_teacher') {
        return redirect()->route('teacher.dashboard');
    }

    if ($user->role === 'user_student') {
        return redirect()->route('student.dashboard');
    }

    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');
