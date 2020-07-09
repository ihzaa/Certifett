@extends('template.all')

@section('JudulHalaman','Kelola Akun')

@section('CssTambahanAfter')
<style>
    .container {
        width: 50%
    }

    .card {
        margin-top: 40px;
        padding: 30px;
        box-shadow: 1px 3px 6px #00000029;
    }

    .header {
        text-align: center;
    }

    small {
        margin-left: 10px;
    }

    .pass input {
        border-radius: 16px 0 0 16px;
    }

    .pass button {
        border-radius: 0 16px 16px 0;
    }

    .pass button:hover {
        border-radius: 0 16px 16px 0;
        background-color: #26a69a;
    }

    .newPass input {
        border-radius: 16px 0 0 16px;
    }

    .newPass button {
        border-radius: 0 16px 16px 0;
    }

    .newPass button:hover {
        border-radius: 0 16px 16px 0;
        background-color: #26a69a;
    }

    .save {
        background-color: #26a69a;
    }

    .save:hover {
        background-color: #1f8f84;
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
        <form action="{{ route('editAccount') }}" method="POST">
            @csrf
            <input type="text" class="form-control border-radius-c border-hijau" name="id" readonly hidden
                value="{{ $data->id }}">

            <div class="mb-4">
                <div class="form-group">
                    <input type="text" class="form-control border-radius-c border-hijau" name="nama" placeholder="Nama"
                        required value="{{ $data->name }}">
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group">
                    <input type="email" class="form-control border-radius-c border-hijau" name="email"
                        placeholder="Email" value="{{ $data->email }}" readonly>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group">
                    <input type="text" class="form-control border-radius-c border-hijau" name="apiKey"
                        placeholder="apiKey" value="{{ $data->api_key }}" readonly>
                    <small class="form-text text-muted">Ini adalah API key akun anda.</small>
                </div>
            </div>

            <div class="mb-4">
                <div class="input-group pass">
                    <input type="password" class="form-control border-hijau" placeholder="Password"
                        aria-label="Recipient's username" name="pass" aria-describedby="button-addon2" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary border-hijau" type="button"><i class="fa fa-eye-slash"
                                aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="input-group newPass">
                    <input type="password" class="form-control border-hijau" placeholder="Password baru"
                        aria-label="Recipient's username" name="newPass" minlength="8" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary border-hijau" type="button"><i class="fa fa-eye-slash"
                                aria-hidden="true"></i></button>
                    </div>

                </div>
                <small id="newPassword" class="form-text text-muted">Hanya diisi ketika ingin mengganti password
                    saja.</small>
            </div>

            <div class="dropdown-divider mt-5"></div>
            <div class="mt-4" style="text-align:center">
                <button type="submit" class="btn btn-success btn-lg shadow save">Simpan</button>
            </div>

        </form>

    </div>
</div>
<div id="modal_password" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h3 class="m-auto">Password Belum Diatur!</h3>
            </div>
            <form action="{{route('config_first_pass')}}" method="POST" id="form_first_pass">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <div class="input-group pass">
                            <input type="password" class="form-control border-hijau" placeholder="Password"
                                aria-label="Recipient's username" name="pass1" aria-describedby="button-addon2"
                                required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary border-hijau" type="button"><i
                                        class="fa fa-eye-slash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="input-group pass">
                            <input type="password" class="form-control border-hijau" placeholder="Tulis Ulang Password"
                                aria-label="Recipient's username" name="pass2" aria-describedby="button-addon2"
                                required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary border-hijau" type="button"><i
                                        class="fa fa-eye-slash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <div class="row">
                        <button class="btn btn-outline-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('JsTambahanAfter')
<script src="{{asset('js\page\show-hidePass.js')}}"></script>

@if(Session::get('modal_open') || $data['is_pass_null'] != "")
<script>
    $(document).ready(function(){
        $("#modal_password").modal('show');

        $("#form_first_pass").on("submit",function(){
            if($("input[name=pass1]").val() != $("input[name=pass2]").val()){
                event.preventDefault();
                swal("Password tidak sama!","","error");
                return;
            }
            if($("input[name=pass1]").val().length < 8 && $("input[name=pass2]").val().length < 8){
                event.preventDefault();
                swal("Password minimal 8 karakter!","","error");
                return;
            }
        });
    });
</script>
@endif
@if (Session::get('message'))
<script>
    swal("{{ Session::get('message') }}","","{{ Session::get('icon') }}");
</script>
@endif
@endsection
