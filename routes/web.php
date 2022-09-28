<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UpdatePassword;

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

Route::get('/gcalendar', [CalendarController::class, 'index']);
Route::get('/gcalendar_massive', [CalendarController::class, 'superstore']);
Route::get('/gcalendar_delete', [CalendarController::class, 'superdelete']);
// Route::get('/google', [CalendarController::class, 'google']);

Route::get('/nubox/auth', [ AdminNuboxController::class, 'auth']);
Route::get('/nubox/comprobante', [ AdminNuboxController::class, 'comprobante']);
Route::get('/nubox/comuna', [ AdminNuboxController::class, 'comuna']);

Route::middleware([UpdatePassword::class])->group(function () {
    Route::get('/mercadopagosearch', [MercadoPagoController::class, 'index']);

    Route::get('/', [LandingController::class, 'welcome']);
    Route::get('/landing', [LandingController::class, 'welcome2']);
    Route::get('/kinesiología', [LandingController::class, 'about']);
    Route::get('/team', [LandingController::class, 'team']);
    Route::get('/terms', [LandingController::class, 'terms']);
    Route::get('/tables', [LandingController::class, 'tables']);
    Route::get('/example', [LandingController::class, 'example']);
    Route::get('/renew', [LandingController::class, 'renew'])->middleware(['auth']);



    Route::resource('users', 'App\Http\Controllers\UsersController')->middleware(['auth']);
    Route::get('/calendar', [LandingController::class, 'calendar'])->middleware(['auth']);
    Route::get('/healthy', [LandingController::class, 'healthy'])->middleware(['auth']);
    Route::get('/nutrition', [LandingController::class, 'nutrition'])->middleware(['auth']);
    Route::get('/calendar/store/{id}', [CalendarController::class, 'store'])->middleware(['auth']);


    Route::resource('trainings', 'App\Http\Controllers\TrainingController');
    Route::resource('students', 'App\Http\Controllers\StudentController');
    Route::get('/table', [TableController::class, 'index']);

    Route::get('/mailcontact', 'App\Http\Controllers\MailContactController@show')->middleware(['auth']);
    Route::post('/mailcontact', 'App\Http\Controllers\MailContactController@store')->middleware(['auth']);

    // Polls
    Route::get('/encuesta_satisfaccion', 'App\Http\Controllers\PollController@encuesta_satisfaccion_index');
    Route::post('/encuesta_satisfaccion', 'App\Http\Controllers\PollController@encuesta_satisfaccion_store');
    Route::get('/ganate_una_sesion', 'App\Http\Controllers\PollController@ganate_una_sesion_index');
    Route::post('/ganate_una_sesion', 'App\Http\Controllers\PollController@ganate_una_sesion_store');

    Route::get('/admin/encuesta_satisfaccion', 'App\Http\Controllers\AdminPollController@encuesta_satisfaccion_index');

    Route::get('/instagram', [InstagramController::class, 'index'])->middleware(['auth']);

    Route::get('/adminpage', [AdminPageController::class, 'index'])->middleware(['intranet']);

    // Admins
    Route::resource('adminusers', 'App\Http\Controllers\AdminUserController')->middleware(['intranet']);
    Route::get('adminstudents', 'App\Http\Controllers\AdminStudentController@index')->middleware(['intranet']);
    Route::get('wireframe2', 'App\Http\Controllers\AdminStudentController@wireframe2')->middleware(['intranet']);
    Route::get('wireframe', 'App\Http\Controllers\AdminStudentController@wireframe')->middleware(['intranet']);



    Route::resource('adminclass', 'App\Http\Controllers\AdminTrainingController')->middleware(['intranet']);
    Route::resource('admintrainappointment', 'App\Http\Controllers\AdminTrainAppointmentsController')->middleware(['intranet']);
    Route::resource('adminprofessionalappointment', 'App\Http\Controllers\AdminProfessionalAppointmentsController')->middleware(['intranet']);
    Route::resource('adminprofessionals', 'App\Http\Controllers\AdminProfessionalsController')->middleware(['intranet']);
    Route::resource('admintrainers', 'App\Http\Controllers\AdminTrainersController')->middleware(['intranet']);
    Route::get('/adminalliance', [AdminAllianceController::class, 'index'])->middleware(['intranet']);
    Route::post('/adminalliance/create', [AdminAllianceController::class, 'store'])->middleware(['intranet']);
    Route::resource('adminbookappointment', 'App\Http\Controllers\AdminBookAppointmentsController')->middleware(['intranet']);
    Route::get('/userml', [UserMlController::class, 'index'])->middleware(['intranet']);

    // Admin Haas

    Route::get('/admin/nutrition', [AdminHaasController::class, 'nutrition'])->middleware(['intranet']);

    // TrainerAdmins
    Route::resource('trainertrainappointment', 'App\Http\Controllers\TrainerTrainController');
    Route::resource('trainerbookappointment', 'App\Http\Controllers\AdminBookAppointmentsController');

    // Scrap

    Route::get('/scraping-userml', 'App\Http\Controllers\ScrapingController@userMl')->name('scraping-userml');
    Route::get('/scraping-actionml', 'App\Http\Controllers\ScrapingController@actionMl')->name('scraping-actionml');
    Route::get('/scraping-appointmentml', 'App\Http\Controllers\ScrapingController@appointmentMl')->name('scraping-appointmentml');
    Route::get('/scraping-treatmentsml', 'App\Http\Controllers\ScrapingController@treatmentsMl')->name('scraping-treatmentsml');

    Route::get('/ficha', 'App\Http\Controllers\ScrapingController@ficha')->name('ficha');

    Route::get('/scraping-paymentsml', 'App\Http\Controllers\ScrapingController@paymentsMl')->name('scraping-paymentsml');
    Route::get('/professionals', 'App\Http\Controllers\ScrapingController@professionals')->middleware(['intranet']);
    Route::get('/professionals/{id}', 'App\Http\Controllers\ScrapingController@professional')->middleware(['intranet']);

    // Medilink
    Route::get('/medilink/payments','App\Http\Controllers\MedilinkController@payments');
    Route::get('/medilink/actions','App\Http\Controllers\MedilinkController@actions');
    Route::get('/medilink/appointments','App\Http\Controllers\MedilinkController@appointments');
    Route::get('/medilink/treatments','App\Http\Controllers\MedilinkController@treatments');

    // Short Links
    Route::get('/padpow', 'App\Http\Controllers\RedirectController@pay');
    Route::get('/rsf', 'App\Http\Controllers\RedirectController@rsf');
    Route::get('/registro', 'App\Http\Controllers\RedirectController@registro');
    Route::get('/comunicaciones', 'App\Http\Controllers\RedirectController@comunicaciones');
    Route::get('/pendientes', 'App\Http\Controllers\RedirectController@pendientes');
    Route::get('/encuesta-haas', 'App\Http\Controllers\RedirectController@encuestahaas');
    Route::get('/solicitud-desarrollo', 'App\Http\Controllers\RedirectController@development');
    Route::get('/solicitud-comunicaciones', 'App\Http\Controllers\RedirectController@communications');
    Route::get('/solicitud-administracion', 'App\Http\Controllers\RedirectController@administration');
    Route::get('/youphone', 'App\Http\Controllers\RedirectController@whatsapp');
    Route::post('/youphone_whatsapp', 'App\Http\Controllers\RedirectController@whatsappform');
    Route::get('/entrenamiento', 'App\Http\Controllers\RedirectController@trainning');
    Route::get('/aranceles', 'App\Http\Controllers\RedirectController@arancel');
    Route::get('/pago', 'App\Http\Controllers\RedirectController@pay');
    Route::get('/rrhh', 'App\Http\Controllers\RedirectController@rrhh');
    Route::get('/clinica', 'App\Http\Controllers\RedirectController@clinica');
    Route::get('/club-strava', 'App\Http\Controllers\RedirectController@strava');
    Route::get('/techosalud', 'App\Http\Controllers\RedirectController@techo');
    Route::get('/krunners', 'App\Http\Controllers\RedirectController@krunners');
    Route::get('/viarunning', 'App\Http\Controllers\RedirectController@viarunning');
    Route::get('/academia', 'App\Http\Controllers\RedirectController@academia');
    Route::get('/endurance', 'App\Http\Controllers\RedirectController@endurance');
    Route::get('/agendate', 'App\Http\Controllers\RedirectController@agendate');

    Route::get('/box/dcontrerasb', 'App\Http\Controllers\RedirectController@contreras');
    Route::get('/box/jmguzmanh', 'App\Http\Controllers\RedirectController@guzman');
    Route::get('/box/cmoyac', 'App\Http\Controllers\RedirectController@moya');
    Route::get('/box/aniklitscheks', 'App\Http\Controllers\RedirectController@niklitschek');
    Route::get('/box/mrossg', 'App\Http\Controllers\RedirectController@ross');
    Route::get('/box/cvalenzuelar', 'App\Http\Controllers\RedirectController@valenzuela');
    Route::get('/box/dvivallov', 'App\Http\Controllers\RedirectController@vivallo');
    Route::get('/box/internos', 'App\Http\Controllers\RedirectController@internos');
    Route::get('/box/fguzmanh', 'App\Http\Controllers\RedirectController@fguzman');
    Route::get('/box/chernandezc', 'App\Http\Controllers\RedirectController@hernandez');
    Route::get('/box/aceresuelap', 'App\Http\Controllers\RedirectController@aceresuelap');
    Route::get('/box/cahumadah', 'App\Http\Controllers\RedirectController@cahumadah');
    Route::get('/box/ncedeñow', 'App\Http\Controllers\RedirectController@ncedeñow');
    Route::get('/box/rnuches', 'App\Http\Controllers\RedirectController@rnuches');
    Route::get('/box/asaezm', 'App\Http\Controllers\RedirectController@asaezm');
    Route::get('/box/msilvaa', 'App\Http\Controllers\RedirectController@msilvaa');
    Route::get('/box/jvalcarcels', 'App\Http\Controllers\RedirectController@jvalcarcels');
    Route::get('/box/mrebolledon', 'App\Http\Controllers\RedirectController@mrebolledon');
    Route::get('/box/meetyou', 'App\Http\Controllers\RedirectController@meetyou');

    Route::get('change-password', 'App\Http\Controllers\ChangePasswordController@index')->withoutMiddleware([UpdatePassword::class]);
    Route::post('change-password', 'App\Http\Controllers\ChangePasswordController@store')->name('change.password')->withoutMiddleware([UpdatePassword::class]);

    Route::get('pay/{user}/{status}', 'App\Http\Controllers\PayController@payStatus');
    Route::get('pay/{user}/{treatmentMl}/{status}', 'App\Http\Controllers\PayController@payMedilinkStatus');


    // Strava
    Route::get('/strava', \App\Http\Controllers\StravaController::class .'@index')->middleware(['intranet']);
    Route::get('/strava/show', \App\Http\Controllers\StravaController::class .'@show')->middleware(['auth']);
    Route::get('/strava/showjson/{id}', \App\Http\Controllers\StravaController::class .'@showjson');
    Route::get('/strava/showjsoniver/{id}', \App\Http\Controllers\StravaController::class .'@showjsoniver');
    Route::get('/strava/adminshow/{id}', \App\Http\Controllers\StravaController::class .'@adminshow')->middleware(['intranet']);
    Route::get('/strava/auth', \App\Http\Controllers\StravaController::class .'@auth')->middleware(['auth']);
    Route::get('/strava/unauth', \App\Http\Controllers\StravaController::class .'@unauth')->middleware(['auth']);
    Route::get('/strava/callback', \App\Http\Controllers\StravaController::class .'@authCallback')->middleware(['auth']);
});

require __DIR__ . '/auth.php';
