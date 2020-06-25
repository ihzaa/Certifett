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
  <article class="text-center reg">
    <h1 id="judul2">
      Daftar
    </h1>
    <img src='{{asset("images/Savings-pana.png")}}'>
    <form id="daftar">
      <div class="form-group">
        <input type="nama" class="form-control mx-auto" id="exampleInputNama" placeholder="Nama Lengkap">
      </div>
      <div class="form-group">
        <input type="email" class="form-control mx-auto" id="exampleInputEmail" placeholder="Email">
      </div>
      <div class="form-group">
        <input type="password" class="form-control mx-auto" id="exampleInputPassword" placeholder="Password">
      </div>
      <button type="button" class="btn btn-outline-dark btn-daftar">Daftar</button>
      <h4 id="text1">sudah punya akun? <span>masuk</span></h4>
    </form> 
    
  </article>
</div>
@endsection