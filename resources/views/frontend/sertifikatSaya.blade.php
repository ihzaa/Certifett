@extends('template.all')

@section('JudulHalaman','Certiffet - My Certificates')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/style-yusuf.css')}}">
<link rel="stylesheet" href="{{asset('css/checkbox-custom.css')}}">
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container" id="kelolaSertifikat">
    <h2>Sertifikat saya</h2>

    <div class="input-group mb-5">
        <input type="text" class="form-control search" onkeyup="search()" id="src_in" placeholder="Nama atau Email">
    </div>

    <form>
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
                        <th scope="col">ID Sertifikat</th>
                        <th scope="col">Nama</th>
                        <th scope="col" class="colHide">Email</th>
                        <th scope="col" class="colHide">Tanggal Rilis</th>
                        <th scope="col" class="colHide">Berlaku Sampai</th>
                        <th scope="col">
                            <img src='{{asset("icons/create-24px.svg")}}'>
                            <img src='{{asset("icons/delete-24px.svg")}}'>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data["sertif"] as $d)
                    <tr>
                        <th scope="row">
                            <label class="check">
                                <input type="checkbox" name="chk" class="check_input">
                                <span class="check_indicator"></span>
                            </label>
                        </th>
                        <td>{{$d->id}}</td>
                        <td>{{$d->name}}</td>
                        <td class="colHide">{{$d->email}}</td>
                        <td class="colHide">{{\Carbon\Carbon::parse($d->release_date)->formatLocalized("%A, %d %B %Y")}}
                        </td>
                        <td class="colHide">
                            {{$d->valid_until == ""? "Selamanya":\Carbon\Carbon::parse($d->valid_until)->formatLocalized("%A, %d %B %Y")}}
                        </td>
                        <td>
                            <img src='{{asset("icons/create-24px.svg")}}'>
                            <img src='{{asset("icons/delete-24px.svg")}}'>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>

</div>
@endsection

@section('JsTambahanAfter')
<script src="{{asset('js/page/sertifikat_saya.js')}}">
</script>
@endsection
