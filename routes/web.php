<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\AdminController;
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
Route::post('profile/{id}/update', [GeneralController::class, 'profile_update'])->name('profile.update');
Route::post('profile/update_password', [GeneralController::class, 'profile_update_password'])->name('profile.update_password');

Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/create', [AdminController::class, 'create'])->name('admin-create');
Route::post('admin/save', [AdminController::class, 'save'])->name('admin.save');
Route::get('admin/{id}/edit', [AdminController::class, 'edit'])->name('admin-edit');
Route::post('admin/{id}/update', [AdminController::class, 'update'])->name('admin.update');
Route::delete('admin/{id}/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');

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
Route::get('students/new', [StudentController::class, 'new_list'])->name('students.new');
Route::get('students/new/{id}/view', [StudentController::class, 'new_view'])->name('students.new.view');
Route::post('students/new/updateStatus', [StudentController::class, 'new_update_status'])->name('students.new.updateStatus');
Route::get('students/new/{id}/edit', [StudentController::class, 'new_edit'])->name('students.new.edit');
Route::post('students/new_update/{id}', [StudentController::class, 'new_update'])->name('students.new_update');
Route::get('students/enrolled', [StudentController::class, 'enrolled_list'])->name('students.enrolled');
Route::get('students/enrolled/{id}/view', [StudentController::class, 'enrolled_view'])->name('students.enrolled.view');
Route::get('students/enrolled/{id}/edit', [StudentController::class, 'enrolled_edit'])->name('students.enrolled.edit');
Route::post('students/enrolled_update/{id}', [StudentController::class, 'enrolled_update'])->name('students.enrolled_update');
Route::get('students/rejected', [StudentController::class, 'rejected_list'])->name('students.rejected');
Route::get('students/rejected/{id}/view', [StudentController::class, 'rejected_view'])->name('students.rejected.view');
Route::get('students/rejected/{id}/edit', [StudentController::class, 'rejected_edit'])->name('students.rejected.edit');
Route::post('students/rejected_update/{id}', [StudentController::class, 'rejected_update'])->name('students.rejected_update');
