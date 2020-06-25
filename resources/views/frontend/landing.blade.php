@extends('template.all')

@section('JudulHalaman','Certiffet - Home')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/rangeslider.css')}}">
@endsection

@section('konten')
<div class="container">
    @extends('template.nav-landing')
    <div class="row" id="WhatIsIt">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 my-auto">
            <h2>certifett.</h2>
            <h1>Certifett Factory</h1>
            <p>certifett adalah layanan untuk mempermudah pembuatan & verikasi sertifikat. Layanan kami dapat digunakan
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
                        Peserta dapat mengunduh atau memverifikasi sertifikat melalui certificate.certifett.com atau
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

@section('JsTambahanAfter')
<script src="{{asset('js/rangeslider.js')}}"></script>
<script>
    $('input[type="range"]').rangeslider({
        polyfill: false
    });

    $( document ).ready(function() {

        var slider = document.getElementById("slider");
        var output = document.getElementById("demo");
        var total = document.getElementById("TotalHarga");
        output.innerHTML = slider.value;
        total.innerHTML = "Rp. 250.000";
        slider.oninput = function() {
            output.innerHTML = this.value;
            total.innerHTML = "Rp. "+(numberWithCommas(parseInt(this.value)*25000));
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
        }
    });
    // Add scrollspy to <body>
        $('body').scrollspy({target: ".navbar"});

// Add smooth scrolling on all links inside the navbar
$(".navbar-nav a").on('click', function(event) {

// Make sure this.hash has a value before overriding default behavior
if (this.hash !== "") {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
    scrollTop: $(hash).offset().top-80
    }, 800, function(){
    });

} // End if

});
</script>
@endsection
