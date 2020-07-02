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



    Route::post('/sertifikat/{id}/buat', 'ParticipantEventCertificateController@BuatSertifikatPeserta')->name('buat_sertifikat');

    Route::get('/logout/yes', function () {
        Auth::logout();
        return redirect(route('landing-page'));
    })->name('logout-c');

    //Route Acara start
    Route::post('/acara/tambah', 'EventController@tambah')->name('tambah_event');
    Route::post('/acara/hapus', 'EventController@HapusAcara')->name('hapus_acara');
    Route::get('/acara/edit/{id}', 'EventController@TampilHalamanEditAcara')->name('tampil_edit_acara');
    Route::post('/acara/edit/{id}/simpan', 'EventController@EditAcara')->name('edit_acara');
    //Route Acara end

    Route::get('/acara/{id}/peserta', 'ParticipantEventCertificateController@TampilPerAcara')->name('peserta_acara');
});


Route::get('/', function () {
    return view('frontend.landing');
})->name("landing-page");

Route::get('/certification/{id}', function () {
    return view('frontend.landing');
})->name("form_pendaftaran_event");
