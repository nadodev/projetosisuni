<?php

use App\Http\Controllers\FieldController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PlanoDeEnsinoController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Chat;
use App\Livewire\Calendar;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/plano-de-ensino/cadastrar', [PlanoDeEnsinoController::class, 'index'])->name('plano.index');
Route::get('/plano-de-ensino/listar', [PlanoDeEnsinoController::class, 'listar'])->name('plano.listar');

// Rotas para campos
Route::get('/fields/create', [FieldController::class, 'create'])->name('fields.create');
Route::post('/fields', [FieldController::class, 'store'])->name('fields.store');

// Rotas para formulários
Route::get('/forms/create', [FormController::class, 'create'])->name('forms.create');
Route::post('/forms', [FormController::class, 'store'])->name('forms.store');

// Rota para exibir formulário
Route::get('/forms/{form}', [FormController::class, 'show'])->name('forms.show');

// Rotas sem autenticação
Route::get('/chat', Chat::class)->name('chat');
Route::get('/calendar', Calendar::class)->name('calendar');

Route::post('/forms/{form}/submit', [FormController::class, 'submit'])->name('forms.submit');
Route::get('/forms/{form}/responses', [FormController::class, 'responses'])->name('forms.responses');

Route::get('/forms', [FormController::class, 'index'])->name('forms.index');

Route::get('/forms/{form}/edit', [FormController::class, 'edit'])->name('forms.edit');
Route::put('/forms/{form}', [FormController::class, 'update'])->name('forms.update');

Route::delete('/forms/{form}', [FormController::class, 'destroy'])->name('forms.destroy');
Route::delete('/fields/{field}', [FieldController::class, 'destroy'])->name('fields.destroy');

Route::get('/fields', [FieldController::class, 'index'])->name('fields.index');
Route::get('/fields/{field}', [FieldController::class, 'show'])->name('fields.show');
Route::get('/fields/{field}/edit', [FieldController::class, 'edit'])->name('fields.edit');
Route::put('/fields/{field}', [FieldController::class, 'update'])->name('fields.update');
Route::delete('/fields/{field}', [FieldController::class, 'destroy'])->name('fields.destroy');
