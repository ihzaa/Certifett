@extends('template.all')

@section('JudulHalaman','Certiffet - Manage Participants')

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
                    <button type="button" class="btn btn-outline-dark">Import Sekarang</button>
                </div>
                <div class="card">
                    <h5>Share link</h5>
                    <p>Share link ini agar peserta dapat Mendaftar secara mandiri.</p>
                    <div class="d-flex">
                        <p id="linkCertifet">www.domain.com/certification/{{substr($data["acara"]->id,0,5)}}...</p>
                        <img src="{{asset('icons/content_copy-24px.svg')}}"
                            onclick="copyToClipboard('{{route('form_pendaftaran_event',['id'=>$data['acara']->id])}}')">
                    </div>
                </div>
            </div>
        </div>
        <img class="img-fluid" id="bgImage" src='{{asset("images/Online Review-pana@2x.png")}}'>
    </div>

    <div class="d-flex justify-content-between jumlah">
        <h3>
            <div id="jml_dicentang" class="d-inline">0</div>/ {{$data["jml_peserta"]}} <span>Peserta dicentang</span>
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
                            <img style="margin-left:30%" src='{{asset("icons/delete-24px.svg")}}'>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data["peserta"] as $d)
                    <tr>
                        <th scope="row">
                            <label class="check">
                                <input type="checkbox" name="chk[{{$d->id}}]"
                                    class="{{$d->certificate_id != "" ? "sudah_dibuat" : "check_input"}}">
                                <span class="check_indicator"></span>
                            </label>
                        </th>
                        <td>
                            @if($d->certificate_id != "")
                            <img src="{{asset('icons/check_circle-24px.svg')}}">
                            @endif
                            {{$d->name}}</td>
                        <td class="colHide">{{$d->email}}</td>
                        <td>
                            <a href=""><img src='{{asset("icons/create-24px.svg")}}'></a>
                            <a href=""><img src='{{asset("icons/delete-24px.svg")}}'></a>
                        </td>
                    </tr>
                    @endforeach

                    {{-- <tr>
                        <th scope="row">
                            <label class="check">
                                <input type="checkbox" class="check_input">
                                <span class="check_indicator"></span>
                            </label>
                        </th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td class="colHide">@mdo</td>
                        <td class="colHide">Mark</td>
                        <td class="colHide">Otto</td>
                        <td>
                            <img src='{{asset("icons/create-24px.svg")}}'>
                    <img src='{{asset("icons/delete-24px.svg")}}'>
                    </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label class="check">
                                <input type="checkbox" class="check_input">
                                <span class="check_indicator"></span>
                            </label>
                        </th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td class="colHide">@mdo</td>
                        <td class="colHide">Mark</td>
                        <td class="colHide">Otto</td>
                        <td>
                            <img src='{{asset("icons/create-24px.svg")}}'>
                            <img src='{{asset("icons/delete-24px.svg")}}'>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </form>

</div>
@endsection

@section('JsTambahanAfter')
<script src="{{asset('js/page/kelola-peserta.js')}}">
</script>
@endsection
