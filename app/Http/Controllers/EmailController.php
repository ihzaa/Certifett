<?php

namespace App\Http\Controllers;

use App\EmailVerification;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendMail(array $data){
      $data = [
        'name' => $data['name']
      ];

      Mail::to('yusufrnp@gmail.com')-send(new EmailVerification($data));
    }
}
