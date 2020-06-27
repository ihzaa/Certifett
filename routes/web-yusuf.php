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

Route::get('agencyHome', function () {
  return view('frontend.agencyHome');
})->name("agencyHome-page");
