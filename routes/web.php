<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas de autenticação
require __DIR__.'/auth.php';

// Rotas protegidas
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Adicione esta rota junto com as outras rotas de perfil
    Route::get('/profile/photo', function () {
        return auth()->user()->getProfilePhotoUrlAttribute();
    })->middleware(['auth'])->name('profile.photo');

    Route::get('/profile/address', function () {
        return auth()->user()->address;
    })->name('profile.address');
});

// Carrega as rotas admin
require __DIR__.'/admin.php';
