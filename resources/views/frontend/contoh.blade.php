{{-- Berarti file ini mengextend file di folder template/all.blade.php --}}
@extends('template.all')

{{--
    parameter sebelah kiri adalah nama @yield pada file all.blade.php
    parameter kanan adalah yang ingin kita isi pada @yield terkait
    berikut adalah contoh @section dengan 2 parameter
    @yield liat di file template/all.blade.php
--}}
@section('JudulHalaman',"Ini Halaman contoh")


{{--
    ini contoh section yg 1 parameter
    isi dari section ini di antara @section sampai @endsection
--}}
@section('konten')

<h1 class="text-success">Ini judul</h1>
<h2>Ini sub judul</h2>
<button class="btn btn-primary">ok suf?</button>

@endsection

{{--
    jadi intinya kita tanpa harus membuat tag html dari awal pada file ini,
    tapi kita dapatin tag HTML dan tag wajib di dalamnya kita extend dari file all.blade.php yang sudah ku siapkan,
    kalo mau liat hasilnya:
    1. php artisan serve
    2. buka di browser localhost:8000/a
--}}
