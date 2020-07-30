<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
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

        $event_name = DB::table('events')->where('id', $event_id)->select('name')->get();
        $event_date = DB::table('events')->where('id', $event_id)->select('date')->get();
        $instansi = DB::table('events')
            ->join('certificates', 'certificates.id', '=', 'events.certificate_id')
            ->select('certificates.nama_instansi')
            ->first();
        // var_dump($event_date[0]->date);
        $data = [
            'name' => $name,
            'type' => $type,
            'event_name' => $event_name[0]->name,
            'date' => \Carbon\Carbon::parse($event_date[0]->date)->formatLocalized("%d %B %Y"),
            'instansi' => $instansi->nama_instansi,
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
        set_time_limit(60);
        $data = participant_event_certificate::where("release_date", "=", Carbon::today())->where('is_send', 0)->where('is_absent', 1)->get();
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
