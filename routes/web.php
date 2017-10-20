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
	return view('admin.dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route, para grupo de rutas de Igss -> IgssController
Route::group(['middleware' => ['auth'] ], function(){
	Route::resource('igss-management', 'IggsController');
});

// Route, para grupo de rutas de Salario -> SalaryController
Route::group(['middleware' => ['auth'] ], function(){
	Route::resource('salary-management', 'SalaryController');
});

// Route, para grupo de rutas de Empleados -> EmployeeController
Route::group(['middleware' => ['auth'] ], function(){
	Route::resource('employee-management', 'EmployeeController');
});

// Route, para grupo de rutas Historial -> RecordController
Route::group(['middleware' => ['auth'] ], function(){
	Route::resource('record-management', 'RecordController');
});

// Route, para grupo de rutas de Planilla -> PayrollControler
Route::group(['middleware' => ['auth'] ], function(){
	Route::resource('payroll-management', 'PayrollControler');
});

// Route, para grupo de rutas de Detalles de planilla -> PayrollDetailController
Route::group(['middleware' => ['auth'] ], function(){
	Route::resource('payroll-details', 'PayrollDetailController');
});