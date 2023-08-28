<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Mail;

class MailController extends Controller
{
    public function send(){

        Mail::send(['text'=>'mail'], ['name', 'Droniverse'], function ($message){

            $message->to(Session::get('email')[0])->subject('Код для подтверждения регистрации');
            $message->from('paperatravel@gmail.com', 'Droniverse Team');

        });
        return redirect()->route('verify');
    }
}
