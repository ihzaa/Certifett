{{-- <div class="m-auto" id="sertifikat"
    style="width:1100px; height:fit-content; padding:25px; text-align:center; border: 1px solid #787878;background-color: white;">
    <p class="text-hijau" style="margin-left:-965px" id="id_peserta_prev"></p>
    <div style="text-align:center;">
        <div class="d-flex justify-content-center" style="height:60px">
            <img src="" height="60" id="img-sertif">
            <div id="jenis_sertif_modal"
                style="font-size:60px; font-weight:400;text-decoration-line: underline; line-height:60px; margin-top:-7px;margin-left:20px;color: #263238;text-transform: uppercase;">
            </div>
        </div>

        <br><br>

        <div class="d-flex justify-content-center">
            <img src="" height="70" id="img-instansi">
            <div style="text-align:left; margin-left:15px">
                <h5 class="text-hijau"> INSTANSI</h5>
                <h5 id="nama_instansi_modal"></h5>
            </div>
        </div>
        <br>
        <h5 class="text-hijau">Diberikan Kepada</h5>
        <br>
        <h1 style="text-transform: uppercase;" id="nama_peserta_modal">~Nama Peserta~</h1>
        <br>
        <h5 style="font-weight:400" id="alasan_modal"></h5>

        <div class="d-flex justify-content-around" style="margin-top:30px;" id="footnya">

        </div>
    </div>
</div> --}}
<div class="m-auto" id="sertifikat"
    style="width:1122px; height:793px; padding:25px; text-align:center; border: 1px solid #787878;background-image: url({{asset("images/bg2.jpg")}});background-color: white;">
    <div style="margin-top:60px">
        <div class="align-items-center" style="height:60px">
            <div class="float-left" style="margin-left:60px;margin-top:-15px">
                {{-- <img style="height:80px;" src="{{asset("images/image--008.png")}}"> --}}
                <img id="img-sertif" height="100">
            </div>
            <div class="float-right" style="margin-right:30px;margin-top: -15px;">
                <img style="margin-right:20px" id="img-instansi" height="100">
                {{-- <img src="{{asset($data['sertif']->logo_sertifikat)}}" height="60"> --}}
            </div>
        </div>

        <br><br>
        <div style="font-size:42px; font-weight:bold;color: black;text-transform: uppercase;" id="jenis_sertif_modal">
        </div>

        <h5 style="font-size:23px">Diberikan kepada :</h5>
        <br>
        <h1 style="text-transform: uppercase;">~ NAMA PESERTA ~</h1>
        <br>
        <h5 style="font-size:21px;font-weight:400">Sebagai peserta webinar <strong id="nama_instansi_modal"></strong>
        </h5>
        <h5 style="font-size:21px;font-weight:400" id="alasan_modal"></h5>

        <div class="d-flex justify-content-around" style="margin-top:50px;" id="footnya">

            {{-- @foreach ($data['khusus'] as $d)
            <div style="max-width:400px" style="margin-botom:0px">
                <h6 style="font-size:19px;color:black;font-weight:400">{{ $d->nama }}</h6>
            @if ($d->gambar != null)
            <img src="{{asset($d->gambar)}}" height="100">
            <h6 style="text-decoration:underline;font-weight:bold;"><?php echo "<p>$d->data</p>" ?></h6>
            @else
            <h6 style="text-decoration:underline;font-weight:bold;margin-top: 100px;">{{ $d->data }}</h6>
            @endif
        </div>
        @endforeach --}}
    </div>
</div>
</div>
