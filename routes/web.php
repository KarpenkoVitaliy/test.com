<?php

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

Route::get('/', function () {
    return view('main');
});




    // //############ Користувачі контролера SA ###########
    // Route::get ("/sa", "App\Http\Controllers\SaController@index")->name('admin-data');//Показати список користувачів
    // Route::post("/sa", "App\Http\Controllers\SaController@index")->name('admin-data');
    // Route::get ("/sa/edit/{id}", "App\Http\Controllers\SaController@editUser")->name('admin-edit');//Редагувати користувача
    // Route::post("/sa/edit/{id}", "App\Http\Controllers\SaController@editUser")->name('admin-edit');
    // Route::post("/sa/clean/{id}", "App\Http\Controllers\SaController@deleteUser")->name('admin-clean');//Видалити користувача
    // //------------ Профіля --------------
    // Route::get ("/sa/profile", "App\Http\Controllers\SaController@profile")->name('admin-profile');//Показати профіль
    // Route::post("/sa/profile", "App\Http\Controllers\SaController@profile")->name('admin-profile');
    // Route::get ("/sa/profile/create", "App\Http\Controllers\SaController@profileCreate")->name('admin-profile-create');//Створити профіль
    // Route::post("/sa/profile/create", "App\Http\Controllers\SaController@profileCreate")->name('admin-profile-create');
    // Route::get ("/sa/profile/edit/{id}", "App\Http\Controllers\SaController@profileEdit")->name('admin-profile-edit');//Редагувати профіль
    // Route::post("/sa/profile/edit/{id}", "App\Http\Controllers\SaController@profileEdit")->name('admin-profile-edit');
    // Route::get ("/sa/profile/action/{id}", "App\Http\Controllers\SaController@profileAction")->name('admin-profile-action');//Редагувати доступи до профілю
    // Route::post("/sa/profile/action/{id}", "App\Http\Controllers\SaController@profileAction")->name('admin-profile-action');
    // Route::post("/sa/profile/save/{id}", "App\Http\Controllers\SaController@profileSaveAction")->name('admin-profile-action-save');//Запис даних доступу профілю
    // Route::post("/sa/profile/clean/{id}", "App\Http\Controllers\SaController@deleteProfile")->name('admin-profile-clean');//Видалити профіль
    // //-------- Екшини доступу -----------
    // Route::get ("/sa/action", "App\Http\Controllers\SaController@action")->name('admin-action');//Показати функції
    // Route::post("/sa/action", "App\Http\Controllers\SaController@action")->name('admin-action');
    // Route::get ("/sa/action/create", "App\Http\Controllers\SaController@actionCreate")->name('admin-action-create');//Створити ф-цію
    // Route::post("/sa/action/create", "App\Http\Controllers\SaController@actionCreate")->name('admin-action-create');
    // Route::get ("/sa/action/edit/{id}", "App\Http\Controllers\SaController@actionEdit")->name('admin-action-edit');//Редагувати ф-цію
    // Route::post("/sa/action/edit/{id}", "App\Http\Controllers\SaController@actionEdit")->name('admin-action-edit');
    // Route::post("/sa/action/clean/{id}", "App\Http\Controllers\SaController@deleteAction")->name('admin-action-clean');//Видалити ф-цію
    // //############ Контролер Input замовлення #############
    // Route::get ("/input", "App\Http\Controllers\InputController@index")->name('input');//Показати список замовлень
    // Route::post("/input", "App\Http\Controllers\InputController@index")->name('input');
    // Route::get ("/input/create", "App\Http\Controllers\InputController@create")->name('input-create');//Створити замовлення
    // Route::post("/input/create", "App\Http\Controllers\InputController@create")->name('input-create');
    // Route::get ("/input/edit/{id}", "App\Http\Controllers\InputController@edit")->name('input-edit');//Редагувати замовлення
    // Route::post("/input/edit/{id}", "App\Http\Controllers\InputController@edit")->name('input-edit');

    // Route::get ("/input/test", "App\Http\Controllers\InputController@test")->name('input-test');//Показати функції (Тестова функція)

