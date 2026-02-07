<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController; // <--- AJOUTE ÇA
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// MODIFIE CETTE ROUTE pour qu'elle utilise le Controller
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');

    // CRUD des tâches
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';