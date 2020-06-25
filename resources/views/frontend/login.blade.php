@extends('template.all')

@section('JudulHalaman','Certiffet - Masuk')

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
      Masuk
    </h1>
    <form id="login">
      <div class="form-group">
      <div class="form-group">
        <input type="email" class="form-control mx-auto" id="exampleInputEmail" placeholder="Email">
      </div>
      <div class="form-group">
        <input type="password" class="form-control mx-auto" id="exampleInputPassword" placeholder="Password">
      </div>
      <img src='{{asset("images/Savings-pana.png")}}'>
      <button type="button" class="btn-outline-dark btn-auth">Masuk</button>
      <h4 id="text1">Belum punya akun? <a href="{{route('registration-page')}}"><span>daftar</span></a></h4>
    </form> 
    
  </article>
</div>
@endsection