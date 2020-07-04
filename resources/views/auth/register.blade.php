@extends('template.all')

@section('JudulHalaman','Certiffet - Daftar')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/style-yusuf.css')}}">
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container">
    <article class="text-center auth">
        <h1 id="judul2">
            Daftar
        </h1>
        <form id="daftar" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control mx-auto" id="exampleInputNama"
                    placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control mx-auto" id="exampleInputEmail"
                    placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control mx-auto" id="exampleInputPassword"
                    placeholder="Password">
            </div>
            <img src='{{asset("images/Savings-pana.png")}}'>
            <button type="submit" class="btn btn-outline-dark btn-auth">Daftar</button>
            <h4 id="text1">Sudah punya akun? <a href="{{route('login')}}"><span>masuk</span></a></h4>
        </form>
    </article>
</div>
@endsection
@section('JsTambahanAfter')
<script>
    $("#daftar").on("submit",function(){
        $(".se-pre-con").fadeIn();
    });
</script>
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
    });
</script>

@endif
@endsection
