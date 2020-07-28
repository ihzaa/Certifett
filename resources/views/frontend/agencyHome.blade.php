@extends('template.all')

@section('JudulHalaman','Agency Home')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/style-yusuf.css')}}">
@endsection

@section('header')
@include('template.components.nav-common')
@endsection

@section('konten')
<div class="container">
    @if(!$data["is_email_verify"])
    <div class="card" id="emailVerification">
        <div class="d-flex flex-sm-row justify-content-between">
            <div class="d-flex">
                <img src='{{asset("icons/warning-24px.svg")}}'>
                <p>Email belum diverifikasi.</p>
            </div>
            <div>
                <a style="text-decoration:none" href="{{route('kirimUlang')}}">
                    <p>Kirim Ulang</p>
                </a>
            </div>
        </div>
    </div>
    @endif
    <articel id="agencyHome">
        <div class="d-flex justify-content-between box">
            <h1>Acara</h1>
            <a class="btn btn-outline-dark" id="acaraBaru" href="{{route('createEvent-page')}}">Acara Baru</a>
        </div>
        <div class="d-flex justify-content-between box">
            <div class="input-group" id="list_acara">
                <input type="text" class="form-control search" onkeyup="search()" id="src_in"
                    placeholder="Cari Nama Acara">
            </div>
        </div>
        <div class="d-flex box" id="box_list_acara">
            <?php $i=0; ?>
            @foreach ($data["acara"] as $d)
            <div class="box_acara">
                <a href="{{route('peserta_acara',['id' => $d->id])}}">
                    <div class="card" id="card-{{$d->id}}">
                        <h3 class="nama_acara">{{$d->name}}</h3>
                        <p>{{\Carbon\Carbon::parse($d->date)->formatLocalized("%A, %d %B %Y") }}</p>
                        <h3>{{$data["jml_peserta"][$i]}}</h3>
                        <p>Peserta</p>
                        <h3>{{$data["jml_dibuat"][$i++]}}</h3>
                        <p>Sertifikat Dibuat</p>
                        <div class="edit">
                            <a href="#" @click="hapusKah('{{$d->id}}')"><img
                                    src='{{asset("icons/delete-24px.svg")}}'></a>
                            <a href="{{route('tampil_edit_acara',['id' => $d->id])}}"><img
                                    src='{{asset("icons/create-24px.svg")}}'></a>
                        </div>
                    </div>
                </a>
            </div>

            @endforeach
        </div>
    </articel>
    @if(!count($data["acara"]))
    <div class="row mt-5">
        <div class="col-10 col-lg-8 col-md-8 col-sm-10 border border-radius-c d-flex ml-auto mr-auto">
            <div class="text-center ml-auto mr-auto">
                <p class="mt-3">Anda Belum Memiliki Acara</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('JsTambahanAfter')
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/vue.min.js')}}"></script>
<script>
    function search() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("src_in");
    filter = input.value.toUpperCase();
    box_list = document.getElementById("box_list_acara");
    box = box_list.getElementsByClassName("box_acara");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < box.length; i++) {
        td_nama = box[i].getElementsByClassName("nama_acara")[0];
        if (td_nama) {
            txtNama = td_nama.innerText.toUpperCase();
            if (
                txtNama.toUpperCase().indexOf(filter) > -1
            ) {
                box[i].style.display = "";
            } else {
                box[i].style.display = "none";
            }
        }
    }
}
    var app = new Vue({
        el: '#agencyHome',
        data: {
            id_hapus: "",
        },
        methods: {
            hapusKah: function(id=0){

                event.preventDefault();
                swal({
                    title: "Yakin menghapus acara?",
                    text: "Data peserta dan sertifikat akan ikut dihapus!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $(".se-pre-con").fadeIn();
                        var dataform = new FormData();
                        dataform.append('id',id);
                        dataform.append('_token',$('meta[name="csrf-token"]').attr('content'));
                        axios.post("{{route('hapus_acara')}}",dataform).then(resp => {
                            this.hapusCard(id);
                            $(".se-pre-con").fadeOut("slow");;
                            swal(resp.data.message, {
                        icon: "success",
                        });
                        }).catch(err =>{
                            $(".se-pre-con").fadeOut("slow");;
                            alert('err ='+err);
                        });
                    }
                });
            },
            hapusCard: function(id){
                $("#card-"+id).remove();
            }
        }
    });
    $(document).on("click",".btn_hapus", function(){
        swal({
            title: "Yakin menghapus acara?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    });
</script>
@if(Session::get('message'))
<script>
    swal("Berhasil",'{{Session::get('message')}}' , "success");
</script>
@endif
@if(Session::get('reg'))
<script>
    swal("{{Session::get('reg')}}",'{{Session::get('body')}}' , "success");
</script>
@endif
@endsection
