<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//Menggunakan Middleware auth
Route::middleware(['auth'])->group(function () {

    Route::get('/buat-sertifikat', function () {
        return view('frontend.buat-sertifikat');
    })->name('buat_sertifikat');
    
});


Route::get('/', function () {
    return view('frontend.landing');
})->name("landing-page");
