<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Band_controller;
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
    return view('welcome');
});



Auth::routes();

Route::group(['middelware' => ['auth']], function () {
    // add route 
    Route::resource('band', 'App\Http\Controllers\Band_controller');
    // require HomeController
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
