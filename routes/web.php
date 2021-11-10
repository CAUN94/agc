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
Route::get('/example', [LandingController::class, 'example']);
Route::get('/admin', [LandingController::class, 'adminexample']);
Route::resource('users', 'App\Http\Controllers\UsersController')->middleware(['auth']);
Route::resource('trainings', 'App\Http\Controllers\TrainingController');
Route::resource('students', 'App\Http\Controllers\StudentController');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
