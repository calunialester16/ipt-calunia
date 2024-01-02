<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\GradeController;

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

Route::get('/', [AuthController::class, 'loginForm' ])->name('login');
Route::get('/register', [AuthController::class, 'registerForm' ]);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login');


     Route::get('/students', [StudentController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('students.index');
     Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
     Route::post('/students', [StudentController::class, 'store'])->name('students.store');
     Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
     Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
     Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
     Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
     Route::get('/student-logs', [LogController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('student-logs');

     Route::get('students/{student}/grades', [GradeController::class, 'create'])->name('grades.create');
     Route::post('students/{student}/grades', [GradeController::class, 'store'])->name('grades.store');



Route::get('verification/{user}/{token}', [AuthController::class, 'verification']);






