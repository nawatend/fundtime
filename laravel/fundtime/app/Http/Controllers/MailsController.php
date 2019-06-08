<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\SendMail;
use Mail;
use App\Http\Controllers\Traits\SendMailTrait;

class MailsController extends Controller
{
    //
    use SendMailTrait;



    public function send()
    {
        $mailData = [
            'mail_type' => 'new_user',
            'mail_info' => 'Registration Success!',
            'name' => 'User name',
            'email' => 'user@gmail.com',
            'body' => "Registration Success!",
        ];

        $this->sendMail($mailData);
        //return back();
        return back();
    }
}
//frederick.roegiers@arteveldehs.be
