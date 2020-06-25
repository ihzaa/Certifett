<?php

use Illuminate\Support\Facades\Route;

Route::get('admin', function () {
    return view('frontend.admin');
});

Route::get('daftar', function () {
  return view('frontend.daftar');
})->name("registration-page");
