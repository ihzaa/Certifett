@extends('template.all')

@section('JudulHalaman','Home')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/rangeslider.css')}}">
<link rel="stylesheet" href="{{asset('css/landing.css')}}">
@endsection

@section('header')
@include('template.components.nav-landing')
@endsection

@section('konten')
<div id="isi" class="container">
    <div class="row text-center margin-when-small mt-4">
        <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 ml-auto mr-auto ">
            <h1 class="text-hijau font-weight-normal judul">Verifikasi Sertifikat</h1>
            <form action="/certificate/" action="post" id="form_id">
                <p class="text-normal">Verifikasi sertifikat yang dibuat dengan certifett menggunakan ID sertifikat</p>
                <div class="input-group input-group-lg mb-3 text-hijau mt-4 pt-4">
                    <div class="input-group-prepend">
                        <span
                            class="input-group-text transparent text-hijau hash border-radius-c border-radius-tanpa-kanan border-hijau"
                            id="basic-addon1">#</span>
                    </div>
                    @csrf
                    <input id="idSertifikat" type="text"
                        class="form-control kolom-input-id hash border-radius-c border-radius-tanpa-kiri border-hijau"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </form>
        </div>
    </div>
    <div class="row" id="WhatIsIt">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 my-auto">
            <h1>{{config('app.name')}}.</h1>
            <h1>Certificate Factory</h1>
            <p>{{config('app.name')}} adalah layanan untuk mempermudah pembuatan & verikasi sertifikat. Layanan kami dapat digunakan
                oleh sebuah instansi untuk membuat & menyebarkan sertifikat ke peserta acara dengan mudah. Sertifikat
                yang dibuat melalui certifett dapat diverikasi ketika peserta membutuhkannya sehingga keasliannya
                terjamin.</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 my-auto">
            <img class="img-fluid" src="{{asset('images/Manufacturing Process-pana.png')}}" alt="">
        </div>
    </div>
    <div class="row" id="GettingStarted">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 my-auto d-none d-sm-none d-md-none d-lg-block d-xl-block">
            <img class="img-fluid" src="{{asset('images/Setup Wizard-pana.png')}}" alt="">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 my-auto">
            <h1>Getting Started</h1>
            <div class="row">
                <div class="col-1">
                    <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <span class="fa fa-stack-1x fa-inverse">1</span>
                    </span>
                </div>
                <div class="col-11 pl-4">
                    <p>
                        Untuk mulai membuat sertifikat melalui certifett instansi harus mendaftar terlebih dahulu (no
                        surprise
                        here.)
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <span class="fa fa-stack-1x fa-inverse">2</span>
                    </span>
                </div>
                <div class="col-11 pl-4">
                    <p>
                        Buat acara baru, dan inputkan peserta. Peserta dapat diinput melalui link sharing atau file .csv
                        yang biasanya diimport dari Google Form
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <span class="fa fa-stack-1x fa-inverse">3</span>
                    </span>
                </div>
                <div class="col-11 pl-4">
                    <p>
                        Peserta dapat mengunduh atau memverifikasi sertifikat melalui {{config('app.url')}} atau
                        self hosted front-end.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 my-auto d-xl-none d-lg-none">
            <img class="img-fluid" src="{{asset('images/Setup Wizard-pana.png')}}" alt="">
        </div>
    </div>
    <div class="row mt-5" id="pricing">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 my-auto">
            <h1>Pricing Calculator</h1>
            <p>tarik slider dibawah untuk menghitung harga.</p>
            <div class="slidecontainer">
                <input id="slider" type="range" min="10" max="1000" step="10" value="100" style="width: 100%">
            </div>
            <p class="text-right">25K/10 orang</p>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <h3 class="d-flex align-items-center"><img class="img-fluid mr-2" width="45"
                            src="{{asset('icons/face-24px.png')}}" alt="">
                        <span id="demo"></span>
                        Peserta</h3>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <h3 class="d-flex"><span id="TotalHarga" class="ml-auto">Rp. 250.000</span></h3>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 my-auto">
            <img class="img-fluid" src="{{asset('images/Calculator-pana.png')}}" alt="">
        </div>
    </div>
</div>
@endsection

@section('footer')
@include('template.components.footer-common')
@endsection

@section('JsTambahanAfter')
<script src="{{asset('js/rangeslider.js')}}"></script>
<script src="{{asset('js/page/landing.js')}}"></script>
@if(Session::get('message'))
<script>
    swal("{{Session::get('title')}}",'{{Session::get('message')}}' , "{{Session::get('logo')}}");
</script>

@endif
@endsection
