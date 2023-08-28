<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Session;

class RegisterController extends Controller
{
    public function submit(UsersRequest $req){

        $user = new Users();
        $user->login = $req->input('login');
        $user->email = $req->input('email');
        $user->verify_code = mt_rand(100000, 900000);
        $user->password = Hash::make($req->input('password'));

        Session::forget('code');
        Session::push('code', $user->verify_code);
        Session::forget('login');
        Session::push('login', $user->login);
        Session::forget('email');
        Session::push('email', $user->email);
        $user->save();

        return redirect()->route('send');
    }

}

