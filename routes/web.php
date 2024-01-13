<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\SubjectController;
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

Route::get('/dashboard', [DashboardController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [DashboardController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');


Route::patch('/user/edit/{id}', [AdminController::class, 'editUser']
)->middleware('checkAdmin')->name('editUser');

Route::get('/user/edit/{id}', [AdminController::class, 'editUserForm']
)->name('editUserForm')->middleware('checkAdmin');

Route::get('/user/delete/{id}', [AdminController::class, 'deleteUser']
)->name('deleteUser')->middleware('checkAdmin');

Route::post('/subject/add', [SubjectController::class, 'addSubject']
)->name('addSubject')->middleware('checkAdmin');

Route::get('/subject/add', [SubjectController::class, 'addSubjectForm']
)->name('addSubjectForm')->middleware('checkAdmin');

Route::post('/enroll', [AdminController::class, 'enroll']
)->name('enroll')->middleware('checkAdmin');

Route::get('/enroll/', [AdminController::class, 'enrollForm']
)->name('enrollForm')->middleware('checkAdmin');

Route::get('/enrollments/', [AdminController::class, 'enrollments']
)->name('enrollments')->middleware('checkAdmin');

Route::patch('/enrollments', [AdminController::class, 'setMark']
)->name('setMark')->middleware('checkAdmin');


require __DIR__.'/auth.php';
