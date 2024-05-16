<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index']);
Route::get('/registration', [LoginController::class, 'registration']);
Route::prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('users', [UserController::class, 'index']);
    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contacts/create', [ContactController::class, 'modaladdshow']);
    Route::get('contacts/{id}', [ContactController::class, 'modalupdateshow']);
    Route::get('contacts/detail/{id}', [ContactController::class, 'modaldetailshow']);
    Route::get('addresses/create/{id}', [AddressController::class, 'create']);
    Route::get('addresses/edit/{id1}/{id2}', [AddressController::class, 'edit']);
});
