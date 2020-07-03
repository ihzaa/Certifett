<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\User;
use Illuminate\Http\Request;
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
            return view('frontend.landing')->with('message', 'Verifikasi Email Berhasil!');
        } else {
            view('frontend.landing')->with('message', 'Email Sudah Pernah Diverifikasi!');
        }
    }
}
