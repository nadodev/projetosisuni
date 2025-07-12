<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
    // Rotas de formulários para estudantes
    Route::get('/forms', [FormController::class, 'index'])->name('forms.index');
    Route::get('/forms/{form}', [FormController::class, 'show'])->name('forms.show');
    Route::post('/forms/{form}/submit', [FormController::class, 'submit'])->name('forms.submit');
});
