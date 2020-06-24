<?php

use Illuminate\Support\Facades\Route;

Route::get('admin', function () {
    return view('frontend.admin');
});

Route::get('pilihAkun', function () {
  return view('frontend.pilihAkun');
});
