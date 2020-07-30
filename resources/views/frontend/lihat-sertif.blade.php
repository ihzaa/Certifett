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
        style="width:1122px; height:793px; padding:25px; text-align:center; border: 1px solid #787878;background-image: url({{asset("images/bg.png")}});background-color: white;">
        <div style="margin-top:60px">
            <div class="align-items-center" style="height:60px">
              <div class="float-left" style="margin-left:50px;margin-top:-10px">
                  <img style="height:102px;" src="{{asset("images/image--008.png")}}">
              </div> 
              <div class="float-right" style="margin-right:60px">
                  <img style="margin-right:20px" src="{{asset($data['sertif']->logo_instansi)}}" height="70">
                  <img src="{{asset($data['sertif']->logo_sertifikat)}}" height="60">
              </div> 
            </div>

            <br><br>
            <div style="font-size:42px; font-weight:bold;color: black;text-transform: uppercase;">
                    {{$data['sertif']->jenis_sertifikat}}</div>
            
            <h5 style="font-size:23px">Diberikan kepada :</h5>
            <br>
            <h1 style="text-transform: uppercase;">{{$data['peserta']->name}}</h1>
            <br>
            <h5 style="font-size:21px;font-weight:400">Sebagai peserta webinar <strong>{{$data['event']->name}}</strong></h5>
            <h5 style="font-size:21px;font-weight:400">{{$data['sertif']->alasan}}</h5>

            <div class="d-flex justify-content-around" style="margin-top:50px;">
                @foreach ($data['sertif_khusus'] as $d)
                <div style="max-width:350px" style="margin-botom:0px">
                    <h6>{{ $d->nama }}</h6>
                    @if ($d->gambar != null)
                    <img src="{{asset($d->gambar)}}" height="100">
                    <h6 style="text-decoration:underline;font-weight:bold;">{{ $d->data }}</h6>
                    @else
                    <h6 style="text-decoration:underline;font-weight:bold;margin-top: 100px;">{{ $d->data }}</h6>
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
