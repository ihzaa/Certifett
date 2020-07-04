<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use App\Models\event;
use App\Models\participant_event_certificate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function TampilSertifSaya()
    {
        $data = array();
        $usr = Auth::user();
        $data['sertif'] = participant_event_certificate::whereEmail($usr->email)->whereNotNull('release_date')->get();
        $event = event::pluck('name', 'id');
        for ($i = 0; $i < count($data['sertif']); $i++) {
            $data['sertif'][$i]->name = $event[$data['sertif'][$i]->event_id];
        }
        return view('frontend.sertifikatSaya', compact("data"));
    }



    public function LihatSertif($id)
    {
        $data['peserta'] = participant_event_certificate::whereId($id)->where('is_send', 1)->where('valid_until', '>=', Carbon::today())->first();

        if ($data['peserta'] == "") {
            $data['peserta'] = participant_event_certificate::whereId($id)->where('is_send', 1)->where('valid_until', null)->first();
        }
        if ($data['peserta'] == "") {
            return redirect(route('landing-page'))->with('message', 'ID salah atau sertifikat sudah tidak valid!')->with('logo', 'warning')->with('title', 'Maaf');
        } else {
            $data['event'] = event::whereId($data['peserta']->event_id)->first();
            $data['sertif'] = certificate::whereId($data['peserta']->certificate_id)->first();
            $data['sertif_khusus'] = $data['sertif']->specific_properties()->get();
            // return $data;
            return view('frontend.lihat-sertif', compact("data"));
        }
    }
}
