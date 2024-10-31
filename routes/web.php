<?php

use App\Http\Controllers\PlanoDeEnsinoController;
use Illuminate\Support\Facades\Route;

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
