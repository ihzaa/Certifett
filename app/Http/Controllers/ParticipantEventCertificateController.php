<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Models\participant_event_certificate;
use App\User;
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
        $data["jml_dibuat"] = participant_event_certificate::whereEvent_id($data["acara"]->id)->whereNotNull('certificate_id',)->count();

        // return $data;
        return view("frontend.kelolaPeserta", compact("data"));
    }
}
