<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Session;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function chat(){
        //TODO: проверка на авторизацию

        if (Session::get('login')){
            $users = new Users();
            $user = $users->where('login', Session::get('login')[0])->get();
            $role = $user[0]->role;
            return view('support', ['role' => $role, 'user' => $user[0]]);
        } else {
            return redirect()->route('home')->with('alert', 'Необходимо авторизоваться.');
        }
    }
}
