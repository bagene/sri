<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();
Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');
Route::get('/querydepartment', 'HomeController@querydepartment');
Route::get('/querysite', 'HomeController@querysite');
Route::get('/exportemployees', 'HomeController@exportemployees');

Route::get('/employees/exportemployees',[
  'as' => 'employees.export',
  'uses' => 'HomeController@export_employees'
]);

// --------------------- Sites Route -------------------------------

Route::resource('/sites','SitesController');

// --------------------- End Sites Route -------------------------------

// --------------------- Departments Route -------------------------------

Route::resource('/departments','DepartmentsController');

Route::post('/employees/storemanager/{id}',[
  'as' => 'employees.storemanager',
  'uses' => 'DepartmentsController@storemanager'
]);

Route::post('/employees/changemanager/{id}',[
  'as' => 'departments.changemanager',
  'uses' => 'DepartmentsController@changemanager'
]);



Route::delete('/departments/destroymanager/{id}',[
  'as' => 'departments.destroymanager',
  'uses' => 'DepartmentsController@destroymanager'
]);


// --------------------- End Departments Route ---------------------------


// --------------------- Employees Route -------------------------------

Route::resource('/employees','EmployeesController');

Route::post('/employees/storesite/{id}',[
  'as' => 'employees.storesite',
  'uses' => 'EmployeesController@storesite'
]);

Route::post('/employees/storedepartment/{id}',[
  'as' => 'employees.storedepartment',
  'uses' => 'EmployeesController@storedepartment'
]);


Route::put('/employees/leaveemployeesite/{id}',[
  'as' => 'employees.leave_employeesite',
  'uses' => 'EmployeesController@leavesite'
]);

Route::put('/employees/leaveemployeedepartment/{id}',[
  'as' => 'employees.leave_employeedepartment',
  'uses' => 'EmployeesController@leavedepartment'
]);

Route::delete('/employees/destroyemployeesite/{id}',[
  'as' => 'employees.destroy_employeesite',
  'uses' => 'EmployeesController@destroyemployeesite'
]);

Route::delete('/employees/destroyemployeedepartment/{id}',[
  'as' => 'employees.destroy_employeedepartment',
  'uses' => 'EmployeesController@destroyemployeedepartment'
]);



// --------------------- End Employees Route ----------------------------
