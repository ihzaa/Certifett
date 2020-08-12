<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\certificate;
use App\Models\event;
use App\Models\participant_event_certificate;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

// use illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function VerificationEmail($name, $email, $type, $api_key)
    {
        $data = [
            'name' => $name,
            'type' => $type,
            'api_key' => $api_key
        ];

        Mail::to($email)->send(new EmailVerification($data));
    }

    public function RegisterSuccess($name, $email, $type, $event_id, $id_p)
    {
        $ev = event::find($event_id);
        $event_name = certificate::find($ev->certificate_id);
        $data = [
            'name' => $name,
            'type' => $type,
            'event_name' => $ev->name,
            'date' => \Carbon\Carbon::parse($ev->date)->formatLocalized("%d %B %Y"),
            'instansi' => $event_name->nama_instansi,
            'link' => route('peserta_absen', ['daftar' => Crypt::encrypt($id_p)])
        ];
        try {
            Mail::to($email)->send(new EmailVerification($data));
        } catch (Exception $e) {
        }
    }

    public function CertificateEmail($detail)
    {
        $data = [
            'name' => $name,
            'type' => $type
        ];

        foreach ($detail['email'] as $recipient) {
            Mail::to($recipient)->send(new EmailVerification($data));
        }
    }

    public function VerifyAccount($api_key)
    {
        if (User::where('api_key', $api_key)->where('is_email_verified', 0)->count() == 1) {
            User::where('api_key', $api_key)->update([
                "is_email_verified" => 1
            ]);
            return redirect(route('landing-page'))->with('message', 'Verifikasi Email Berhasil!')->with('logo', 'success')->with('title', 'Berhasil');
        } else {
            return redirect(route('landing-page'))->with('message', 'Email Sudah Pernah Diverifikasi!')->with('logo', 'warning')->with('title', 'Maaf');
        }
    }

    public function kirimUlang()
    {
        $data = [
            'name' => Auth::user()->name,
            'type' => 'verifikasi',
            'api_key' => Auth::user()->api_key
        ];

        Mail::to(Auth::user()->email)->send(new EmailVerification($data));

        return redirect(route('agencyHome-page'))->with('message', 'Email verifikasi telah dikirim ulang!')->with('logo', 'success')->with('title', 'Berhasil');
    }

    public function testing()
    {
        set_time_limit(false);
        $data = participant_event_certificate::where("is_absent_send", 0)->take(145)->get();
        $type = 'register';
        $arr_id = array();
        foreach ($data as $d) {
            $id = $data[0]->event_id;
            try {
                app('App\Http\Controllers\EmailController')->RegisterSuccess($d->name, $d->email, $type, $id, $d->id);
                array_push($arr_id, $d->id);
            } catch (Exception $e) {
                continue;
            }
        }
        participant_event_certificate::whereIn('id', $arr_id)->update([
            "is_absent_send" => 1
        ]);
        if (count($data) < 145) {
            $limit = 145 - count($data);
            $data = participant_event_certificate::where("release_date", "<=", Carbon::today())->where('is_send', 0)->where('is_absent', 1)->take($limit)->get();
            $event = event::pluck('name', 'id');
            $arr_id = array();
            foreach ($data as $d) {
                $data = [
                    'name' => $d->name,
                    'type' => 'sertif',
                    'idpeserta' => $d->id,
                    'event' => $event[$d->event_id],
                    'congrat_word' => $d->congrat_word
                ];
                Mail::to($d->email)->send(new EmailVerification($data));
                array_push($arr_id, $d->id);
            }
            participant_event_certificate::whereIn('id', $arr_id)->update([
                "is_send" => 1
            ]);
        }
    }
}
