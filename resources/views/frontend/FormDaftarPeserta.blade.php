@extends('template.all')

@section('JudulHalaman','Pendaftaran Peserta')

@section('CssTambahanAfter')
<style>
    .container {
        width: 50%
    }

    .card {
        margin-top: 100px;
        padding: 30px;
        box-shadow: 1px 3px 6px #00000029;
    }

    .header {
        text-align: center;
    }

    small {
        margin-left: 10px;
    }

    @media screen and (max-width: 850px) {
        .container {
            width: 90%;
        }

        h3 {
            font-size: 18px;
        }
    }
</style>
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container">

    <div class="card border-radius-c">

        <div class="header">
            <h3>Form Pendaftaran Peserta Event {{$data['nama']}}</h3>
        </div>
        <div class="dropdown-divider mb-5"></div>
        <form action="{{route('peserta_daftar_link',['id'=>$data['id']])}}" method="POST">
            @csrf
            <div class="mb-4">
                <div class="form-group">
                    <input type="text" class="form-control border-radius-c border-hijau" name="nama" placeholder="Nama"
                        required>
                    <small id="emailHelp" class="form-text text-muted">Nama yang diinputkan pada sertifikat.</small>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <input type="email" class="form-control border-radius-c border-hijau" name="email"
                        placeholder="Email" aria-describedby="emailHelp" required>
                    <small id="emailHelp" class="form-text text-muted">Email pengiriman sertifikat.</small>
                </div>
            </div>
            <div class="dropdown-divider mt-5"></div>
            <div class="mt-4" style="text-align:center">
                <button type="submit" class="btn btn-success btn-lg shadow">Daftar</button>
            </div>

        </form>

    </div>
</div>

@endsection

@section('JsTambahanAfter')
@if (Session::get('message'))
<script>
    swal("Pendaftaran Berhasil.","","success");
</script>
@endif
@endsection
