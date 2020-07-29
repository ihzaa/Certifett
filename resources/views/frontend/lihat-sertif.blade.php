@extends('template.all')

@section('JudulHalaman','Sertifikat')

@section('CssTambahanAfter')

@endsection
<style>
    @font-face {
        font-family: "Verdana" !important;
        src: url('/assets/webfonts/verdana.ttf') !important;
    }
    #sertifikat{
        font-family: "Verdana" !important;
    }
    @media screen and (max-width: 800px) {
        .header h1 {
            font-size: 18px;
        }
    }
</style>
@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container mt-4">
    <div class="d-flex justify-content-between header" style="margin-bottom:20px">
        <h1>Sertifikat Terverifikasi</h1>
        <button class="btn btn-outline-dark" id="btn_dwnld"><i class="fa fa-download" aria-hidden="true"> Download
                Sertifikat</i></button>
    </div>
    <div class="m-auto" id="sertifikat"
        style="width:1100px; height:fit-content; padding:25px; text-align:center; border: 1px solid #787878;background-color: white;">
        <p class="text-hijau" style="margin-left:-965px">#{{ $data['peserta']->id }}</p>
        <div style="text-align:center;">
            <div class="d-flex justify-content-center" style="height:60px">
                <img src="{{asset($data['sertif']->logo_sertifikat)}}" height="60">
                <div
                    style="font-size:60px; font-weight:400;text-decoration-line: underline; line-height:60px; margin-top:-7px;margin-left:20px;color: #263238;text-transform: uppercase;">
                    {{$data['sertif']->jenis_sertifikat}}</div>
            </div>

            <br><br>

            <div class="d-flex justify-content-center">
                <img src="{{asset($data['sertif']->logo_instansi)}}" height="70">
                <div style="text-align:left; margin-left:15px">
                    <h5 class="text-hijau"> INSTANSI</h5>
                    <h5>{{$data['sertif']->nama_instansi}}</h5>
                </div>
            </div>
            <br>
            <h5 class="text-hijau">Diberikan Kepada</h5>
            <br>
            <h1 style="text-transform: uppercase;">{{$data['peserta']->name}}</h1>
            <br>
            <h5 style="font-weight:400">{{$data['sertif']->alasan}}</h5>

            <div class="d-flex justify-content-around" style="margin-top:30px;">
                @foreach ($data['sertif_khusus'] as $d)
                <div>
                    <h6 class="text-hijau" style="text-transform: uppercase;">{{ $d->nama }}</h6>
                    @if ($d->gambar != null)
                    <img src="{{asset($d->gambar)}}" height="100">
                    <h6 style="text-transform: uppercase;">{{ $d->data }}</h6>
                    @else
                    <h6 style="text-transform: uppercase;margin-top: 100px;">{{ $d->data }}</h6>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('JsTambahanAfter')
<script src="{{asset('js/dom-to-image.min.js')}}"></script>
<script src="{{asset('js/page/lihat-sertif.js')}}"></script>
@endsection
