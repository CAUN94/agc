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

// Route::get('/run-python', function () {
//     $output = [];
//     $return_var = 0;
//     exec('python3 ' . base_path('app/hello.py'), $output, $return_var);
//     dd($output, $return_var);
// });


// Arreglar
// Route::get('/professionalshours', 'App\Http\Controllers\ScrapingController@professionalshours');

// Route::get('/pago2', [MercadoPagoController::class, 'personalizepay']);
// Route::get('/scraping-alta', [ScrapingController::class, 'alta']);

Route::get('/confirmacion/{id}', [MercadoPagoController::class, 'pay']);
Route::get('/pago', 'App\Http\Controllers\RedirectController@pago');

Route::middleware([UpdatePassword::class,])->group(function () {

    // Route::get('/mercadopagosearch', [MercadoPagoController::class, 'index']);
    // Route::get('/packverano', [LandingController::class, 'packverano']);
    // Route::get('/team', [LandingController::class, 'team']);
    // Route::get('/tables', [LandingController::class, 'tables']);
    // Route::get('/example', [LandingController::class, 'example']);
    // Route::post('/mailverano', [LandingController::class, 'mailverano']);
    // Route::get('/instagram', [InstagramController::class, 'index'])->middleware(['auth']);

    Route::get('/', [LandingController::class, 'welcome']);
    Route::get('/kinesiología', [LandingController::class, 'about']);
    Route::get('/terms', [LandingController::class, 'terms']);
    Route::get('/renew', [LandingController::class, 'renew'])->middleware(['auth']);
    Route::resource('users', 'App\Http\Controllers\UsersController')->middleware(['auth']);
    // Revisar
    // Route::get('/calendar', [LandingController::class, 'calendar'])->middleware(['auth']);
    // Revisar
    // Route::get('/healthy', [LandingController::class, 'healthy'])->middleware(['auth']);

    Route::get('/nutrition', [LandingController::class, 'nutrition'])->middleware(['auth']);
    // Route::get('/calendar/store/{id}', [CalendarController::class, 'store'])->middleware(['auth']);


    Route::resource('trainings', 'App\Http\Controllers\TrainingController');
    Route::resource('students', 'App\Http\Controllers\StudentController');
    // Route::get('/table', [TableController::class, 'index']);

    // Route::get('/mailcontact', 'App\Http\Controllers\MailContactController@show')->middleware(['auth']);
    // Route::post('/mailcontact', 'App\Http\Controllers\MailContactController@store')->middleware(['auth']);

    // Polls
    Route::get('/encuesta_satisfaccion', 'App\Http\Controllers\PollController@encuesta_satisfaccion_index');
    Route::post('/encuesta_satisfaccion', 'App\Http\Controllers\PollController@encuesta_satisfaccion_store');
    // Route::get('/ganate_una_sesion', 'App\Http\Controllers\PollController@ganate_una_sesion_index');
    // Route::post('/ganate_una_sesion', 'App\Http\Controllers\PollController@ganate_una_sesion_store');
    Route::get('/cuestionario', [PollController::class, 'cuestionario_index']);
    Route::post('/cuestionario', [PollController::class, 'cuestionario_store']);


    // Admins
    Route::get('/adminpage', [AdminPageController::class, 'index'])->middleware(['intranet']);
    Route::resource('adminusers', 'App\Http\Controllers\AdminUserController')->middleware(['intranet']);
    Route::get('adminstudents', 'App\Http\Controllers\AdminStudentController@index')->middleware(['intranet']);
    // Route::get('wireframe2', 'App\Http\Controllers\AdminStudentController@wireframe2')->middleware(['intranet']);
    // Route::get('wireframe', 'App\Http\Controllers\AdminStudentController@wireframe')->middleware(['intranet']);
    Route::get('/confirmations', [LandingController::class, 'confirmations'])->middleware(['intranet']);
    // Route::get('/confirmation/{id}', [LandingController::class, 'confirmation'])->middleware(['intranet']);
    Route::get('/confirmation/{id}', [LandingController::class, 'sendconfirmation'])->middleware(['intranet']);

    // //lista Espera
    // Route::resource('listaEspera', 'App\Http\Controllers\listaEsperaController')->middleware(['intranet']);

    Route::resource('adminclass', 'App\Http\Controllers\AdminTrainingController')->middleware(['intranet']);
    Route::resource('admintrainappointment', 'App\Http\Controllers\AdminTrainAppointmentsController')->middleware(['intranet']);
    // Route::resource('adminprofessionalappointment', 'App\Http\Controllers\AdminProfessionalAppointmentsController')->middleware(['intranet']);
    // Route::resource('adminprofessionals', 'App\Http\Controllers\AdminProfessionalsController')->middleware(['intranet']);
    Route::resource('admintrainers', 'App\Http\Controllers\AdminTrainersController')->middleware(['intranet']);
    Route::get('/adminalliance', [AdminAllianceController::class, 'index'])->middleware(['intranet']);
    Route::post('/adminalliance/create', [AdminAllianceController::class, 'store'])->middleware(['intranet']);
    Route::resource('adminbookappointment', 'App\Http\Controllers\AdminBookAppointmentsController')->middleware(['intranet']);

    // Route::get('/userml', [UserMlController::class, 'index'])->middleware(['intranet']);

    //Remuneración
    Route::resource('adminRemuneracion', 'App\Http\Controllers\adminRemuneracionController')->middleware(['admin']);
    Route::resource('mesActual', 'App\Http\Controllers\mesActualController')->middleware(['intranet']);
    Route::resource('mesVencido', 'App\Http\Controllers\mesVencidoController')->middleware(['intranet']);
    Route::resource('historial', 'App\Http\Controllers\historialController')->middleware(['intranet']);

    Route::get('/apim/professionals', [ApiMedilinkController::class, 'professionals']);
    Route::get('/apim/atentions', [ApiMedilinkController::class, 'atentions'])->middleware(['intranet']);
    Route::get('/apim/atentions/{id}', [ApiMedilinkController::class, 'atention'])->middleware(['intranet']);
    Route::get('/apim/atentions/{id}/evolution', [ApiMedilinkController::class, 'evolution'])->middleware(['intranet']);
    Route::get('/apim/allAtentions', [ApiMedilinkController::class, 'allAtentions'])->middleware(['intranet']);
    Route::get('/apim/clients', [ApiMedilinkController::class, 'allClients'])->middleware(['intranet']);
    Route::get('/apim/appointments', [ApiMedilinkController::class, 'appointments'])->middleware(['intranet']);
    Route::get('/apim/allappointments', [ApiMedilinkController::class, 'allAppointments'])->middleware(['intranet']);
    // Route::get('/apim/addAppointment', [ApiMedilinkController::class, 'addAppointment'])->middleware(['intranet']);
    Route::get('/apim/changeAppointment', [ApiMedilinkController::class, 'changeAppointment'])->middleware(['intranet']);
    Route::get('/apim/sillones', [ApiMedilinkController::class, 'sillones'])->middleware(['intranet']);
    Route::get('/apim/estados', [ApiMedilinkController::class, 'estados'])->middleware(['intranet']);
    Route::get('/apim/alianzas', [ApiMedilinkController::class, 'alianzas'])->middleware(['intranet']);
    Route::get('/apim/actions', [ApiMedilinkController::class, 'allactions'])->middleware(['intranet']);
    Route::get('/apim/cajas', [ApiMedilinkController::class, 'cajas']);
    Route::get('/apim/pagos', [ApiMedilinkController::class, 'pagos']);
    Route::get('/apim/calendar', [ApiMedilinkController::class, 'calendar']);
    Route::get('/apim/listCalendar', [ApiMedilinkController::class, 'listCalendar']);
    Route::get('/apim/pagos/{id}', [ApiMedilinkController::class, 'pago']);
    Route::get('/apim/evoluciones', [ApiMedilinkController::class, 'evoluciones']);
    Route::get('/apim/user/pagos', [ApiMedilinkController::class, 'UserPays']);
    Route::get('/apim/documentosTributarios', [ApiMedilinkController::class, 'documentosTributarios']);

    Route::get('/googlecalendar', [GoogleCalendarController::class, 'index']);


    Route::post('/apim/addAppointment', [ApiMedilinkController::class, 'addAppointment']);


    Route::get('/apim/appointmentsProfessional/{id}/{startdate}/{enddate}', [ApiMedilinkController::class, 'appointmentsProfessional']);

    // Admin Haas
    Route::get('/admin/nutrition', [AdminHaasController::class, 'nutrition'])->middleware(['intranet']);
    Route::get('/admin/nutrition/pdf', ['App\Http\Livewire\AdminNutrition', 'pdf'])->middleware(['intranet'])->name('livewire.admin-nutrition');
    Route::get('/admin/nutrition/pdf-view', [AdminHaasController::class, 'pdf_view'])->middleware(['intranet']);

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

    // Route::get('/professionals', 'App\Http\Controllers\ScrapingController@professionals')->middleware(['intranet']);

    // Route::get('/professionals/{id}', 'App\Http\Controllers\ScrapingController@professional')->middleware(['intranet']);


    Route::get('/professionals', 'App\Http\Controllers\ApiMedilinkController@nextAppointmentsProfessionals')->middleware(['intranet']);
    Route::get('/professionals/{id}', 'App\Http\Controllers\ApiMedilinkController@nextAppointmentsProfessional')->middleware(['intranet']);


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
    Route::get('/confirmacion/{id}', [MercadoPagoController::class, 'pay']);
    Route::get('/mercadopago', 'App\Http\Controllers\RedirectController@pago');
    Route::get('/rrhh', 'App\Http\Controllers\RedirectController@rrhh');
    Route::get('/clinica', 'App\Http\Controllers\RedirectController@clinica');
    Route::get('/club-strava', 'App\Http\Controllers\RedirectController@strava');
    Route::get('/techosalud', 'App\Http\Controllers\RedirectController@techo');
    Route::get('/krunners', 'App\Http\Controllers\RedirectController@krunners');
    Route::get('/viarunning', 'App\Http\Controllers\RedirectController@viarunning');
    Route::get('/academia', 'App\Http\Controllers\RedirectController@academia');
    Route::get('/endurance', 'App\Http\Controllers\RedirectController@endurance');
    Route::get('/trailwomen', 'App\Http\Controllers\RedirectController@trailwomen');
    Route::get('/agendate', 'App\Http\Controllers\RedirectController@agendate');
    Route::get('/masterclass', 'App\Http\Controllers\RedirectController@masterclass');
    Route::get('/indicadores', 'App\Http\Controllers\RedirectController@indicadores');
    Route::get('/alianzas', 'App\Http\Controllers\RedirectController@alianzas');
    Route::get('/progreso-mensual', 'App\Http\Controllers\RedirectController@progreso');
    Route::get('/pnl', 'App\Http\Controllers\RedirectController@pnl');
    Route::get('/horarios-peak', 'App\Http\Controllers\RedirectController@horariospeak');
    Route::get('/recomiendanos', 'App\Http\Controllers\RedirectController@recomiendanos');
    Route::get('/mds', 'App\Http\Controllers\RedirectController@mds');
    Route::get('/eventos', 'App\Http\Controllers\RedirectController@eventos');
    Route::get('/eventos/logistica', 'App\Http\Controllers\RedirectController@logistica');
    Route::get('/eventos/comunicaciones', 'App\Http\Controllers\RedirectController@comunicaciones_eventos');
    Route::get('/contratos/alianzas_yjb', 'App\Http\Controllers\RedirectController@alianzas_yjb');
    Route::get('/bci', 'App\Http\Controllers\RedirectController@bci');
    Route::get('/streamlit-test', 'App\Http\Controllers\RedirectController@streamlit');
    Route::get('/informe-rodilla', 'App\Http\Controllers\RedirectController@informe_rodilla');
    Route::get('/test-runners', 'App\Http\Controllers\RedirectController@test_runners');
    Route::get('/isak', 'App\Http\Controllers\RedirectController@isak');
    Route::get('/isak_sin_kit', 'App\Http\Controllers\RedirectController@isak_sin_kit');


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

    // ApiMedilink
    Route::get('/apimedilink', [AdminMedilinkController::class, 'index']);
    Route::get('/apimedilink/profesionales', [AdminMedilinkController::class, 'profesionales']);
    Route::get('/apimedilink/profesionales/{id}', [AdminMedilinkController::class, 'profesional']);
    Route::get('/apimedilink/profesionales/{id}/appointments', [AdminMedilinkController::class, 'profesional_appointment']);
    Route::get('/apimedilink/profesionales/{id}/hours', [AdminMedilinkController::class, 'profesional_hours']);
    Route::get('/apimedilink/profesional/remuneration', [AdminMedilinkController::class, 'remuneration']);
    Route::get('/apimedilink/sucursales', [AdminMedilinkController::class, 'sucursales']);
    Route::get('/apimedilink/citas', [AdminMedilinkController::class, 'citas']);
    Route::get('/apimedilink/convenios', [AdminMedilinkController::class, 'convenios']);
    Route::get('/apimedilink/convenios/{cursor}', [AdminMedilinkController::class, 'convenios_cursor']);
    Route::get('/apimedilink/tratamientos', [AdminMedilinkController::class, 'tratamientos']);
    Route::get('/apimedilink/atenciones', [AdminMedilinkController::class, 'atenciones']);
    Route::get('/apimedilink/prestaciones', [AdminMedilinkController::class, 'prestaciones']);
    Route::get('/apimedilink/prestaciones/{id}', [AdminMedilinkController::class, 'prestacion']);
    Route::get('/apimedilink/pays', [AdminMedilinkController::class, 'pays']);
    Route::get('/apimedilink/pays/{id}', [AdminMedilinkController::class, 'pay']);
    Route::get('/apimedilink/patients', [AdminMedilinkController::class, 'patients']);
    Route::get('/apimedilink/patients/{id}', [AdminMedilinkController::class, 'patient']);
    Route::get('/apimedilink/payments', [AdminMedilinkController::class, 'payments']);
    Route::get('/apimedilink/allpayments', [AdminMedilinkController::class, 'allpayments']);
    Route::get('/apimedilink/payments/{id}', [AdminMedilinkController::class, 'payment']);
    Route::get('/apimedilink/payments/{id}/boleta', [AdminMedilinkController::class, 'paymentboleta']);
    Route::get('/apimedilink/payments/{id}', [AdminMedilinkController::class, 'payment']);



    // Usar apim para pruebas



    // Nubox
    Route::get('/nubox', [ AdminNuboxController::class, 'index']);
    Route::post('/nubox/emit', [ AdminNuboxController::class, 'emit']);
    Route::get('/nubox/auth', [ AdminNuboxController::class, 'auth']);
    // No cuento con permiso
    Route::get('/nubox/comprobante', [ AdminNuboxController::class, 'comprobante']);
    // Funciona
    Route::get('/nubox/comuna', [ AdminNuboxController::class, 'comuna']);

    Route::get('/nubox/cliente', [ AdminNuboxController::class, 'cliente']);

    Route::get('/nubox/boleta', [ AdminNuboxController::class, 'boleta']);

    Route::get('/nubox/documentos', [ AdminNuboxController::class, 'documentos']);

    Route::get('pay/{user}/{status}', 'App\Http\Controllers\PayController@payStatus');
    Route::get('pay/{user}/{treatmentMl}/{status}', 'App\Http\Controllers\PayController@payMedilinkStatus');
    Route::get('paystatus/{status}/{appointmentId}', 'App\Http\Controllers\PayController@payMedilink');

    Route::get('/teachable/courses', 'TeachableController@getCourses');

    Route::get('/streamlit', 'App\Http\Controllers\StreamlitController@index');
});



require __DIR__ . '/auth.php';
