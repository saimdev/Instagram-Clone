<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index($email, $code)
    {
        $mailData = [
            'title' => 'Mail From Instagram Clone',
            'body' => 'Hi,
            Someone tried to sign up for an Instagram account with '.$email.'. If it was you, enter this confirmation code in the app: </br>'.$code
        ];
         
        Mail::to($email)->send(new DemoMail($mailData));
           
        dd("Email sent successfully");
    }
}
