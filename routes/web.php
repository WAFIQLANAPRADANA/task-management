<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/tasks/export/pdf', [TaskController::class, 'exportPDF'])->name('tasks.export.pdf');
// Route::get('/tasks/export/pdf', [TaskController::class, 'exportPDF'])->name('tasks.export.pdf');
Route::get('/', [TaskController::class, 'index']);
Route::post('/store', [TaskController::class, 'store']);
Route::get('/status/{id}/{status}', [TaskController::class, 'updateStatus']);
Route::get('/delete/{id}', [TaskController::class, 'destroy']);
