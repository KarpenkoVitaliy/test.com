<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//table Clients
Route::get('clients', 'App\Http\Controllers\ApiClientsController@index');
Route::get('clients/{id}', 'App\Http\Controllers\ApiClientsController@show');
Route::post('clients/create', 'App\Http\Controllers\ApiClientsController@store');
Route::put('clients/update/{id}', 'App\Http\Controllers\ApiClientsController@update');
Route::post('clients/delete/{id}', 'App\Http\Controllers\ApiClientsController@destroy');//Метод DELETE чомусь Laravel не сприймає 
//table Employees
Route::get('employees', 'App\Http\Controllers\ApiEmployeesController@index');
Route::get('employees/{id}', 'App\Http\Controllers\ApiEmployeesController@show');
Route::post('employees/create', 'App\Http\Controllers\ApiEmployeesController@store');
Route::put('employees/update/{id}', 'App\Http\Controllers\ApiEmployeesController@update');
Route::post('employees/delete/{id}', 'App\Http\Controllers\ApiEmployeesController@destroy');
//table Expenses
Route::get('expenses', 'App\Http\Controllers\ApiExpensesController@index');
Route::get('expenses/{id}', 'App\Http\Controllers\ApiExpensesController@show');
Route::post('expenses/create', 'App\Http\Controllers\ApiExpensesController@store');
Route::put('expenses/update/{id}', 'App\Http\Controllers\ApiExpensesController@update');
Route::post('expenses/delete/{id}', 'App\Http\Controllers\ApiExpensesController@destroy');
//table Orders
Route::get('orders', 'App\Http\Controllers\ApiOrdersController@index');
Route::get('orders/{id}', 'App\Http\Controllers\ApiOrdersController@show');
Route::post('orders/create', 'App\Http\Controllers\ApiOrdersController@store');
Route::put('orders/update/{id}', 'App\Http\Controllers\ApiOrdersController@update');
Route::post('orders/delete/{id}', 'App\Http\Controllers\ApiOrdersController@destroy');
//report Client
Route::get('report/client', 'App\Http\Controllers\ApiReportsClientsController@clientReport');
//report Company
Route::get('report/proceeds', 'App\Http\Controllers\ApiReportsCompanyController@proceedsReport');
Route::get('report/costs', 'App\Http\Controllers\ApiReportsCompanyController@costsReport');


