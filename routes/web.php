<?php

namespace App\Http\Controllers;
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

Route::get('/', [LandingController::class, 'welcome']);
Route::get('/team', [LandingController::class, 'team']);

Route::resource('users', 'App\Http\Controllers\UsersController')->middleware(['auth']);
Route::resource('trainings', 'App\Http\Controllers\TrainingController');
Route::resource('students', 'App\Http\Controllers\StudentController');
Route::get('/table', [TableController::class,'index']);

Route::resource('adminusers', 'App\Http\Controllers\AdminUserController');
Route::resource('adminstudents', 'App\Http\Controllers\AdminStudentController');
Route::resource('adminclass', 'App\Http\Controllers\AdminTrainingController');
Route::resource('adminprofessionals', 'App\Http\Controllers\AdminProfessionalsController');
Route::resource('admintrainers', 'App\Http\Controllers\AdminTrainersController');



require __DIR__.'/auth.php';
