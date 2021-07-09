<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Auth::routes(['reset' => false, 'register' => false]);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Karyawan
Route::resource('employees', App\Http\Controllers\EmployeesController::class);

// User
Route::post('/user/name', [App\Http\Controllers\UserController::class, 'changeName'])
    ->name('changeName');
Route::get('/change-password', [App\Http\Controllers\UserController::class, 'changePassword'])
    ->name('changePassword');
Route::post('/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'changePass'])
    ->name('changePass');

// Laporan
Route::get('/employees-report', [App\Http\Controllers\ReportController::class, 'employeesReport'])
    ->name('employeesReport');

Route::group(['middleware' => 'roles'], function () {
    // Users
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])
        ->name('masterUser');
    Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])
        ->name('createUser');
    Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])
        ->name('storeUser');
    Route::get('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);
    // Karyawan
    Route::get('/employees/delete/{id}', [App\Http\Controllers\EmployeesController::class, 'delete']);
});

// Gaji
Route::get('/salary', [App\Http\Controllers\SalaryController::class, 'index'])
    ->name('masterSalary');
Route::get('/salary/create', [App\Http\Controllers\SalaryController::class, 'create'])
    ->name('createSalary');
Route::get('/salary/temporary', [App\Http\Controllers\SalaryController::class, 'temp'])
    ->name('tempSalary');
Route::get('/salary/check', [App\Http\Controllers\SalaryController::class, 'check'])
    ->name('checkSalary');
Route::post('/salary/store', [App\Http\Controllers\SalaryController::class, 'store'])
    ->name('storeSalary');
Route::post('/salary/input', [App\Http\Controllers\SalaryController::class, 'input'])
    ->name('inputSalary');

// Loyalitas Dan Dedikasi
Route::get('/loyalty', [App\Http\Controllers\LoyaltyController::class, 'index'])
    ->name('masterLoyalty');
Route::get('/loyalty/create', [App\Http\Controllers\LoyaltyController::class, 'create'])
    ->name('createLoyalty');
Route::post('/loyalty/store', [App\Http\Controllers\LoyaltyController::class, 'store'])
    ->name('storeLoyalty');
