<div class="m-auto" id="sertifikat"
    style="z-index: 1;position: relative;width:1122px; height:793px; padding:25px; text-align:center; border: 1px solid #787878;background-image: url({{asset("images/bg3.jpg")}});background-color: white;">
    <div style="position: absolute;
    z-index: -1;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-position: center;
    background-image: url({{asset("images/LPKIPI.png")}});
    background-repeat:no-repeat;
    background-size: 500px 300px;
    opacity: .1;
    width: 100%;
    height: 100%;"></div>
    @if(!request()->is('*acara*'))
    <div style="
    position: absolute;
    z-index: -1;
    top: 7px;">#{{$data['peserta']->id}}</div>
    @endif
    <div style="margin-top:40px">
        <div class="align-items-center" style="height:60px">
            <div class="float-left" style="margin-left:60px;margin-top:-15px">
                {{-- <img style="height:80px;" src="{{asset("images/image--008.png")}}"> --}}
                <img src="{{asset($data['sertif']->logo_sertifikat)}}" height="100">
            </div>
            <div class="float-right" style="margin-right:30px;margin-top: -15px;">
                <img style="margin-right:20px" src="{{asset($data['sertif']->logo_instansi)}}" height="100">
                {{-- <img src="{{asset($data['sertif']->logo_sertifikat)}}" height="60"> --}}
            </div>
        </div>

        <br><br>
        <div style="font-size:42px; font-weight:bold;color: black;text-transform: uppercase;">
            {{$data['sertif']->jenis_sertifikat}}</div>

        <h5 style="font-size:23px">Diberikan kepada :</h5>
        <br>
        <h1 id="nama_peserta_modal" class="px-4">
            {{request()->is('*certificate*') ? $data['peserta']->name : ""}}</h1>
        <br>
        <h5 style="font-size:20px;font-weight:400" class="mb-0 px-2">Sebagai peserta webinar
            <strong>{{$data['event']->name}}</strong>
        </h5>
        <h5 style="font-size:20px;font-weight:400" class="">
            <?php
                $arr = ["","Januari","Februari","Maret","April", "Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
                $tgl = \Carbon\Carbon::parse($data['event']->date)->format('d n Y');
                $arr_tgl = explode(" ",$tgl);
                echo "<p>".$data['sertif']->alasan. ' ' .$arr_tgl[0]. ' '.$arr[(int)$arr_tgl[1]].' '.$arr_tgl[2]."</p>"?>
        </h5>

        <div class="d-flex justify-content-around" style="margin-top:25px;">
            @foreach ($data['sertif_khusus'] as $d)
            <div style="max-width:400px" style="margin-botom:0px">
                <h6 style="font-size:19px;color:black;font-weight:400">{{ $d->nama }}</h6>
                @if ($d->gambar != null)
                <img src="{{asset($d->gambar)}}" height="100">
                <h6 style="font-weight:bold;"><?php echo "<p>$d->data</p>" ?></h6>
                @else
                <h6 style="text-decoration:underline;font-weight:bold;margin-top: 100px;">{{ $d->data }}</h6>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
