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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function(){
	return view('admin.dashboard')->name('dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

Route::get('error', function(){
	return view('errors.404');//->name('error');
});