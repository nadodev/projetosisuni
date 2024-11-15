<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\TurmaController;
use App\Http\Controllers\Admin\InstituicaoController;
use App\Http\Controllers\Admin\InstitutionInviteController;
use App\Http\Controllers\Admin\UserInstitutionController;
use App\Http\Controllers\Admin\AnamneseController;
use App\Http\Controllers\Admin\EvolucaoController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::resource('users', UserController::class);
    Route::get('/users/{user}/institutions', [UserInstitutionController::class, 'edit'])->name('users.institutions.edit');
    Route::put('/users/{user}/institutions', [UserInstitutionController::class, 'update'])->name('users.institutions.update');

    // Instituições
    Route::resource('instituicoes', InstituicaoController::class);

    Route::delete('/instituicoes/{instituicao}', [InstituicaoController::class, 'destroy'])->name('instituicoes.destroy');

    // Convites de Instituição
    Route::prefix('institution')->name('institution.')->group(function () {
        Route::get('/invites', [InstitutionInviteController::class, 'index'])->name('invites.index');
        Route::get('/invites/create', [InstitutionInviteController::class, 'create'])->name('invites.create');
        Route::post('/invites', [InstitutionInviteController::class, 'store'])->name('invites.store');
        Route::delete('/invites/{invite}', [InstitutionInviteController::class, 'destroy'])->name('invites.destroy');
    });

    // Planos
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
    Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
    Route::get('/plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    Route::put('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
    Route::delete('/plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');

    // Forms
    Route::resource('forms', FormController::class);
    Route::post('/forms/update-order', [FormController::class, 'updateOrder'])->name('forms.updateOrder');
    Route::get('/forms/{form}/create-anamnese', [FormController::class, 'createAnamnese'])
        ->name('forms.create-anamnese');
    Route::post('/forms/{form}/create-anamnese', [FormController::class, 'storeAnamnese'])
        ->name('forms.store-anamnese');

    // Fields
    Route::resource('fields', FieldController::class);
    Route::post('fields/update-order', [FieldController::class, 'updateOrder'])->name('fields.update-order');

    // Turmas
    Route::resource('turmas', TurmaController::class);
    Route::get('/atribuir-turmas', [TurmaController::class, 'atribuirTurmasIndex'])->name('atribuir-turmas.index');
    Route::get('/atribuir-turmas/{user}/edit', [TurmaController::class, 'atribuirTurmasEdit'])->name('atribuir-turmas.edit');
    Route::post('/atribuir-turmas/{user}', [TurmaController::class, 'atribuirTurma'])->name('atribuir-turmas.update');

    // Anamneses
    Route::resource('anamneses', AnamneseController::class);
    Route::get('/anamneses/{anamnese}/evolucoes/create', [EvolucaoController::class, 'create'])->name('anamneses.evolucoes.create');
    Route::post('/anamneses/{anamnese}/evolucoes', [EvolucaoController::class, 'store'])->name('anamneses.evolucoes.store');
    Route::get('/anamneses/{anamnese}/evolucoes/{evolucao}/edit', [EvolucaoController::class, 'edit'])->name('anamneses.evolucoes.edit');
    Route::put('/anamneses/{anamnese}/evolucoes/{evolucao}', [EvolucaoController::class, 'update'])->name('anamneses.evolucoes.update');
    Route::delete('/anamneses/{anamnese}/evolucoes/{evolucao}', [EvolucaoController::class, 'destroy'])->name('anamneses.evolucoes.destroy');

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/anamneses', [ReportController::class, 'anamneses'])->name('anamneses');
        Route::get('/anamneses/pdf', [ReportController::class, 'exportAnamneseListPDF'])->name('anamneses.pdf');
        Route::get('/anamnese/{anamnese}/pdf', [ReportController::class, 'exportAnamnesePDF'])->name('anamnese.pdf');
        Route::get('/anamnese/{anamnese}/excel', [ReportController::class, 'generateExcel'])->name('anamnese.excel');
    });
});

