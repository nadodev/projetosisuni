<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\TurmaController;
use App\Http\Controllers\Admin\InstituicaoController;
use App\Http\Controllers\Admin\AnamneseController;
use App\Http\Controllers\Admin\EvolucaoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gerenciamento de Usuários
    Route::resource('users', UserController::class);

    // Gerenciamento de Campos
    Route::prefix('fields')->name('fields.')->group(function () {
        Route::get('/', [FieldController::class, 'index'])->name('index');
        Route::get('/create', [FieldController::class, 'create'])->name('create');
        Route::post('/', [FieldController::class, 'store'])->name('store');
        Route::get('/{field}/edit', [FieldController::class, 'edit'])->name('edit');
        Route::put('/{field}', [FieldController::class, 'update'])->name('update');
        Route::delete('/{field}', [FieldController::class, 'destroy'])->name('destroy');
        Route::post('/update-order', [FieldController::class, 'updateOrder'])->name('updateOrder');
    });

    // Gerenciamento de Formulários
    Route::prefix('forms')->name('forms.')->group(function () {
        Route::get('/', [FormController::class, 'index'])->name('index');
        Route::get('/create', [FormController::class, 'create'])->name('create');
        Route::post('/', [FormController::class, 'store'])->name('store');
        Route::get('/{form}', [FormController::class, 'show'])->name('show');
        Route::get('/{form}/edit', [FormController::class, 'edit'])->name('edit');
        Route::put('/{form}', [FormController::class, 'update'])->name('update');
        Route::delete('/{form}', [FormController::class, 'destroy'])->name('destroy');
        Route::get('/{form}/create-anamnese', [FormController::class, 'createAnamnese'])->name('create-anamnese');
        Route::post('/{form}/store-anamnese', [FormController::class, 'storeAnamnese'])->name('store-anamnese');
    });
    Route::resource('categorias', CategoriaController::class);

    // Gerenciamento de Turmas
    Route::get('/turmas', [TurmaController::class, 'index'])->name('turmas.index');
    Route::get('/turmas/create', [TurmaController::class, 'create'])->name('turmas.create');
    Route::post('/turmas', [TurmaController::class, 'store'])->name('turmas.store');
    Route::get('/turmas/{codigo}/edit', [TurmaController::class, 'edit'])->name('turmas.edit');
    Route::put('/turmas/{codigo}', [TurmaController::class, 'update'])->name('turmas.update');
    Route::delete('/turmas/{codigo}', [TurmaController::class, 'destroy'])->name('turmas.destroy');
    Route::get('/atribuir-turmas', [UserController::class, 'atribuirTurmasIndex'])->name('atribuir-turmas.index');
    Route::post('/atribuir-turmas/{user}', [UserController::class, 'atribuirTurma'])->name('atribuir-turmas.update');
    // Gerenciamento de Instituições
    Route::get('/instituicoes', [InstituicaoController::class, 'index'])->name('instituicoes.index');
    Route::get('/instituicoes/create', [InstituicaoController::class, 'create'])->name('instituicoes.create');
    Route::post('/instituicoes', [InstituicaoController::class, 'store'])->name('instituicoes.store');
    Route::get('/instituicoes/{instituicao}/edit', [InstituicaoController::class, 'edit'])->name('instituicoes.edit');
    Route::put('/instituicoes/{instituicao}', [InstituicaoController::class, 'update'])->name('instituicoes.update');
    Route::delete('/instituicoes/{instituicao}', [InstituicaoController::class, 'destroy'])->name('instituicoes.destroy');
    Route::get('/atribuir-turmas', [UserController::class, 'atribuirTurmasIndex'])->name('atribuir-turmas.index');
    Route::post('/atribuir-turmas/{user}', [UserController::class, 'atribuirTurma'])->name('atribuir-turmas.update');
    // Gerenciamento de Anamneses
    Route::resource('anamneses', AnamneseController::class);

    // Evoluções
    Route::prefix('anamneses/{anamnese}/evolucoes')->name('anamneses.evolucoes.')->group(function () {
        Route::get('/create', [EvolucaoController::class, 'create'])->name('create');
        Route::post('/', [EvolucaoController::class, 'store'])->name('store');
        Route::get('/{evolucao}/edit', [EvolucaoController::class, 'edit'])->name('edit');
        Route::put('/{evolucao}', [EvolucaoController::class, 'update'])->name('update');
        Route::delete('/{evolucao}', [EvolucaoController::class, 'destroy'])->name('destroy');
    });
});

