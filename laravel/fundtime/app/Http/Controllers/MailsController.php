<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\SendMail;
use Mail;

class MailsController extends Controller
{
    //




    public function sendMail()
    {
        $data = array('name' => 'Frederick Roegiers', 'body' => "Mailgun is successfully implemented. <br><br>World Peace");

        Mail::send('emails.mail_template', $data, function ($message) {
            $message->to('frederick.roegiers@arteveldehs.be', 'Frederick Roegiers')->subject('Mailgun is successfully implemented');
        });

        //Mail::to('n.tendar@gmail.com')->send(new SendMail);
        return view("emails.mail_confirmed");
    }
}
