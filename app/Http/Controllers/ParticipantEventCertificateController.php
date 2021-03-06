<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use App\Models\event;
use App\Models\participant_event_certificate;
use App\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class ParticipantEventCertificateController extends Controller
{
    public function TampilPerAcara($id)
    {
        $data = array();
        $data["id"] = $id;
        $data["acara"] = event::whereId($id)->where('user_owner', Auth::id())->first();
        if ($data["acara"] == "") {
            return redirect(route('agencyHome-page'));
        }
        $data["sertif"] = $data["acara"]->certificate()->first();
        $data["khusus"] = $data["sertif"]->specific_properties()->get();
        $data["peserta"] = participant_event_certificate::whereEvent_id($data['acara']->id)->get();
        $data["jml_peserta"] = count($data["peserta"]);
        $data['absent_start'] = $data["acara"]->absent_start != "" ? DateTime::createFromFormat('Y-m-d H:i:s', $data["acara"]->absent_start)->format('d/m/Y H:i') : "";
        $data['absent_end'] =  $data["acara"]->absent_end != "" ? DateTime::createFromFormat('Y-m-d H:i:s', $data["acara"]->absent_end)->format('d/m/Y H:i') : "";
        // return $data;

        return view("frontend.kelolaPeserta", compact("data"));
    }

    public function BuatSertifikatPeserta(Request $request, $id)
    {
        $id_ser = event::find($id)->certificate_id;
        $arr_keys = array_keys($request->chk);
        participant_event_certificate::whereIn('id', $arr_keys)->update([
            "certificate_id" => $id_ser
        ]);
        $data['id_acara'] = $id;
        $data['id_sertif'] = $id_ser;
        $data['jml_dibuat'] =  participant_event_certificate::where('certificate_id', $id_ser)->count();
        return view('frontend.buat-sertifikat', compact("data"));
    }

    public function SertifPesertaFinal($id_acara, $id_sertif, Request $request)
    {
        if ($request->sampai == "") {
            $arr = [
                "release_date" => DateTime::createFromFormat('d/m/Y', $request->tgl)->format('Y-m-d'),
                "congrat_word" => $request->ucapan
            ];
        } else {
            $tgl = DateTime::createFromFormat('d/m/Y', $request->tgl);
            if ($request->lama == 1) {
                $tgl->add(new DateInterval("P" . $request->sampai . "Y"));
            } else {
                $tgl->add(new DateInterval("P" . $request->sampai . "M"));
            }
            $arr =  [
                "release_date" => DateTime::createFromFormat('d/m/Y', $request->tgl)->format('Y-m-d'),
                "valid_until" => $tgl->format('Y-m-d'),
                "congrat_word" => $request->ucapan
            ];
        }
        participant_event_certificate::where('certificate_id', $id_sertif)->update($arr);

        // $acara = event::find($id_acara);
        // $sertif = certificate::find($id_sertif);
        // $data_peserta = participant_event_certificate::where('certificate_id', $id_sertif)->get(['id', 'name', 'email']);
        //DISINI NANTI ADA METHOD KIRIM EMAIL KE SELURUH PESERTA, itu diatas data yg dikirim

        return redirect(route('agencyHome-page'))->with('message', 'Peserta acara akan menerima email sertifikat.');
    }

    public function TambahPesertaCSV($id, Request $request)
    {
        set_time_limit(false);
        $data = json_decode($request->data);
        $i = 0;
        $len = count($data[0]);
        $cnt = participant_event_certificate::where('event_id', $id)->count();
        $cnt++;
        foreach ($data as $d) {
            if ($i == 0) {
                $i++;
                continue;
            }
            if ($len != count($d)) {
                continue;
            }
            $id_p = "";
            if (strlen($id) > 3) {
                $id_p .= $id;
            } else {
                $tmp = $id;
                while (strlen($tmp) < 3) {
                    $tmp = "0" . $tmp;
                }
                $id_p .= $tmp;
            }
            if (strlen($cnt) > 4) {
                $id_p .= $cnt++;
            } else {
                $tmp = $cnt++;
                while (strlen($tmp) < 4) {
                    $tmp = "0" . $tmp;
                }
                $id_p .= $tmp;
            }
            $type = 'register';
            try {
                $email = strtolower($d[$request->col_email]);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // app('App\Http\Controllers\EmailController')->RegisterSuccess($d[$request->col_nama], $email, $type, $id, $id_p);
                    participant_event_certificate::create([
                        "id" => $id_p,
                        "name" => $d[$request->col_nama],
                        "email" => $email,
                        "event_id" => $id
                    ]);
                } else {
                    continue;
                }
            } catch (Exception $e) {
                continue;
            }
        }
        Session::flash('message', 'Berhasil Menambahkan Peserta Dengan File Csv');
        return response()->json(["message" => "ok"]);
    }

    public function HapusPeserta(Request $request)
    {
        participant_event_certificate::whereId($request->id)->delete();
        return response()->json(["message" => "ok"]);
    }

    public function HapusPesertaBanyak(Request $request)
    {
        $data = json_decode($request->id);
        participant_event_certificate::whereIn('id', $data)->delete();
        return response()->json(["message" => "ok"]);
    }

    public function TambahPesertaLink($id, Request $request)
    {
        try {
            $email = strtolower($request->email);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $id_p = "";
                if (strlen($id) > 3) {
                    $id_p .= $id;
                } else {
                    $tmp = $id;
                    while (strlen($tmp) < 3) {
                        $tmp = "0" . $tmp;
                    }
                    $id_p .= $tmp;
                }
                $cnt = participant_event_certificate::where('event_id', $id)->count();
                $cnt++;
                if (strlen($cnt) > 4) {
                    $id_p .= $cnt;
                } else {
                    $tmp = $cnt;
                    while (strlen($tmp) < 4) {
                        $tmp = "0" . $tmp;
                    }
                    $id_p .= $tmp;
                }
                participant_event_certificate::create([
                    "id" => $id_p,
                    "name" => $request->nama,
                    "email" => $email,
                    "event_id" => $id
                ]);
                return back()->with('message', 'Pendaftaran Anda Berhasil')->with('icon', 'success');
            } else {
                return back()->with('message', 'Email tidak valid')->with('icon', 'error');
            }
        } catch (Exception $e) {
            return;
        }
    }

    public function TampilHalamanDaftar($id)
    {
        $tmp = event::whereId($id)->where('date', '>', Carbon::today())->first();
        if ($tmp != null) {
            $data['id'] = $tmp->id;
            $data['nama'] = $tmp->name;
            return view('frontend.FormDaftarPeserta', compact("data"));
        } else {
            return redirect(route('landing-page'))->with('message', 'Link salah atau acara sudah selesai!')->with('logo', 'warning')->with('title', 'Maaf');
        }
    }

    public function EditPeserta(Request $request)
    {
        participant_event_certificate::whereId($request->id)->update([
            "name" => $request->nama,
            "email" => $request->email
        ]);
        return back()->with('message', 'Data Peserta Berhasil Diubah.');
    }

    public function AbsenPeserta(Request $request)
    {
        $id = Crypt::decrypt($request->daftar);
        $part = participant_event_certificate::find($id);
        if ($part == "") {
            return redirect(route('landing-page'))->with('message', 'Link salah!')->with('logo', 'error')->with('title', 'Maaf!');
        }
        $event = event::find($part->event_id);
        $start = Carbon::parse($event->absent_start);
        $end = Carbon::parse($event->absent_end);
        if (Carbon::now()->between($start, $end)) {
            if ($part->is_absent == 0) {
                $part->is_absent = 1;
                $part->save();
            } else {
                return redirect(route('landing-page'))->with('message', 'Absensi hanya dapat dilakukan 1 kali')->with('logo', 'error')->with('title', 'Maaf!');
            }
            return redirect(route('landing-page'))->with('message', 'Anda berhasil melakukan absensi pada event ' . $event->name)->with('logo', 'success')->with('title', 'Selamat!');
        } else {
            return redirect(route('landing-page'))->with('message', 'Sesi absensi belum dibuka atau sudah terlewat')->with('logo', 'error')->with('title', 'Maaf!');
        }
    }
}
