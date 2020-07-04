@extends('template.all')

@section('JudulHalaman','Pendaftaran Peserta')

@section('CssTambahanAfter')

@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container mt-4">
    @if (Session::get('message'))
    <div class="row mt-auto mb-auto">
        <div
            class="col-12 col-11 col-sm-11 col-md-12 col-lg-12 col-xl-12 m-auto border border-radius-c border-hijau px-3 py-2 shadow">
            <h1>Pendaftaran Anda Pada Acara {{$data['nama']}} Berhasil.</h1>
        </div>
    </div>
    @else
    <div class="row">
        <div
            class="col-11 col-sm-11 col-md-8 col-lg-8 col-xl-8 m-auto border border-radius-c border-hijau px-3 py-2 shadow">
            <h1>Halaman Pendaftaran Peserta</h1>
            <h3>{{$data['nama']}}</h3>
        </div>
    </div>
    <form action="{{route('peserta_daftar_link',['id'=>$data['id']])}}" method="POST">
        @csrf
        <div class="row mt-4">
            <div
                class="col-11 col-sm-11 col-md-8 col-lg-8 col-xl-8 m-auto border border-radius-c border-hijau px-3 py-2 shadow">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control border-radius-c border-hijau" name="nama" required>
                    <small id="emailHelp" class="form-text text-muted">Nama yang diinputkan pada sertifikat.</small>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div
                class="col-11 col-sm-11 col-md-8 col-lg-8 col-xl-8 m-auto border border-radius-c border-hijau px-3 py-2 shadow">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control border-radius-c border-hijau" name="email"
                        aria-describedby="emailHelp" required>
                    <small id="emailHelp" class="form-text text-muted">Email pengiriman sertifikat.</small>
                </div>
            </div>
        </div>
        <div class="row d-flex mt-4">
            <button type="submit" class="btn m-auto btn-success btn-lg shadow">Daftar</button>
        </div>
    </form>
</div>
@endif

@endsection

@section('JsTambahanAfter')

@endsection
