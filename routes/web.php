<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

Route::prefix('tasks')->group(function () {
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/edit/{task}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/update/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/delete/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/update-priorities', [TaskController::class, 'updatePriorities'])->name('tasks.update-priorities');

});

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/edit/{project}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/update/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/delete/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});
