<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [EmployeeController::class, 'loginEmployee']);

Route::get('employee/', function () {return view('employee/index');})
->middleware(['auth', 'verified'])->name('index');

Route::get('employee/create', function () {return view('employee/create');})
->middleware(['auth', 'verified'])->name('create');

Route::post('employee/create', [EmployeeController::class, 'createEmployee'])
->middleware(['auth', 'verified'])->name('create');

Route::get('employee/search', [EmployeeController::class, 'searchEmployee'])
->middleware(['auth', 'verified'])->name('search');

Route::get('employee/update/{worker_id?}', [EmployeeController::class, 'getUpdateEmployee'])
->middleware(['auth', 'verified'])->name('update');

Route::post('employee/update/{worker_id}', [EmployeeController::class, 'updateEmployee'])
->middleware(['auth', 'verified'])->name('post.update');

Route::get('employee/delete/{worker_id?}', [EmployeeController::class, 'getDeleteEmployee'])
->middleware(['auth', 'verified'])->name('delete');

Route::post('employee/delete/{worker_id}', [EmployeeController::class, 'deleteEmployee'])
->middleware(['auth', 'verified'])->name('post.delete');

Route::post('employee/update/{worker_id}', [EmployeeController::class, 'updateEmployee'])
->middleware(['auth', 'verified'])->name('post.update');

Route::get('employee/password/update', function () {return view('employee/update_password');})
->middleware(['auth', 'verified'])->name('password.update');

Route::post('employee/password/update', [EmployeeController::class, 'updatePassword'])
->middleware(['auth', 'verified'])->name('post.password.update');

Route::get('employee/password/reset/{worker_id}', [EmployeeController::class, 'resetPassword'])
->middleware(['auth', 'verified'])->name('password.reset');

require __DIR__.'/auth.php';
