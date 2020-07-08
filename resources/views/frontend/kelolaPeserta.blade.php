@extends('template.all')

@section('JudulHalaman','Manage Participants')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/style-yusuf.css')}}">
<link rel="stylesheet" href="{{asset('css/checkbox-custom.css')}}">
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container kelola" id="kelolaSertifikat">
    <div class="d-flex kelolaPeserta">
        <div>
            <h2>Peserta</h2>
            <p>Daftar peserta yang terdaftar dalam {{$data["acara"]->name}}. Buat sertifikat dengan cara mencentang
                kotak
                disamping kiri nama dan tekan tombol buat di sudut kanan atas tabel. Sertifikat yang telah dibuat dapat
                diunduh oleh peserta melalui www.domain.com/certificate dan www.ourdomain.com/cerfiticate. Tekan baris
                dari tabel dibawah untuk melihat preview sertifikat.</p>
            <div class="info tengah">
                <img src='{{asset("icons/event-24px.svg")}}'>
                <h5>{{$data["acara"]->name}}</h5>
            </div>
            <div class="info">
                <img src='{{asset("icons/schedule-24px.svg")}}'>
                <h5>{{\Carbon\Carbon::parse($data['acara']->date)->formatLocalized("%A, %d %B %Y") }}</h5>
            </div>
            <div class="d-flex kartu">
                <div class="card">
                    <h5>Import from .csv</h5>
                    <p>Export data yang telah ada. Format yang diterima adalah csv. Gunakan ini jika anda telah memiliki
                        data peserta misalnya dari google form.</p>
                    <button type="button" class="btn btn-outline-dark" id="btn-import" data-toggle="modal"
                        data-target="#modal-csv">Import Sekarang</button>
                </div>
                <div class="card">
                    <h5>Share link</h5>
                    <p>Share link ini agar peserta dapat Mendaftar secara mandiri.</p>
                    <div class="d-flex">
                        <p id="linkCertifet">www.domain.com/certification/{{substr($data["acara"]->id,0,5)}}...</p>
                        <img src="{{asset('icons/content_copy-24px.svg')}}" id="cpy_btn"
                            onclick="copyToClipboard('{{route('form_pendaftaran_event',['id'=>$data['acara']->id])}}')">
                    </div>
                </div>
            </div>
        </div>
        <img class="img-fluid" id="bgImage" src='{{asset("images/Online Review-pana@2x.png")}}'>
    </div>

    <div class="d-flex justify-content-between jumlah">
        <h3>
            <div id="jml_dicentang" class="d-inline">0</div>/ <div id="jml_psrt" class="d-inline">
                {{$data["jml_peserta"]}}</div> <span>Peserta dicentang</span>
        </h3>
        <button type="button" class="btn btn-outline-dark" id="buatSertif" href="">Buat
            Sertifikat</button>
    </div>

    <div class="input-group mb-5">
        <input type="text" class="form-control search" onkeyup="search()" id="src_in" placeholder="Nama atau Email">
    </div>

    <form id="form_centang" action="{{route('buat_sertifikat',['id' => $data["acara"]->id])}}" method="POST">
        @csrf
        <div class="table-responsive my-custom-scrollbar" id="style-2">
            <table class="table" id="tabel_list">
                <thead class="thead-dark">
                    <tr class="tableHead">
                        <th scope="col">
                            <label class="check">
                                <input type="checkbox" onchange="checkAll(this)" class="check_header" id="check_header">
                                <span class="check_indicator" id="checkbox_header"></span>
                            </label>
                        </th>
                        <th scope="col">Nama</th>
                        <th scope="col" class="colHide">Email</th>
                        <th scope="col">
                            <a href="#" id="btn-hps-all"><img src='{{asset("icons/delete-24px.svg")}}'></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data["peserta"] as $d)
                    <tr>
                        <th scope="row">
                            <label class="check">
                                <input type="checkbox" @if($d->release_date == "") name="chk[{{$d->id}}]" @else
                                name="udh[{{$d->id}}]" @endif
                                class="{{$d->release_date != "" ? "sudah_dibuat check_input" : "check_input blm_dibuat"}}">
                                <span class="check_indicator"></span>
                            </label>
                        </th>
                        <td onclick="previewSertif('{{$d->name}}','{{$d->id}}')" class="clickable">
                            @if($d->release_date != "")
                            <img src="{{asset('icons/check_circle-24px.svg')}}">
                            @endif
                            <span id="col_nama">{{$d->name}}</span>
                        </td>
                        <td class="colHide clickable" id="col_email"
                            onclick="previewSertif('{{$d->name}}','{{$d->id}}')">
                            {{$d->email}}</td>
                        <td>
                            <a href="#" class="btn-edit"><img src='{{asset("icons/create-24px.svg")}}'></a>
                            <a href="#" class="btn-hps"><img src='{{asset("icons/delete-24px.svg")}}'></a>
                        </td>
                    </tr>
                    @endforeach
                    @if(count($data["peserta"]) == 0)
                    {{-- INI KETERANGAN DATA KOSONG --}}
                    <tr>
                        <th colspan="100%" class="text-center">Tidak ada data peserta</th>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </form>
    <div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Edit data</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input id="nama_edit" type="text" class="form-control border-radius-c border-hijau"
                                name="nama" required style="width: 100% !important;">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input id="email_edit" type="email" class="form-control border-radius-c border-hijau"
                                name="email" aria-describedby="emailHelp" required style="width: 100% !important;">
                        </div>
                    </div>
                    <div class="modal-footer d-felx">
                        <button type="submit" class=" ml-auto btn btn-dark">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-csv" class="modal fade " data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Pilih file</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="input-csv"
                            aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="input-csv" id="input-csv-label">Choose file .csv</label>
                    </div>
                </div>
                <button type="button" class="btn btn-dark" id="btn-cek-kolom" disabled>Cek Kolom</button>
                <div id="body_bawah_modal" style="display: none;">
                    <hr>
                    <h3>Pilih Kolom Nama:</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" id="grb-nama"></div>
                    <h3>Pilih Kolom Email:</h3>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" id="grb-email"></div>
                </div>
            </div>
            <div class="modal-footer d-flex">
                <button type="button" class=" ml-auto btn btn-dark" id="btn-up-csv"
                    style="display: none;">Upload</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-preview" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="m-auto" id="sertifikat"
                    style="width:1100px; height:fit-content; padding:25px; text-align:center; border: 1px solid #787878;background-color: white;">
                    <p class="text-hijau" style="margin-left:-965px" id="id_peserta_prev"></p>
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
                        <h1 style="text-transform: uppercase;" id="nama_peserta_modal"></h1>
                        <br>
                        <h5 style="font-weight:400">{{$data['sertif']->alasan}}</h5>

                        <div class="d-flex justify-content-around" style="margin-top:30px;">
                            @foreach ($data['khusus'] as $d)
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
        </div>
    </div>
</div>


@endsection

@section('JsTambahanAfter')
<script>
    const path = {
        ev : "{{route('tambah_peserta_csv',['id'=>$data['id']])}}",
        ps : "{{route('hapus_peserta')}}",
        psb : "{{route('hapus_peserta_banyak')}}"
    }
</script>
<script src="{{asset('js/notify.min.js')}}"></script>
<script src="{{asset('js/papaparse.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/page/kelola-peserta.js')}}">
</script>
@if(Session::get('message'))
<script>
    swal("Berhasil",'{{Session::get('message')}}' , "success");
</script>

@endif
@endsection
