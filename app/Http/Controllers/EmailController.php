<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
// use illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function VerificationEmail($name, $email, $type)
    {
        $data = [
            'name' => $name,
            'type' => $type
        ];

        Mail::to($email)->send(new EmailVerification($data));
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
}
