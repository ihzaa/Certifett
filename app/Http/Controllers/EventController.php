<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use App\Models\certificate_specific_property;
use App\Models\event;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function tambah(Request $request)
    {
        if (isset($request->switch_properti_khusus)) {
            $validatedData = $request->validate([
                'nama_acara' => ['required', 'max:255'],
                'tanggal' => ['required'],
                'jumlah' => ['integer'],
                'nama_instansi' => ['required'],
                'jenis_acara' => ['required'],
                'logo_instansi' => ['required', 'image', 'max:512'],
                'logo_acara' => ['required', 'image', 'max:512'],
                'karena' => ['required'],
                'khusus_nama' => ['required'],
                'khusus_properti' => ['required']
            ]);
            foreach ($request->file('khusus_gambar') as $f) {
                if (!in_array($f->getClientOriginalExtension(), array("jpeg", "png", "bmp", "gif", "svg",  "webp"))) {
                    return back()->withErrors(['Properti Khusus Gambar Must Be An Image'])->withInput();
                }
            }
        } else {
            $validatedData = $request->validate([
                'nama_acara' => ['required', 'max:255'],
                'tanggal' => ['required'],
                'jumlah' => ['integer'],
                'nama_instansi' => ['required'],
                'jenis_acara' => ['required'],
                'logo_instansi' => ['required', 'image', 'max:512'],
                'logo_acara' => ['required', 'image', 'max:512'],
                'karena' => ['required']
            ]);
        }
        $sertifikat = certificate::create([
            "nama_instansi" => $request->nama_instansi,
            "jenis_sertifikat" => $request->jenis_acara,
            "logo_instansi" => "a",
            "logo_sertifikat" => "a",
            "alasan" => $request->karena
        ]);
        $file = $request->file('logo_instansi');
        $nama_file =  $sertifikat->id . '_logo_instansi_' . '.' . $file->getClientOriginalExtension();
        $tujuan_upload = 'assets/images/Logo_Instansi/';
        $logo_instansi = 'images/Logo_Instansi/' . $nama_file;
        $file->move($tujuan_upload, $nama_file);

        $file = $request->file('logo_acara');
        $nama_file =  $sertifikat->id . 'logo_acara' . '.' . $file->getClientOriginalExtension();
        $tujuan_upload = 'assets/images/Logo_Sertifikat/';
        $logo_sertif = 'images/Logo_Sertifikat/' . $nama_file;
        $file->move($tujuan_upload, $nama_file);

        $sertifikat->logo_instansi = $logo_instansi;
        $sertifikat->logo_sertifikat = $logo_sertif;
        $sertifikat->save();

        for ($i = 0; $i < count($request->khusus_nama); $i++) {
            if (!isset($request->khusus_gambar[$i])) {
                certificate_specific_property::create([
                    "nama" => $request->khusus_nama[$i],
                    "data" => $request->khusus_properti[$i],
                    "certificate_id" => $sertifikat->id
                ]);
            } else {
                $file = $request->file('khusus_gambar')[$i];
                $nama_file =  $sertifikat->id . 'Properti_Khusus' . '.' . $file->getClientOriginalExtension();
                $tujuan_upload = 'assets/images/Properti_Khusus/';
                $khusus_gambar = 'images/Properti_Khusus/' . $nama_file;
                $file->move($tujuan_upload, $nama_file);
                certificate_specific_property::create([
                    "nama" => $request->khusus_nama[$i],
                    "data" => $request->khusus_properti[$i],
                    "gambar" => $khusus_gambar,
                    "certificate_id" => $sertifikat->id
                ]);
            }
        }

        $data = event::create([
            "name" => $request->nama_acara,
            "date" => DateTime::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d'),
            "capacity" => $request->jumlah,
            "user_owner" => Auth::id(),
            "receipt_id" => "1",
            "certificate_id" => $sertifikat->id
        ]);

        return redirect(route('agencyHome-page'))->with('message', 'Berhasil Menambahkan Acara');
    }
}
