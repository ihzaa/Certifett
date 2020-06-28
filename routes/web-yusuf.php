<?php

use Illuminate\Support\Facades\Route;

Route::get('admin', function () {
    return view('frontend.admin');
});

Route::get('masuk', function () {
  return view('frontend.login');
})->name("login-page");

Route::get('daftar', function () {
  return view('frontend.daftar');
})->name("registration-page");

Route::get('berandaAgensi', function () {
  return view('frontend.agencyHome');
})->name("agencyHome-page");

Route::get('buatAcara', function () {
  return view('frontend.buatAcara');
})->name("createEvent-page");

Route::get('kelolaSertifikat', function () {
  return view('frontend.kelolaSertifikat');
})->name("manageCertificate-page");