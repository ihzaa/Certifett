@extends('template.all')

@section('JudulHalaman','Certiffet - Create Event')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/style-yusuf.css')}}">
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container">
  <h1>Buat Acara</h1>
  <form id="buatAcara">
      <div class="form-group">
        <input type="namaAcara" class="form-control" id="NamaAcara" placeholder="Nama Acara">
      </div>
      <div class="form-group">
        <input type="tanggalAcara" class="form-control" id="tanggalAcara" placeholder="Tanggal Acara">
      </div>
      <div class="form-group">
        <input type="jumlahPeserta" class="form-control" id="jumlahPeserta" placeholder="Jumlah Peserta">
      </div>
    </form>
    <h1>Properti Sertifikat</h1>
</div>
@endsection