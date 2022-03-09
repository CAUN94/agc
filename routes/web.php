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
Route::get('/table', [TableController::class, 'index']);

Route::get('/mailcontact', 'App\Http\Controllers\MailContactController@show')->middleware(['auth']);
Route::post('/mailcontact', 'App\Http\Controllers\MailContactController@store')->middleware(['auth']);
Route::get('poll', 'App\Http\Controllers\PollController@example')->middleware(['auth']);
Route::post('/encuesta', 'App\Http\Controllers\PollController@showdata')->middleware(['auth']);

Route::get('/instagram', [InstagramController::class, 'index'])->middleware(['auth']);

Route::get('/adminpage', [AdminPageController::class, 'index'])->middleware(['intranet']);

// Admins
Route::resource('adminusers', 'App\Http\Controllers\AdminUserController');
Route::resource('adminstudents', 'App\Http\Controllers\AdminStudentController');
Route::resource('adminclass', 'App\Http\Controllers\AdminTrainingController');
Route::resource('admintrainappointment', 'App\Http\Controllers\AdminTrainAppointmentsController');
Route::resource('adminprofessionals', 'App\Http\Controllers\AdminProfessionalsController');
Route::resource('admintrainers', 'App\Http\Controllers\AdminTrainersController');


// TrainerAdmins
Route::resource('trainertrainappointment', 'App\Http\Controllers\TrainerTrainController');


// Short Links
Route::get('/padpow', 'App\Http\Controllers\RedirectController@pay');
Route::get('/rsf', 'App\Http\Controllers\RedirectController@rsf');
Route::get('/registro', 'App\Http\Controllers\RedirectController@registro');
Route::get('/comunicaciones', 'App\Http\Controllers\RedirectController@comunicaciones');
Route::get('/pendientes', 'App\Http\Controllers\RedirectController@pendientes');
Route::get('/solicitud-desarrollo', 'App\Http\Controllers\RedirectController@development');
Route::get('/solicitud-comunicaciones', 'App\Http\Controllers\RedirectController@communications');
Route::get('/solicitud-administracion', 'App\Http\Controllers\RedirectController@administration');
Route::get('/youphone', 'App\Http\Controllers\RedirectController@whatsapp');
Route::post('/youphone_whatsapp', 'App\Http\Controllers\RedirectController@whatsappform');
Route::get('/entrenamiento', 'App\Http\Controllers\RedirectController@trainning');
Route::get('/aranceles', 'App\Http\Controllers\RedirectController@arancel');
Route::get('/pago', 'App\Http\Controllers\RedirectController@pay');
Route::get('/rrhh', 'App\Http\Controllers\RedirectController@rrhh');
Route::get('/techosalud', 'App\Http\Controllers\RedirectController@techo');
Route::get('/box/dcontrerasb', 'App\Http\Controllers\RedirectController@contreras');
Route::get('/box/rbarchiesiv', 'App\Http\Controllers\RedirectController@barchiesi');
Route::get('/box/icristis', 'App\Http\Controllers\RedirectController@cristi');
Route::get('/box/jmguzmanh', 'App\Http\Controllers\RedirectController@guzman');
Route::get('/box/amaldonados', 'App\Http\Controllers\RedirectController@maldonado');
Route::get('/box/mjmartinezm', 'App\Http\Controllers\RedirectController@martinez');
Route::get('/box/cmoyac', 'App\Http\Controllers\RedirectController@moya');
Route::get('/box/aniklitscheks', 'App\Http\Controllers\RedirectController@niklitschek');
Route::get('/box/mrossg', 'App\Http\Controllers\RedirectController@ross');
Route::get('/box/cvalenzuelar', 'App\Http\Controllers\RedirectController@valenzuela');
Route::get('/box/dvivallov', 'App\Http\Controllers\RedirectController@vivallo');
Route::get('/box/internos', 'App\Http\Controllers\RedirectController@internos');
Route::get('/box/alopezm', 'App\Http\Controllers\RedirectController@lopez');
Route::get('/box/fguzmanh', 'App\Http\Controllers\RedirectController@fguzman');
Route::get('/box/chernandezc', 'App\Http\Controllers\RedirectController@hernandez');
Route::get('/box/svitalim', 'App\Http\Controllers\RedirectController@vitali');
Route::get('/box/meetyou', 'App\Http\Controllers\RedirectController@meetyou');

Route::get('change-password', 'App\Http\Controllers\ChangePasswordController@index');
Route::post('change-password', 'App\Http\Controllers\ChangePasswordController@store')->name('change.password');

Route::get('pay/{user}/{status}', 'App\Http\Controllers\PayController@payStatus');

require __DIR__ . '/auth.php';
