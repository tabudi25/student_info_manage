<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'index'])->name('student.info');

Route::post('/insert', [StudentController::class, 'store'])->name('insert');

Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');

Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');

Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('student.delete');
