<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TurmaController;
use App\Http\Controllers\Admin\InstituicaoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gerenciamento de Usuários
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Gerenciamento de Formulários
    Route::resource('forms', FormController::class);
    Route::get('forms/{form}/responses', [FormController::class, 'responses'])->name('forms.responses');

    // Gerenciamento de Campos
    Route::resource('fields', FieldController::class);
    Route::post('fields/update-order', [FieldController::class, 'updateOrder'])->name('fields.updateOrder');

    // Gerenciamento de Eventos
    Route::resource('events', EventController::class);

    // Gerenciamento de Turmas
    Route::resource('turmas', TurmaController::class);

    // Gerenciamento de Instituições
    Route::resource('instituicoes', InstituicaoController::class);
});

