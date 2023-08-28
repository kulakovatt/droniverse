<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTrainingRequest;
use App\Http\Requests\RegistTrainingRequest;
use App\Models\RegistTraining;
use App\Models\Training;
use App\Models\Users;
use Illuminate\Http\Request;
use Session;
use Mail;

class TrainingController extends Controller
{
    public function get_training(){
        $training = new Training();
        return view('home', ['trainings'=>$training->all()]);
    }

    public function get_data(Request $request){
        $trainings = new Training();
        $training_data = $trainings->where('name', $request->name)->get();
        return view('editTrainingPanel', ['training_data'=>$training_data]);
    }

    public function add(AddTrainingRequest $req){
        $training = new Training();
        $training->name = $req->name;
        $training->date = $req->date;
        $training->img = 'images/'.$req->thumbnail;
        $training->description = $req->description;
        $training->address = $req->address;
        $training->number_of_seats = $req->count;
        $training->time = $req->time;

        $training->save();

        return 'Мастер-класс добавлен успешно.';
    }

    public function edit(Request $req){
        $training = new Training();
        if ($req->thumbnail != ''){
            $training->where('name', $req->name)->update(['name' => $req->name, 'img' => 'images/' . $req->thumbnail,
                'description' => $req->description, 'number_of_seats' => $req->count,
                'address' => $req->address, 'date' => $req->date, 'time' => $req->time]);
        } else {
            $training->where('name', $req->name)->update(['name' => $req->name, 'description' => $req->description,
                'number_of_seats' => $req->count, 'address' => $req->address, 'date' => $req->date, 'time' => $req->time]);
        }

        return 'Мастер-класс изменен успешно!';
    }

    public function delete(Request $req){
        $training = new Training();
        $training->where('name', $req->name)->delete();

        return 'Мастер-класс удален.';
    }

    public function regist_training(RegistTrainingRequest $request){
        $trainings = new Training();
        $users = new Users();
        if (empty(Session::get('login'))){
            return redirect()->route('home')->with('alert', 'Необходимо авторизоваться.');
        } else{
            $status = $users->where('login', Session::get('login')[0])->get('role')[0]->role;
        } if ($status == 1 || $status == 2){
            return redirect()->route('home')->with('alert', 'С рабочих аккаунтов нельзя записаться на мастер-класс.');
        } else if ($trainings->where('id', $request->id_trn)->get('number_of_seats')[0]->number_of_seats > 0) {
            $reg_training = new RegistTraining();
            if ($reg_training->where('id_user', $users->where('login', Session::get('login')[0])->get('id')[0]->id)->where('id_training', $request->id_trn)->where('firstname', $request->firstname)->where('lastname', $request->lastname)->count() == 0) {
                $reg_training->id_user = $users->where('login', Session::get('login')[0])->get('id')[0]->id;
                $reg_training->firstname = $request->firstname;
                $reg_training->lastname = $request->lastname;
                $reg_training->id_training = $request->id_trn;
                $info_training = $trainings->where('id', $request->id_trn)->get();

                $reg_training->save();

                $trainings->where('id', $request->id_trn)->decrement('number_of_seats', 1);

                Mail::send('mailTraining', ['name' => $info_training[0]->name, 'date' => date("d.m.Y", strtotime($info_training[0]->date)), 'time' => date("H:m", strtotime($info_training[0]->time)), 'address' => $info_training[0]->address,'firstname' => $request->firstname, 'lastname' => $request->lastname], function ($message){
                    $message->to(Session::get('email')[0])->subject('Запись на мастер-класс');
                    $message->from('paperatravel@gmail.com', 'Droniverse Team');
                });

                return redirect()->route('home')->with('alert', 'Вы записались на мастер-класс!');
            } else {
                return redirect()->route('home')->with('alert', 'Вы уже записаны на данный мастер-класс.');
            }

        } else {
            return redirect()->route('home')->with('alert', 'К сожалению, места закончились.');
        }
    }
}
