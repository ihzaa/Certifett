@extends('template.all')

@section('JudulHalaman','Certiffet - Create Event')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('css/buat-acara.css')}}">
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container mt-4">
    <form id="buatAcara" method="POST" action="{{route('tambah_event')}}" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <h1>Buat Acara</h1>

                @csrf
                <div class="form-group">
                    <input type="text" class="form-control border-radius-c" value="{{old('nama_acara')}}"
                        name="nama_acara" placeholder="Nama Acara" required>
                </div>
                <div class="form-group date">
                    <input type="text" class="form-control border-radius-c datepicker" name="tanggal"
                        placeholder="Tanggal Acara" required value="{{old('tanggal')}}">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-10 col-sm-10 col-md-10 col-xl-10 col-lg-10 pr-4">
                            <input type="number" class="form-control border-radius-c" name="jumlah"
                                placeholder="Jumlah Peserta" required value="{{old('jumlah')}}">
                        </div>
                        <div
                            class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 d-flex justify-content-end align-items-center">
                            <p class="m-auto ml-auto text-normal">Orang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h1>Properti Sertifikat</h1>
                <p class="text-normal">Properti Sertifikat yang akan terlihat ke peserta atau
                    publik.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <h5>Properti Umum</h5>
                <p class="text-normal">Properti yang umumnya terdapat pada sebuah sertifikat.</p>
                <div class="form-group">
                    <input type="text" class="form-control border-radius-c" name="nama_instansi"
                        placeholder="Nama Instansi*" required value="{{old('nama_instansi')}}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control border-radius-c" name="jenis_acara"
                        placeholder="Jenis/Nama Sertifikat*, contoh: Sertifikat, Piagam Penghargaan" required
                        value="{{old('jenis_acara')}}">
                </div>
                <div class="form-group">
                    <div class="preview-zone hidden">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <div><b>Preview</b></div>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-danger btn-sm remove-preview">
                                        <i class="fa fa-times"></i> Hapus
                                    </button>
                                </div>
                            </div>
                            <div class="box-body"></div>
                        </div>
                    </div>
                    <div class="dropzone-wrapper border-radius-c">
                        <div class="dropzone-desc" style="width: 90%;">
                            <img src="{{asset('images/add_photo.svg')}}" alt="" height="56" width="56" class="img-fluid"
                                style="float: left">
                            <h5 class="text-normal">Logo Instansi</h5>
                            <p class="text-normal">Drag atau klik untuk menambahkan</p>
                        </div>
                        <input type="file" name="logo_instansi" class="dropzone" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="preview-zone hidden">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <div><b>Preview</b></div>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-danger btn-sm remove-preview">
                                        <i class="fa fa-times"></i> Hapus
                                    </button>
                                </div>
                            </div>
                            <div class="box-body"></div>
                        </div>
                    </div>
                    <div class="dropzone-wrapper border-radius-c">
                        <div class="dropzone-desc" style="width: 90%;">
                            <img src="{{asset('images/add_photo.svg')}}" alt="" height="56" width="56" class="img-fluid"
                                style="float: left">
                            <h5 class="text-normal">Logo Acara/Sertifikat</h5>
                            <p class="text-normal">Drag atau klik untuk menambahkan</p>
                        </div>
                        <input type="file" name="logo_acara" class="dropzone" required>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control border-radius-c" required name="karena" rows="7" placeholder="Mendapatkan sertifikat karena…
contoh:
Karena telah mengikuti acara pelatihan JS 101 yang diselenggarakan oleh Team A">{{old('karena')}}</textarea>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="row">
                    <div class="col-10">
                        <h5>Properti Khusus</h5>
                    </div>
                    <div class="col-2">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="switch_properti_khusus"
                                name="switch_properti_khusus" data-on="Enabled" data-off="Enabled">
                            <label class="custom-control-label" for="switch_properti_khusus"></label>
                        </div>
                    </div>
                </div>
                <p class="text-normal">Properti yang dapat di atur sesuai kebutuhan sertifikat</p>
                <fieldset disabled>
                    <div id="properti-tambahan">
                        <div class="border border-radius-c p-2 mb-4" style="border-color: #495057;">
                            <p class="text-normal">
                                Properti Dengan Gambar
                            </p>
                            <p class="text-normal">
                                Tambah properti khusus dengan gambar yang bisa dipakai untuk menambah hal-hal seperti
                                pelaksana
                                acara lengkap dengan nama dan tanda tangan. atau untuk kebutuhan teks dan gambar
                                lainnya.
                            </p>
                            <div class="row">
                                <div class="col-10 ml-auto mr-auto">
                                    <div class="form-group">
                                        <input required type="text" class="form-control border-radius-c"
                                            placeholder="Nama Properti*, contoh: Ketua Pelaksana" name="khusus_nama[]">
                                    </div>
                                    <div class="form-group">
                                        <div class="preview-zone hidden">
                                            <div class="box box-solid">
                                                <div class="box-header with-border">
                                                    <div><b>Preview</b></div>
                                                    <div class="box-tools pull-right">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-preview">
                                                            <i class="fa fa-times"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="box-body"></div>
                                            </div>
                                        </div>
                                        <div class="dropzone-wrapper border-radius-c">
                                            <div class="dropzone-desc" style="width: 90%;">
                                                <img src="{{asset('images/add_photo.svg')}}" alt="" height="56"
                                                    width="56" class="img-fluid" style="float: left" id="gbr_add_foto">
                                                <h5 class="text-normal">Gambar</h5>
                                                <p class="text-normal" style="font-size: 12px;">Drag atau klik untuk
                                                    menambahkan
                                                    (optional)</p>
                                            </div>
                                            <input type="file" name="khusus_gambar[]" class="dropzone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea required class="form-control border-radius-c" name="khusus_properti[]"
                                            rows="5" placeholder="Data Properti*,
    contoh:

    Yusuf Ahmad
    NIK. 123 456 789"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button type="button" id="btn-tambah-properti"
                    class="btn btn-outline-secondary border-radius-c btn-block text-primary-c p-3"
                    style="border-color: #707070">
                    <h5>Tambah Properti Lain</h5>
                    <p class="mb-0">Tambah properti lain sesuai kebutuhan.</p>
                </button>
                <p class="text-normal mt-4">Perlu Bantuan? Hubungi kami <span
                        class="text-primary-c font-weight-bold">certifett@gmail.com</span></p>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-6"><button type="submit"
                    class="btn btn-outline-secondary btn-block font-weight-bold border-radius-c text-primary-c">
                    <p class=" mb-0">Lanjut</p>
                </button></div>

        </div>
    </form>
</div>
@endsection

@section('JsTambahanAfter')
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('js/page/buat-acara.js')}}"></script>
@if ($errors->any())
<script>
    let arr = new Array();
    <?php foreach($errors->all() as $e){ ?>
        arr.push('<?php echo $e; ?>');
    <?php } ?>

    let ul_el = document.createElement("UL");
    arr.forEach(ar =>{
        ul_el.innerHTML += '<li>'+ar+'</li>';
    });

    swal({
        title: "Sorry...",
        content: ul_el,
    });
</script>

@endif
@endsection
