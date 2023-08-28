<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VerifyRequest;
use App\Models\Users;
use Session;
use Mail;

class VerifyController extends Controller
{
    public function input_code(VerifyRequest $req){
        $input = $req->input('code');
        $user = new Users();
        if($input == Session::get('code')[0]){
            $user->where('login', Session::get('login')[0])->update(['is_active' => true]);
            return redirect()->route('home');
        }
    }

    public function repeat_send() {
        $repeat_code = mt_rand(100000, 900000);
        Session::forget('code');
        Session::push('code', $repeat_code);
        $user = new Users();
        $user->where('login', Session::get('login')[0])->update(['verify_code' => $repeat_code]);
        return redirect()->route('send');
    }
}
