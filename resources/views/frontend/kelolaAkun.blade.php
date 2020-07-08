@extends('template.all')

@section('JudulHalaman','Kelola Akun')

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

    .pass input{
      border-radius:16px 0 0 16px;
    }

    .pass button{
      border-radius:0 16px 16px 0;
    }

    .pass button:hover{
      border-radius:0 16px 16px 0;
      background-color:#26a69a;
    }

    .newPass input{
      border-radius:16px 0 0 16px;
    }

    .newPass button{
      border-radius:0 16px 16px 0;
    }

    .newPass button:hover{
      border-radius:0 16px 16px 0;
      background-color:#26a69a;
    }

    .save{
      background-color:#26a69a;
    }

    .save:hover{
      background-color:#1f8f84;
    }

    @media screen and (max-width: 850px) {
        .container {
            width: 90%;
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
            <h3>Kelola Akun</h3>
        </div>
        <div class="dropdown-divider mb-5"></div>
        <form action="" method="POST">
            @csrf
            <div class="mb-4">
                <div class="form-group">
                    <input type="text" class="form-control border-radius-c border-hijau" name="nama" placeholder="Nama"
                        required>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group">
                    <input type="email" class="form-control border-radius-c border-hijau" name="email"
                        placeholder="Email" aria-describedby="emailHelp" readonly>
                </div>
            </div>

            <div class="mb-4">
              <div class="input-group pass">
                <input type="password" class="form-control border-hijau" placeholder="Password" aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary border-hijau" type="button"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>

            <div class="mb-4">
              <div class="input-group newPass">
                <input type="password" class="form-control border-hijau" placeholder="Password baru" aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary border-hijau" type="button"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                </div>
               
              </div>
              <small id="emailHelp" class="form-text text-muted">Hanya diisi ketika ingin mengganti password saja.</small>
            </div>

            <div class="dropdown-divider mt-5"></div>
            <div class="mt-4" style="text-align:center">
                <button type="submit" class="btn btn-success btn-lg shadow save">Simpan</button>
            </div>

        </form>

    </div>
</div>

@endsection

@section('JsTambahanAfter')
<script src="{{asset('js\page\show-hidePass.js')}}"></script>

@if (Session::get('message'))
<script>
    swal("Pendaftaran Berhasil.","","success");
</script>
@endif
@endsection
