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


//Menggunakan Middleware auth
Route::middleware(['auth'])->group(function () {

    Route::get('/logout/yes', function () {
        Auth::logout();
        return redirect(route('landing-page'));
    })->name('logout-c');


    Route::post('/acara/{id}/waktu-absensi', 'EventController@waktuAbsensi')->name('atur_waktu_absensi');

    Route::post('/acara/{id}/konfigurasi', 'ParticipantEventCertificateController@BuatSertifikatPeserta')->name('buat_sertifikat');
    Route::post('/acara/{id_acara}/buat/{id_sertif}', 'ParticipantEventCertificateController@SertifPesertaFinal')->name('buat_sertifikat_fix');
    Route::post('/acara/Edit/Peserta/{id}', 'ParticipantEventCertificateController@EditPeserta')->name('edit_peserta_acara');

    //Route Acara start
    Route::post('/acara/tambah', 'EventController@tambah')->name('tambah_event');
    Route::post('/acara/hapus', 'EventController@HapusAcara')->name('hapus_acara');
    Route::get('/acara/edit/{id}', 'EventController@TampilHalamanEditAcara')->name('tampil_edit_acara');
    Route::post('/acara/edit/{id}/simpan', 'EventController@EditAcara')->name('edit_acara');
    //Route Acara end

    Route::get('/acara/{id}/peserta', 'ParticipantEventCertificateController@TampilPerAcara')->name('peserta_acara');
    Route::post('/acara/hapus/peserta', 'ParticipantEventCertificateController@HapusPeserta')->name('hapus_peserta');
    Route::post('/acara/hapus/peserta/banyak', 'ParticipantEventCertificateController@HapusPesertaBanyak')->name('hapus_peserta_banyak');
    // Route::get('sertifikat/saya', 'CertificateController@TampilSertifSaya')->name("my-page");

    Route::post('/acara/{id}/peserta/tambah/csv', 'ParticipantEventCertificateController@TambahPesertaCSV')->name('tambah_peserta_csv');
    Route::post('/user/firstpassword/config/store', 'AccountController@FirstPasswordConfig')->name('config_first_pass');
});


Route::get('/', function () {
    return view('frontend.landing');
})->name("landing-page");
Route::get('/user/email/verification/{api_key}', 'EmailController@VerifyAccount')->name('verify_account');
Route::get('/certification/{id}', 'ParticipantEventCertificateController@TampilHalamanDaftar')->name("form_pendaftaran_event");
Route::post('/certification/{id}', 'ParticipantEventCertificateController@TambahPesertaLink')->name('peserta_daftar_link');

Route::get('/certificate/{id}', 'CertificateController@LihatSertif')->name('lihat_sertif');
Route::get('testting', 'EmailController@testing');
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('absensi','ParticipantEventCertificateController@AbsenPeserta')->name('peserta_absen');
