<?php

use App\Http\Controllers\dashboard\clients\BanClientController;
use App\Http\Controllers\dashboard\clients\ClientController;
use App\Http\Controllers\dashboard\clients\ClientSearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\clients\ManageController;
use App\Http\Controllers\dashboard\clients\new_clients\ActiveClientController;
use App\Http\Controllers\dashboard\clients\new_clients\ReviewClientController;
use App\Http\Controllers\dashboard\suppliers\SupplyController;

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

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

// Route::middleware(['auth'])->group(function () {
    Route::resource('clients', ClientController::class)->except([
         'destroy','show'
    ]);

    Route::get('/clients-requests',[ReviewClientController::class,'index']);
    // Route::get('/clients-search',[ClientSearchController::class,'search']);
    Route::post('active-client',[ActiveClientController::class,'active']);

    Route::get('active-client/{id}',[ActiveClientController::class,'re_active'])->name('client.reActive');
    Route::get('Cleint-ban/{id}',[BanClientController::class,'ban'])->name('client.ban');

    Route::resource('/suppliers',SupplyController::class)->except([
        'destroy'
   ]);


    // Route::get('/clients-requests',[ReviewClientController::class,'index']);
// });