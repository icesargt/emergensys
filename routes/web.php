<?php

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

// \DB::listen(function($query){
// 	echo "<pre>{$query->sql}</pre>";
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function(){
	return view('admin.dashboard')->name('dashboard');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

/*
// Route, para grupo de rutas de Igss -> IgssController
Route::group([ 'middleware' => 'auth', 'prefix' => 'igss' ], function(){
	Route::resource('cuotas', 'IgssController');
});

// Route, para grupo de rutas de Salario -> SalaryController
Route::group(['middleware' => 'auth', 'prefix' => 'pago' ], function(){
	Route::resource('salarios', 'SalaryController');
});

// Route, para grupo de rutas de Empleados -> EmployeeController
Route::group(['middleware' => 'auth', 'prefix' => 'info' ], function(){	
	Route::post('empleados/{id}/history', ['as' => 'newrecord', 'uses' => 'EmployeeController@setNewRecord']);
	Route::resource('empleados', 'EmployeeController');
});

// Route, para grupo de rutas Historial -> RecordController
Route::group(['middleware' => 'auth', 'prefix' => 'dato' ], function(){
	
	Route::post('historial/record', ['as' => 'updaterecord', 'uses' => 'RecordController@setUpdateRecord']);
	Route::resource('historial', 'RecordController');
});

// Route, para grupo de rutas de Planilla -> PayrollControler
Route::group(['middleware' => 'auth', 'prefix' => 'control' ], function(){
	Route::resource('planillas', 'PayrollController');
});

// Route, para grupo de rutas de Detalles de planilla -> PayrollDetailController
Route::group([ 'middleware' => 'auth', 'prefix' => 'registro' ], function(){
	Route::resource('detalle', 'PayrollDetailController');
});

*/

Route::get('error', function(){
	return view('errors.404');//->name('error');
});

// Route group resource. Jobs
Route::group([ 'middleware' => 'auth', 'prefix' => 'works' ], function(){
	Route::resource('positions', 'JobController');
});

// Route group resource. Types_Jobs
Route::group([ 'middleware' => 'auth', 'prefix' => 'multi' ], function(){
	Route::resource('categories', 'TypeJobController');
});

// Route group resource. Speciality
Route::group([ 'middleware' => 'auth', 'prefix' => 'medical_specialities' ], function(){
	Route::resource('speciality', 'SpecialityController');
});

// Route group resource. Level
Route::group([ 'middleware' => 'auth', 'prefix' => 'list_warn' ], function(){
	Route::resource('level_danger', 'LevelController');
});

// Route group resource. Shift
Route::group([ 'middleware' => 'auth', 'prefix' => 'list_shift' ], function(){
	Route::resource('shift_assign', 'ShiftController');
});

// Route group resource. Agenda
Route::group([ 'middleware' => 'auth', 'prefix' => 'day_lists' ], function(){
	Route::resource('agenda_programed', 'AgendaController');
});

// Route group resource. Prescription
Route::group([ 'middleware' => 'auth', 'prefix' => 'recet' ], function(){
	Route::resource('medical_prescription', 'PrescriptionController');
});

// Route group resource. SendAlert
Route::group([ 'middleware' => 'auth', 'prefix' => 'media' ], function(){
	
	Route::get('alerts/patients', ['as' => 'list_emergency', 
		'uses' => 'SendAlertController@getPatients']);

	Route::post('alerts/sms', ['as' => 'notifysys', 
		'uses' => 'SendAlertController@sendMessage']);

	Route::resource('sending_alerts', 'SendAlertController');
});

// Route group resource. Patient
Route::group([ 'middleware' => 'auth', 'prefix' => 'persons' ], function(){

	Route::post('patient_lists/media/sms', ['as' => 'sendnotify', 
		'uses' => 'PatientController@sendMessage']);
	
	Route::resource('patient_lists', 'PatientController');
});

// Route group resource. Doctor
Route::group([ 'middleware' => 'auth', 'prefix' => 'personal' ], function(){
	Route::resource('doctor_lists', 'DoctorController');
});

// Route group resource. History
Route::group([ 'middleware' => 'auth', 'prefix' => 'principal' ], function(){
	Route::resource('history_details', 'HistoryController');
});

// Route group resource. Disease
Route::group([ 'middleware' => 'auth', 'prefix' => 'pathologic' ], function(){
	Route::resource('pathologic_lists', 'DiseaseController');
});