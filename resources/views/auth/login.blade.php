@extends('template.all')

@section('JudulHalaman','Masuk')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/style-yusuf.css')}}">
<link rel="stylesheet" href="{{asset('css/brands.css')}}">
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container">
    <article class="text-center auth">
        <h1 id="judul2">
            Masuk
        </h1>
        <form id="login" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <input type="email" name="email" class="form-control mx-auto" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control mx-auto" placeholder="Password">
                </div>
                <img src='{{asset("images/Savings-pana.png")}}'>
                <button type="submit" class="btn btn-outline-dark btn-auth">Masuk</button>
                {{-- <div class="form-group row">
                    <div class="col-10 col-sm-10 col-md-4 col-xl-4 col-lg-4 m-auto">
                        <h5>Atau Masuk Dengan:</h5>
                        <a href="{{ url('/auth/google') }}" class="btn btn-github"><i class="fa fa-github"></i>
                        Google</a>
                        <a href="{{ url('/auth/twitter') }}" class="btn btn-twitter"><i class="fa fa-twitter"></i>
                            Twitter</a>

                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-10 col-sm-10 col-md-4 col-xl-4 col-lg-4 m-auto">
                        <a href="{{ url('/auth/facebook') }}" class="btn btn-facebook text-light"
                            style="background-color: #4267B2"><i class="fab fa-facebook" aria-hidden="true"></i>
                            Facebook</a>
                    </div>
                </div> --}}
                <h4 id="text1">Belum punya akun? <a href="{{route('register')}}"><span>daftar</span></a></h4>

        </form>

    </article>
</div>
@endsection

@section('JsTambahanAfter')
<script>
    $("#login").on("submit",function(){
        $(".se-pre-con").fadeIn();
    });
</script>
@if(Session::get('error'))
<script>
    swal("Email/Password Salah", "Silahkan Coba Lagi!", "error");
</script>
@endif
@if ($errors->any())
<script>
    let arr = new Array();
    <?php foreach($errors->all() as $e){ ?>
        arr.push('<?php echo $e; ?>');
    <?php } ?>

    let ul_el = document.createElement("UL");

    arr.forEach(ar =>{
        ul_el.innerHTML += '<li>'+ar+'</li>';
    });

    swal({
        title: "Sorry...",
        content: ul_el,
        icon: "error",
    });
</script>

@endif
@endsection
