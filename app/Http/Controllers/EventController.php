<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use App\Models\certificate_specific_property;
use App\Models\event;
use App\Models\participant_event_certificate;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
                if (!in_array($f->getClientOriginalExtension(), array("jpeg", "jpg", "png", "bmp", "gif", "svg",  "webp"))) {
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

        do {
            $r2 = rand() + rand();
            $id = Auth::id() . $r2;
        } while (!empty(certificate::find($id)));

        $sertifikat = certificate::create([
            "id" => $id,
            "nama_instansi" => $request->nama_instansi,
            "jenis_sertifikat" => $request->jenis_acara,
            "logo_instansi" => "a",
            "logo_sertifikat" => "a",
            "alasan" => $request->karena
        ]);

        $sertifikat->id = $id;
        $sertifikat->save();
        $file = $request->file('logo_instansi');
        $nama_file =  $id . '_logo_instansi_' . '.' . $file->getClientOriginalExtension();
        $tujuan_upload = 'assets/images/Logo_Instansi/';
        $logo_instansi = 'images/Logo_Instansi/' . $nama_file;
        $file->move($tujuan_upload, $nama_file);
        $file = $request->file('logo_acara');
        $nama_file =  $id . 'logo_acara' . '.' . $file->getClientOriginalExtension();
        $tujuan_upload = 'assets/images/Logo_Sertifikat/';
        $logo_sertif = 'images/Logo_Sertifikat/' . $nama_file;
        $file->move($tujuan_upload, $nama_file);

        $sertifikat->logo_instansi = $logo_instansi;
        $sertifikat->logo_sertifikat = $logo_sertif;
        $sertifikat->save();

        if (isset($request->switch_properti_khusus)) {
            for ($i = 0; $i < count($request->khusus_nama); $i++) {
                if (!isset($request->khusus_gambar[$i])) {
                    certificate_specific_property::create([
                        "nama" => $request->khusus_nama[$i],
                        "data" => $request->khusus_properti[$i],
                        "certificate_id" => $sertifikat->id
                    ]);
                } else {
                    $file = $request->file('khusus_gambar')[$i];
                    $nama_file =  $sertifikat->id . '-' . $i . '-' . 'Properti_Khusus' . '.' . $file->getClientOriginalExtension();
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
        }

        do {
            $r2 = rand() + rand();
            $id = Auth::id() . $r2;
        } while (!empty(certificate::find($id)));

        $data = event::create([
            "id" => $id,
            "name" => $request->nama_acara,
            "date" => DateTime::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d'),
            "capacity" => $request->jumlah,
            "user_owner" => Auth::id(),
            "receipt_id" => "1",
            "certificate_id" => $sertifikat->id
        ]);

        $data->id = $id;

        return redirect(route('agencyHome-page'))->with('message', 'Berhasil Menambahkan Acara');
    }

    public function HapusAcara(Request $request)
    {
        $data['acara'] = event::find($request->id);
        $data['sertifikat'] = $data['acara']->certificate()->first();
        $data['properti_khusus'] = certificate_specific_property::where('certificate_id', $data['sertifikat']->id)->get();
        File::delete("assets/" . $data['sertifikat']->logo_instansi);
        File::delete("assets/" . $data['sertifikat']->logo_sertifikat);
        foreach ($data['properti_khusus'] as $d) {
            File::delete("assets/" . $d->gambar);
        }
        $data['acara']->delete();
        $data['sertifikat']->delete();
        return response()->json(['message' => 'Acara berhasil dihapus']);
    }

    public function TampilAcara()
    {
        $data = array();
        $data["is_email_verify"] = Auth::user()->is_email_verified;
        $data["acara"] = User::whereId(Auth::id())->first()->event()->get();
        $data["jml_peserta"] = array();
        $data["jml_dibuat"] = array();

        foreach ($data["acara"] as $d) {
            array_push($data["jml_peserta"], participant_event_certificate::whereEvent_id($d->id)->count());
            array_push($data["jml_dibuat"], participant_event_certificate::whereEvent_id($d->id)->whereNotNull('certificate_id',)->count());
        }

        return view("frontend.agencyHome", compact("data"));
    }

    public function TampilHalamanEditAcara($id)
    {
        $data['acara'] = event::find($id);
        $data['acara']->date = DateTime::createFromFormat('Y-m-d H:i:s', $data['acara']->date)->format('d/m/Y');
        $data['sertifikat'] = $data['acara']->certificate()->first();
        $data['properti_khusus'] = certificate_specific_property::where('certificate_id', $data['sertifikat']->id)->get();

        return view('frontend.edit-acara', compact('data'));
    }

    public function EditAcara($id, Request $request)
    {
        if (isset($request->switch_properti_khusus) && isset($request->khusus_nama)) {
            $validatedData = $request->validate([
                'nama_acara' => ['required', 'max:255'],
                'tanggal' => ['required'],
                'jumlah' => ['integer'],
                'nama_instansi' => ['required'],
                'jenis_acara' => ['required'],
                'logo_instansi' => ['image', 'max:512'],
                'logo_acara' => ['image', 'max:512'],
                'karena' => ['required'],
                'khusus_nama' => ['required'],
                'khusus_properti' => ['required']
            ]);
            if (!empty($request->file('khusus_gambar'))) {
                foreach ($request->file('khusus_gambar') as $f) {
                    if (!in_array($f->getClientOriginalExtension(), array("jpeg", "jpg", "png", "bmp", "gif", "svg",  "webp"))) {
                        return back()->withErrors(['Properti Khusus Gambar Must Be An Image'])->withInput();
                    }
                }
            }
        } else {
            $validatedData = $request->validate([
                'nama_acara' => ['required', 'max:255'],
                'tanggal' => ['required'],
                'jumlah' => ['integer'],
                'nama_instansi' => ['required'],
                'jenis_acara' => ['required'],
                'logo_instansi' => ['image', 'max:512'],
                'logo_acara' => ['image', 'max:512'],
                'karena' => ['required']
            ]);
        }

        $acara = event::find($id);
        $acara->name = $request->nama_acara;
        $acara->date = DateTime::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');
        $acara->capacity = $request->jumlah;
        $acara->save();

        $sertif = $acara->certificate()->get()[0];
        $sertif->nama_instansi = $request->nama_instansi;
        $sertif->jenis_sertifikat = $request->jenis_acara;
        if ($request->logo_instansi != "") {
            $file = $request->file('logo_instansi');
            $nama_file =  $sertif->id . '_logo_instansi_' . '.' . $file->getClientOriginalExtension();
            $tujuan_upload = 'assets/images/Logo_Instansi/';
            $logo_instansi = 'images/Logo_Instansi/' . $nama_file;
            $file->move($tujuan_upload, $nama_file);
            $sertif->logo_instansi = $logo_instansi;
        }
        if ($request->logo_acara != "") {
            $file = $request->file('logo_acara');
            $nama_file =  $sertif->id . 'logo_acara' . '.' . $file->getClientOriginalExtension();
            $tujuan_upload = 'assets/images/Logo_Sertifikat/';
            $logo_sertif = 'images/Logo_Sertifikat/' . $nama_file;
            $file->move($tujuan_upload, $nama_file);
            $sertif->logo_sertifikat = $logo_sertif;
        }
        $sertif->alasan = $request->karena;
        $sertif->save();

        if (isset($request->khusus_nama)) {
            $khusus = certificate_specific_property::where('certificate_id', $sertif->id)->get();
            $khusus_id = certificate_specific_property::where('certificate_id', $sertif->id)->pluck('id');
            $arr_id = $request->khusus_id;
            if($arr_id == ""){
                $arr_id = array();
            }
            $i = 0;
            $diff = array_diff($khusus_id->toArray(), $arr_id);

            foreach ($khusus as $k) {
                if (in_array($k->id, $diff)) {
                    $k->delete();
                    unset($khusus[$i]);
                } else {
                    $k->nama = $request->khusus_nama[$i];
                    if ($request->khusus_gambar_temp[$i] != "gnosok_in") {
                        $k->gambar = "";
                        File::delete("assets/" . $k->gambar);
                    } else if (!empty($request->file('khusus_gambar')[$i])) {
                        $file = $request->file('khusus_gambar')[$i];
                        $nama_file =  $sertif->id . 'Properti_Khusus' . '.' . $file->getClientOriginalExtension();
                        $tujuan_upload = 'assets/images/Properti_Khusus/';
                        $khusus_gambar = 'images/Properti_Khusus/' . $nama_file;
                        $file->move($tujuan_upload, $nama_file);
                        $k->gambar = $khusus_gambar;
                    }
                    $k->data = $request->khusus_properti[$i];
                    $k->save();
                    $i++;
                }
            }
            for ($i = count($khusus); $i < count($request->khusus_nama); $i++) {
                if (!isset($request->khusus_gambar[$i])) {
                    certificate_specific_property::create([
                        "nama" => $request->khusus_nama[$i],
                        "data" => $request->khusus_properti[$i],
                        "certificate_id" => $sertif->id
                    ]);
                } else {
                    $file = $request->file('khusus_gambar')[$i];
                    $nama_file =  $sertif->id . '-' . $i . '-' . 'Properti_Khusus' . '.' . $file->getClientOriginalExtension();
                    $tujuan_upload = 'assets/images/Properti_Khusus/';
                    $khusus_gambar = 'images/Properti_Khusus/' . $nama_file;
                    $file->move($tujuan_upload, $nama_file);
                    certificate_specific_property::create([
                        "nama" => $request->khusus_nama[$i],
                        "data" => $request->khusus_properti[$i],
                        "gambar" => $khusus_gambar,
                        "certificate_id" => $sertif->id
                    ]);
                }
            }
        } else {
            $khusus = certificate_specific_property::where('certificate_id', $sertif->id)->get();
            foreach ($khusus as $k) {
                $k->delete();
            }
        }

        return redirect(route('agencyHome-page'))->with('message', 'Berhasil Merubah Acara');
    }
}
