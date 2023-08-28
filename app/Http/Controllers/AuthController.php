<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Rules\PasswordCheck;
use Illuminate\Http\Request;
use App\Models\Users;
use Session;

class AuthController extends Controller
{
    public function submit(AuthRequest $req){
        $req->validate([
            'password' => [
                new PasswordCheck($req->input('login'))]
        ]);
        $users = new Users();
        $user = $users->where('login', $req->input('login'))->get();
        Session::forget('email');
        Session::forget('code');
        Session::forget('login');
        Session::push('email', $user[0]->email);
        if ($user[0]->is_active == 1){
            Session::push('login', $req->input('login'));
            return redirect()->route('home');
        } else {
            $update_code = mt_rand(100000, 900000);
            $users->where('login', $req->input('login'))->update(['verify_code' => $update_code]);
            Session::push('code', $update_code);
            echo '<script type="text/javascript">alert("Аккаунт не подтвержден, введите код подтверждения отправленный вам на email.");</script>';
            return redirect()->route('send');
        }

    }

    public function signout(){
        Session::forget('email');
        Session::forget('code');
        Session::forget('login');

        return redirect()->route('home');
    }
}
