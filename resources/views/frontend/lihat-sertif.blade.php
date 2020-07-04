@extends('template.all')

@section('JudulHalaman','Certiffet - Sertifikat')

@section('CssTambahanAfter')

@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container mt-4">
    <h1>Sertifikat Terverifikasi</h1>
    <div class="m-auto" style="width:1100px; height:600px; padding:20px; text-align:center; border: 10px solid #787878">
        <div style="width:1035px; height:540px; padding:20px; text-align:center; border: 5px solid #787878">
            <span><img src="{{asset($data['sertif']->logo_sertifikat)}}" height="70"></span>
            <span
                style="font-size:50px; font-weight:bold;text-decoration-line: underline;">{{$data['sertif']->jenis_sertifikat}}</span>
            <br><br>

            <div style="font-size:25px;">
                <img src="{{asset($data['sertif']->logo_instansi)}}" height="70">
                <span class="text-hijau"> INSTANSI</span>
                <br>
                <span>{{$data['sertif']->nama_instansi}}</span>
            </div>
            <br><br>
            <span style="font-size:15px;font-weight:bold;" class="text-hijau">Diberikan Kepada</span><br /><br />
            <span style="font-size:25px"><b>{{$data['peserta']->name}}</b></span> <br /><br />
            <span style="font-size:30px">{{$data['sertif']->alasan}}</span> <br /><br />

            @foreach ($data['sertif_khusus'] as $d)
            {{-- DISINI NANTI PROPERTY KHUSUNYA --}}
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('JsTambahanAfter')

@endsection
