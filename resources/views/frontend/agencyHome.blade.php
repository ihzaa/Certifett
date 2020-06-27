@extends('template.all')

@section('JudulHalaman','Certiffet - Agency Home')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/style-yusuf.css')}}">
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container">
  <div class="card" id="emailVerification">
    <div class="d-flex flex-sm-row justify-content-between">
      <div class="d-flex">
        <img src='{{asset("icons/warning-24px.svg")}}'>
        <p>Email belum diverifikasi.</p>
      </div>
      <div>
        <p>Kirim Ulang</p>
      </div>
    </div>
  </div>
  <articel id="agencyHome">
    <div class="d-flex justify-content-between box">
      <h1>Acara</h1>
      <button class="btn btn-outline-dark" id="acaraBaru">Acara Baru</button>
    </div>
    <div class="d-flex box">
      <div class="card">
        <h3>JS 101</h3>
        <p>Jumat, 12 Januari 2020</p>
        <a href="#">
          <h3>12.256</h3>
          <p>Peserta</p>
        </a>
        <a href="#">
          <h3>10.567</h3>
          <p>Sertifikat Dibuat</p>
        </a>
        <div class="edit">
          <img src='{{asset("icons/delete-24px.svg")}}'>
          <img src='{{asset("icons/create-24px.svg")}}'>
        </div>
      </div>
      <div class="card">
        <h3>JS 102</h3>
        <p>Jumat, 12 Januari 2020</p>
        <a href="#">
          <h3>0</h3>
          <p>Peserta</p>
        </a>
        <a href="#">
          <h3>0</h3>
          <p>Sertifikat Dibuat</p>
        </a>
        <div class="edit">
          <img src='{{asset("icons/delete-24px.svg")}}'>
          <img src='{{asset("icons/create-24px.svg")}}'>
        </div>
      </div>
      <div class="card">
        <h3>JS 102</h3>
        <p>Jumat, 12 Januari 2020</p>
        <a href="#">
          <h3>0</h3>
          <p>Peserta</p>
        </a>
        <a href="#">
          <h3>0</h3>
          <p>Sertifikat Dibuat</p>
        </a>
        <div class="edit">
          <img src='{{asset("icons/delete-24px.svg")}}'>
          <img src='{{asset("icons/create-24px.svg")}}'>
        </div>
      </div>
      <div class="card">
        <h3>JS 102</h3>
        <p>Jumat, 12 Januari 2020</p>
        <a href="#">
          <h3>0</h3>
          <p>Peserta</p>
        </a>
        <a href="#">
          <h3>0</h3>
          <p>Sertifikat Dibuat</p>
        </a>
        <div class="edit">
          <img src='{{asset("icons/delete-24px.svg")}}'>
          <img src='{{asset("icons/create-24px.svg")}}'>
        </div>
      </div>
      <div class="card">
        <h3>JS 102</h3>
        <p>Jumat, 12 Januari 2020</p>
        <a href="#">
          <h3>0</h3>
          <p>Peserta</p>
        </a>
        <a href="#">
          <h3>0</h3>
          <p>Sertifikat Dibuat</p>
        </a>
        <div class="edit">
          <img src='{{asset("icons/delete-24px.svg")}}'>
          <img src='{{asset("icons/create-24px.svg")}}'>
        </div>
      </div>
    </div>
    </articel>
</div>
@endsection