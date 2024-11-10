<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\TurmaController;
use App\Http\Controllers\Admin\InstituicaoController;
use App\Http\Controllers\Admin\AnamneseController;
use App\Http\Controllers\Admin\EvolucaoController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\InstitutionInviteController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Planos
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::put('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');

    // Convites Institucionais
    Route::get('/institution/invites', [InstitutionInviteController::class, 'index'])->name('institution.invites.index');
    Route::get('/institution/invites/create', [InstitutionInviteController::class, 'create'])->name('institution.invites.create');
    Route::post('/institution/invites', [InstitutionInviteController::class, 'store'])->name('institution.invites.store');

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

    // Gerenciamento de Turmas
    Route::get('/turmas', [TurmaController::class, 'index'])->name('turmas.index');
    Route::get('/turmas/create', [TurmaController::class, 'create'])->name('turmas.create');
    Route::post('/turmas', [TurmaController::class, 'store'])->name('turmas.store');
    Route::get('/turmas/{id}/edit', [TurmaController::class, 'edit'])->name('turmas.edit');
    Route::put('/turmas/{id}', [TurmaController::class, 'update'])->name('turmas.update');
    Route::delete('/turmas/{id}', [TurmaController::class, 'destroy'])->name('turmas.destroy');

    // Atribuição de Turmas
    Route::get('/atribuir-turmas', [TurmaController::class, 'atribuirTurmasIndex'])->name('atribuir-turmas.index');
    Route::post('/atribuir-turmas/{user}', [TurmaController::class, 'atribuirTurma'])->name('atribuir-turmas.update');

    // Gerenciamento de Instituições
    Route::get('/instituicoes', [InstituicaoController::class, 'index'])->name('instituicoes.index');
    Route::get('/instituicoes/create', [InstituicaoController::class, 'create'])->name('instituicoes.create');
    Route::post('/instituicoes', [InstituicaoController::class, 'store'])->name('instituicoes.store');
    Route::get('/instituicoes/{instituicao}/edit', [InstituicaoController::class, 'edit'])->name('instituicoes.edit');
    Route::put('/instituicoes/{instituicao}', [InstituicaoController::class, 'update'])->name('instituicoes.update');
    Route::delete('/instituicoes/{instituicao}', [InstituicaoController::class, 'destroy'])->name('instituicoes.destroy');

    // Gerenciamento de Anamneses
    Route::resource('anamneses', AnamneseController::class);

    // Rotas de Evolução
    Route::prefix('anamneses/{anamnese}/evolucoes')->name('anamneses.evolucoes.')->group(function () {
        Route::get('/create', [EvolucaoController::class, 'create'])->name('create');
        Route::post('/', [EvolucaoController::class, 'store'])->name('store');
        Route::get('/{evolucao}/edit', [EvolucaoController::class, 'edit'])->name('edit');
        Route::put('/{evolucao}', [EvolucaoController::class, 'update'])->name('update');
        Route::delete('/{evolucao}', [EvolucaoController::class, 'destroy'])->name('destroy');
    });

    // Rotas de Relatórios
    Route::get('/anamneses/{anamnese}/report/pdf', [ReportController::class, 'generatePDF'])->name('anamneses.report.pdf');
    Route::get('/anamneses/{anamnese}/report/excel', [ReportController::class, 'generateExcel'])->name('anamneses.report.excel');
    Route::get('/reports/student-progress', [ReportController::class, 'studentProgress'])->name('reports.student-progress');

    // Middleware de verificação de instituição para rotas específicas
    Route::middleware(['check.instituicao'])->group(function () {
        Route::get('/students/by-turma/{turma}', function($turma) {
            return User::where('role', 'user_student')
                ->where('codigo_turma', $turma)
                ->where('id_instituicao', auth()->user()->id_instituicao)
                ->orderBy('name')
                ->get(['id', 'name']);
        })->name('students.by-turma');
    });

    // Gerenciamento de Categorias
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});

