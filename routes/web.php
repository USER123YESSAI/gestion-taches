<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\TaskController;

Route::middleware(['auth', 'verified'])->group(function () {
    // Route principale du dashboard qui affiche les tâches
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    
    // Routes CRUD pour les tâches
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});