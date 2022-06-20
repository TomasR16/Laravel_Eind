<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Band_controller;
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

// add route 
Route::resource('band', 'App\Http\Controllers\Band_controller');
