<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Products;
use App\Models\RegistTraining;
use App\Models\Training;
use App\Models\Users;
use App\Models\Basket;
use App\Models\Orders;
use App\Models\Discounts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class AccountController extends Controller
{
    public function who_user(){
        $users = new Users();
        $order = new Orders();
        $reg_trainings = new RegistTraining();
        $discounts = new Discounts();
        $products = Products::all();
        $trainings = Training::all();
        $basket = new Basket();

        if (empty(Session::get('login'))){

            return redirect()->route('home')->with('alert', 'Необходимо авторизоваться.');

        } else {
            $user = $users->where('login', Session::get('login')[0])->get();
            $id_user = $user[0]->id;
            $id_discount = $users->where('id', $id_user)->get('id_discount')[0]->id_discount;
            $discount = $discounts->where('id', $id_discount)->get('discount')[0]->discount;
            $discount_image = $discounts->where('id', $id_discount)->get('url_image')[0]->url_image;
            $role = $user[0]->role;
            if ($role == 0){
                $basket_all = $basket->where('id_user', $id_user)->where('id_order', 0)
                    ->join('products', 'basket.id_product', '=', 'products.id')
                    ->select('basket.count', 'products.id', 'products.price', 'products.thumbnail', 'products.name')
                    ->get();
                $total = 0;
                foreach ($basket_all as $el){
                    $total += $el->count * $el->price;
                }
                $basket_count = $basket->where('id_user', $id_user)->where('id_order', 0)->count();
                $order_all = $order->where('id_user', $id_user)->get();
                return view('account', ['role' => $role, 'basket' => $basket_all, 'total' => $total,
                                'discount' => $discount, 'drone_image' => $discount_image, 'count' => $basket_count,
                                'orders' => $order_all]);
            } elseif ($role == 1){
                return view('account', ['role' => $role, 'products' => $products, 'trainings' => $trainings,
                    'now_date' => Carbon::now()->format('Y-m-d')]);
            } elseif ($role == 2){
                $reg_trainings->distinct()->get('id_training');
                return view('account', ['role' => $role, 'orders' => $order->all(), 'trainings' => $trainings, 'reg_trainings' => $reg_trainings->all()]);
            }
        }
    }

    public function get_data(Request $request){
        $products = new Products();
        $products_data = $products->where('name', $request->name)->get();
        return view('editAdminPanel', ['products_data'=>$products_data]);
    }

    public function add(AddProductRequest $req){
        $product = new Products();
        $product->name = $req->name;
        $product->brand = $req->brand;
        $product->model_prod = $req->model;
        $product->thumbnail = 'images/'.$req->thumbnail;
        $product->description = $req->description;
        $product->price = $req->price;
        $product->count = $req->count;
        $product->characteristics = $req->characteristics;
        $product->equipment = $req->equipment;

        $product->save();

        return 'Товар добавлен успешно.';
    }

    public function edit(Request $req){
        $product = new Products();
        if ($req->thumbnail != ''){
            $product->where('name', $req->name)->update(['name' => $req->name, 'brand' => $req->brand,
                'model_prod' => $req->model_prod, 'thumbnail' => 'images/' . $req->thumbnail,
                'description' => $req->description, 'price' => $req->price, 'count' => $req->count,
                'characteristics' => $req->characteristics, 'equipment' => $req->equipment]);
        } else {
            $product->where('name', $req->name)->update(['name' => $req->name, 'brand' => $req->brand,
                'model_prod' => $req->model_prod, 'description' => $req->description, 'price' => $req->price,
                'count' => $req->count, 'characteristics' => $req->characteristics, 'equipment' => $req->equipment]);
        }

        return 'Товар изменен успешно!';
    }

    public function delete(Request $req){
        $product = new Products();
        $product->where('name', $req->name)->delete();

        return 'Товар удален.';
    }

    public function confirm_order(Request $request){
        $orders = new Orders();

        $orders->where('id_order', $request->id_order)->update(['status' => 1]);
        return redirect()->route('office_view')->with('alert', 'Заказ подтвержден.');
    }

    public function issued_order(Request $request){
        $users = new Users();
        $orders = new Orders();
        $basket = new Basket();
        $products_all = new Products();
        $discounts = new Discounts();
        $orders->where('id_order', $request->id_order)->update(['status' => 2]);
        $user_id = $orders->where('id_order', $request->id_order)->get('id_user')[0]->id_user;
        $id_discount = $users->where('id', $user_id)->get('id_discount')[0]->id_discount;
        $user_email = $users->where('id', $user_id)->get('email')[0]->email;
        $user_id_discount = $users->where('id', $user_id)->get('id_discount')[0]->id_discount;
        $user_discount = $discounts->where('id', $user_id_discount)->get('discount')[0]->discount;

        if ($id_discount == '1'){
            $new_disc = 2;
        } elseif ($id_discount == '2'){
            $new_disc = 3;
        } elseif ($id_discount == '3'){
            $new_disc = 4;
        } elseif ($id_discount == '4'){
            $new_disc = 5;
        } elseif ($id_discount == '5'){
            $new_disc = 6;
        }
        $users->where('id', $user_id)->update(['id_discount' => $new_disc]);

        $sum_price = $orders->where('id_order', $request->id_order)->get('sum_price')[0]->sum_price;
        $lastname = $orders->where('id_order', $request->id_order)->get('lastname')[0]->lastname;
        $firstname = $orders->where('id_order', $request->id_order)->get('firstname')[0]->firstname;
        $surname = $orders->where('id_order', $request->id_order)->get('surname')[0]->surname;
        $date = Carbon::now()->format('d.m.Y');
        $fio = $lastname. ' ' . mb_substr($firstname, 0, 1).'.' . mb_substr($surname, 0, 1).'.';
        $products = $basket->where('id_order', $request->id_order)->get(['id_product', 'count']);
        $arr_products = [];

        $letters = strtoupper('abcdefghijklmnopqrstuvwxyz');
        $numbers = '0123456789';
        foreach ($products as $item){
            $random_string = '';
            for ($i = 0; $i < 2; $i++) {
                $random_string .= $letters[rand(0, strlen($letters) - 1)];
            }

            for ($i = 2; $i < 8; $i++) {
                $random_string .= $numbers[rand(0, strlen($numbers) - 1)];
            }
            $name = $products_all->where('id', $item->id_product)->get('name')[0]->name;
            $price = $products_all->where('id', $item->id_product)->get('price')[0]->price;
            $serial = $random_string;
            $arr_products[] = array('name' => $name, 'price' => $price, 'count' => $item->count, 'serial' => $serial);
        }

        return redirect()->route('order-send', ['id_order' => $request->id_order, 'fio' => $fio, 'date' => $date, 'email' => $user_email,
            'discount' => $user_discount, 'sum_price' => $sum_price, 'products' => $arr_products]);
    }

    public function cancel_order(Request $request){
        $orders = new Orders();
        $basket = new Basket();
        $products = new Products();
        $orders->where('id_order', $request->id_order)->delete();
        $count_prod = $basket->where('id_order', $request->id_order)->get(['id_product','count']);
        foreach ($count_prod as $prod){
            $curr_count = $products->where('id', $prod->id_product)->get('count')[0]->count;
            $products->where('id', $prod->id_product)->update(['count' => $curr_count + $prod->count]);
        }
        $basket->where('id_order', $request->id_order)->delete();
        return redirect()->route('office_view')->with('alert', 'Заказ отменен.');
    }

}
