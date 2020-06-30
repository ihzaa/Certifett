@extends('template.all')

@section('JudulHalaman','Certifett - Create Certificate')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-auto">
            <img src="{{asset('images/Photocopy-pana.png')}}" class="img-fluid" alt="" width="500">
            <h1 class="text-primary-c">Buat Sertifikat</h1>
            <span>
                <h2 class="text-primary-c d-inline-block">10.000</h2>
                <p class="text-normal d-inline-block ml-3">Sertifikat akan dibuat</p>
            </span>
            <div class="form-group date mt-5">
                <input type="text" class="form-control border-radius-c datepicker" placeholder="Tanggal Acara">
            </div>
            <div class="form-inline">
                <input type="number" class="form-control mb-2 border-radius-c" id="inlineFormInputName2"
                    placeholder="Masa Berlaku" style="width: 74%;">
                <select class="form-control mb-2 ml-auto border-radius-c" style="width: 24%;">
                    <option>Tahun</option>
                    <option>Bulan</option>
                </select>
            </div>
            <p class="text-normal mt-2 mb-5">Kosongkan jika sertifikat tidak memiliki masa berlaku</p>
            <div class="form-group">
                <textarea class="form-control border-radius-c" id="karena" rows="7" placeholder="Kata kata ucapan selamat
contoh:
Sertifikat ini diberikan kepada yang bersangkutan karena telah mengikuti seminar JS 101"></textarea>
            </div>
            <button type="submit"
                class="btn btn-outline-secondary btn-block font-weight-bold border-radius-c text-primary-c mt-5 mb-5">
                <p class=" mb-0">Lanjut</p>
            </button>
        </div>
    </div>
</div>

@endsection

@section('JsTambahanAfter')
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script>
    $(document).ready(function () {
    $(".datepicker").datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        orientation: "bottom",
    });
});
</script>
@endsection
