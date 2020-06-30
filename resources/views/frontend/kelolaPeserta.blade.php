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
<div class="container" id="kelolaSertifikat">
  <div class="d-flex kelolaPeserta">
    <div>
      <h2>Peserta</h2>
      <p>Daftar peserta yang terdaftar dalam JS 101.Buat sertifikat dengan cara mencentang kotak disamping kiri nama dan tekan tombol buat di sudut kanan atas tabel. Sertifikat yang telah dibuat dapat diunduh oleh peserta melalui www.domain.com/certificate dan www.ourdomain.com/cerfiticate. Tekan baris dari tabel dibawah untuk melihat preview sertifikat.</p>
      <div class="info tengah">
        <img src='{{asset("icons/event-24px.svg")}}'>
        <h5>JS 101</h5>
      </div>
      <div class="info">
        <img src='{{asset("icons/schedule-24px.svg")}}'>
        <h5>Jumat, 12 Januari 2020</h5>
      </div>
    </div>
    <img class="img-fluid" src='{{asset("images/Online Review-pana@2x.png")}}'>
  </div>
  
  <div class="input-group mb-5">
    <input type="text" class="form-control search" placeholder="Nama atau Email">
  </div>

<form>
<div class="table-responsive my-custom-scrollbar" id="style-2">
  <table class="table">
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
        <img style="margin-left:48px" src='{{asset("icons/delete-24px.svg")}}'>
      </th>
    </tr>
  </thead>
  <tbody>
  <tr>
      <th scope="row">
      <label class="check">
          <input type="checkbox" name="chk" class="check_input">
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
    </tr>
    </tbody>
  </table>
  </div>
</form>
  
</div>
@endsection

@section('JsTambahanAfter')
<script src="{{asset('js/page/checkbox.js')}}">
</script>
@endsection