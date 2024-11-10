<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TurmaController;
use App\Http\Controllers\Admin\InstituicaoController;
use App\Http\Controllers\Admin\CategoriaController;
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

    // Gerenciamento de Turmas
    Route::get('/turmas', [TurmaController::class, 'index'])->name('turmas.index');
    Route::get('/turmas/create', [TurmaController::class, 'create'])->name('turmas.create');
    Route::post('/turmas', [TurmaController::class, 'store'])->name('turmas.store');
    Route::get('/turmas/{id}/edit', [TurmaController::class, 'edit'])->name('turmas.edit');
    Route::put('/turmas/{id}', [TurmaController::class, 'update'])->name('turmas.update');
    Route::delete('/turmas/{id}', [TurmaController::class, 'destroy'])->name('turmas.destroy');

    // Gerenciamento de Instituições
    Route::get('/instituicoes', [InstituicaoController::class, 'index'])->name('instituicoes.index');
    Route::get('/instituicoes/create', [InstituicaoController::class, 'create'])->name('instituicoes.create');
    Route::post('/instituicoes', [InstituicaoController::class, 'store'])->name('instituicoes.store');
    Route::get('/instituicoes/{instituicao}/edit', [InstituicaoController::class, 'edit'])->name('instituicoes.edit');
    Route::put('/instituicoes/{instituicao}', [InstituicaoController::class, 'update'])->name('instituicoes.update');
    Route::delete('/instituicoes/{instituicao}', [InstituicaoController::class, 'destroy'])->name('instituicoes.destroy');

    // Gerenciamento de Formulários
    Route::resource('forms', FormController::class);
    Route::get('forms/{form}/responses', [FormController::class, 'responses'])->name('forms.responses');

    // Gerenciamento de Campos
    Route::resource('fields', FieldController::class);
    Route::post('fields/update-order', [FieldController::class, 'updateOrder'])->name('fields.updateOrder');

    // Gerenciamento de Eventos
    Route::resource('events', EventController::class);

    // Adicione dentro do grupo de rotas admin
    Route::get('/atribuir-turmas', [UserController::class, 'atribuirTurmasIndex'])->name('atribuir-turmas.index');
    Route::post('/atribuir-turmas/{user}', [UserController::class, 'atribuirTurma'])->name('atribuir-turmas.update');

    // Adicione junto com as outras rotas
    Route::resource('categorias', CategoriaController::class);
});

