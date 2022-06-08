<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\EmployeeController;

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

/*Route::get('/', function () {
    return view('general.dashboard');
});*/
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::get('/', [GeneralController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [GeneralController::class, 'profile'])->name('profile');

Route::get('employees', [EmployeeController::class, 'index'])->name('employees');
Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees-create');
Route::post('employees/save', [EmployeeController::class, 'save'])->name('employees.save');
Route::get('employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees-edit');
Route::post('employees/{id}/update', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('employees/{id}/destroy', [EmployeeController::class, 'destroy'])->name('employees.destroy');
