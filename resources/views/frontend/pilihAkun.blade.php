@extends('template.all')
@section('JudulHalaman',"Certifett")
@section(' CssTambahanAfter')
<link rel="stylesheet" href="{{asset("css/style-yusuf.css")}}">
@endsection
@section('konten')
<main>
  <div id="content">
    <article class="text-center">
      <h1 id="judul2">
        Pilih Jenis Akun
      </h1>
      <div class="d-flex justify-content-center text-left">
        <div class="card image">
          <img class="img-fluid" src="{{asset("images/Team-pana@2x.png")}}">
          <h2 class="judul">Instansi</h2>
          <p>
          Daftar sebagai akun instansi untuk dapat membuat sertifikat.
          </p>
        </div>
        <div class="card">
          <img class="img-fluid" src="{{asset("images/Curious-pana@2x.png")}}">
          <h2 class="judul">Dasar</h2>
          <p>
          Daftar sebagai akun dasar untuk dapat melihat semua sertifikat yang terikat dengan email anda.
          </p>
        </div>
      </div>
      <h4 id="text1">sudah punya akun?</h4>
      <button type="button" class="btn btn-outline-dark masuk">Masuk</button>
    </article>
  </div>
</main>
@endsection