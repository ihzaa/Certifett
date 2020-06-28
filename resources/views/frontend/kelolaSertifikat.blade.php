@extends('template.all')

@section('JudulHalaman','Certiffet - Manage Certificate')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/style-yusuf.css')}}">
<link rel="stylesheet" href="{{asset('css/checkbox-custom.css')}}">
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container" id="kelolaSertifikat">
  <h2>Sertifikat</h2>
  <div class="info">
    <h2>10.567</h2>
    <p>sertifikat dibuat</p>
  </div>
  <div class="info tengah">
    <img src='{{asset("icons/event-24px.svg")}}'>
    <h5>JS 101</h5>
  </div>
  <div class="info">
    <img src='{{asset("icons/schedule-24px.svg")}}'>
    <h5>Jumat, 12 Januari 2020</h5>
  </div>

  <div class="input-group mb-5">
    <input type="text" class="form-control search" placeholder="Nama atau Email">
  </div>

  <div class="table-responsive">
  <table class="table">
  <thead class="thead-dark">
    <tr class="tableHead">
      <th scope="col">
        <label class="check">
          <input type="checkbox" class="check_input">
          <span class="check_indicator"></span>
        </label>
      </th>
      <th scope="col">ID Sertifikat</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Tanggal Rilis</th>
      <th scope="col">Berlaku Sampai</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">
      <label class="check">
          <input type="checkbox" class="check_input">
          <span class="check_indicator"></span>
        </label>
      </th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Otto</td>
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
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td></td>
      <td></td>
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
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
      <td></td>
      <td></td>
      <td>
        <img src='{{asset("icons/create-24px.svg")}}'>
        <img src='{{asset("icons/delete-24px.svg")}}'>
      </td>
    </tr>
    </tbody>
  </table>
  </div>
</div>
@endsection