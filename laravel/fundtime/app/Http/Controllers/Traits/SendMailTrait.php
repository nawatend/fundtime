<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use Mail;

trait SendMailTrait
{
    public function sendMail($data)
    {
        if ($data["mail_type"] == 'new_fund') {
            Mail::send('emails.mail_template_fund', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject($data['mail_info']);
            });
        } elseif ($data["mail_type"] == 'new_user') {
            Mail::send('emails.mail_template_new_user', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject($data['mail_info']);
            });
        } else {
            return back();
        }
       
        //Mail::to('n.tendar@gmail.com')->send(new SendMail);
    }
}
