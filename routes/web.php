<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\IntakeController;
use App\Http\Controllers\StudentController;

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

Route::get('agents', [AgentController::class, 'index'])->name('agents');
Route::get('agents/create', [AgentController::class, 'create'])->name('agents-create');
Route::post('agents/save', [AgentController::class, 'save'])->name('agents.save');
Route::get('agents/{id}/edit', [AgentController::class, 'edit'])->name('agents-edit');
Route::post('agents/{id}/update', [AgentController::class, 'update'])->name('agents.update');
Route::delete('agents/{id}/destroy', [AgentController::class, 'destroy'])->name('agents.destroy');
Route::post('api/fetch-provinces', [AgentController::class, 'fetch_provinces'])->name('fetch-provinces');

Route::get('programs', [ProgramController::class, 'index'])->name('programs');
Route::post('programs/save', [ProgramController::class, 'save'])->name('programs.save');
Route::post('programs/edit', [ProgramController::class, 'edit'])->name('programs-edit');
Route::post('programs/update', [ProgramController::class, 'update'])->name('programs.update');
Route::delete('programs/{id}/destroy', [ProgramController::class, 'destroy'])->name('programs.destroy');

Route::get('intakes', [IntakeController::class, 'index'])->name('intakes');
Route::post('intakes/save', [IntakeController::class, 'save'])->name('intakes.save');
Route::delete('intakes/{id}/destroy', [IntakeController::class, 'destroy'])->name('intakes.destroy');

Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('students/save', [StudentController::class, 'save'])->name('students.save');
