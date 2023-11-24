<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\MyRentalController;
use App\Http\Controllers\RentController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('cars', CarController::class)->middleware('auth');
Route::resource('rentals', RentController::class)->middleware('auth');
Route::resource('my-rentals', MyRentalController::class)->middleware('auth');