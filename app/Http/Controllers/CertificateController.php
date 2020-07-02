<?php

namespace App\Http\Controllers;

use App\Models\participant_event_certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function TampilSertifSaya()
    {
        $data = array();
        $usr = Auth::user();
        $data['sertif'] = participant_event_certificate::whereEmail($usr->email)->whereNotNull('release_date')->get();
        // return $data;
        return view('frontend.sertifikatSaya', compact("data"));
    }
}
