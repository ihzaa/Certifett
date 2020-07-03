<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Mail;
// use illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function VerificationEmail($name,$email,$type){
      $data = [
        'name' => $name,
        'type' => $type
      ];

      Mail::to($email)->send(new EmailVerification($data));
    }

    public function CertificateEmail($detail){
      $data = [
        'name' => $name,
        'type' => $type
      ];

      foreach ($detail['email'] as $recipient) {
        Mail::to($recipient)->send(new EmailVerification($data));
      }
    }
}
