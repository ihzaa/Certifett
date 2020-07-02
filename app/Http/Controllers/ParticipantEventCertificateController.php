<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use App\Models\event;
use App\Models\participant_event_certificate;
use App\User;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ParticipantEventCertificateController extends Controller
{
    public function TampilPerAcara($id)
    {
        $data = array();
        $data["acara"] = event::whereId($id)->where('user_owner', Auth::id())->first();
        $data["peserta"] = participant_event_certificate::whereEvent_id($data['acara']->id)->get();
        $data["jml_peserta"] = count($data["peserta"]);

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
        $data['jml_dibuat'] =  participant_event_certificate::where('event_id', $id)->count();
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
        //DISINI NANTI ADA METHOD KIRIM EMAIL KE SELURUH PESERTA

        return redirect(route('agencyHome-page'))->with('message', 'Peserta acara akan menerima email sertifikat.');
    }
}
