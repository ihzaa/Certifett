<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function(){

  Route::get('admin', function () {
    return view('frontend.admin');
  });

  Route::get('/home','EventController@TampilAcara')->name("agencyHome-page");
  
  Route::get('/acara/buat', function () {
    return view('frontend.buatAcara');
  })->name("createEvent-page");
  
  Route::get('kelolaSertifikat', function () {
    return view('frontend.kelolaSertifikat');
  })->name("manageCertificate-page");

  Route::get('sertifikatSaya', function () {
    return view('frontend.sertifikatSaya');
  })->name("myCertificates-page");

  Route::get('kelolaPeserta', function () {
    return view('frontend.kelolaPeserta');
  })->name("manageParticipant-page");

});

// Route::get('masuk', function () {
//   return view('frontend.login');
// })->name("login-page");

// Route::get('daftar', function () {
//   return view('frontend.daftar');
// })->name("registration-page");

