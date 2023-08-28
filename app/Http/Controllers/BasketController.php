<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Basket;
use App\Models\Discounts;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class BasketController extends Controller
{
    public function who_user(){
        $users = new Users();
        $discounts = new Discounts();
        $basket = new Basket();

        if (empty(Session::get('login'))){

            return redirect()->route('home')->with('alert', 'Необходимо авторизоваться.');

        } else {
            $status = $users->where('login', Session::get('login')[0])->get('role')[0]->role;
        }

        if ($status == 1 || $status == 2) {
            return redirect()->route('home')->with('alert', 'С рабочих аккаунтов нельзя просматривать корзину.');
        } else {
            $user = $users->where('login', Session::get('login')[0])->get();
            $id_user = $user[0]->id;
            $id_discount = $users->where('id', $id_user)->get('id_discount')[0]->id_discount;
            $discount = $discounts->where('id', $id_discount)->get('discount')[0]->discount;
            if ($status == 0){
                $basket_all = $basket->where('id_user', $id_user)->where('id_order', 0)
                    ->join('products', 'basket.id_product', '=', 'products.id')
                    ->select('basket.count', 'products.id', 'products.price', 'products.thumbnail', 'products.name')
                    ->get();
                $total = 0;
                foreach ($basket_all as $el){
                    $total += $el->count * $el->price;
                }
                $basket_count = $basket->where('id_user', $id_user)->where('id_order', 0)->count();
                return view('basket', ['basket' => $basket_all, 'total' => $total,
                    'discount' => $discount, 'count' => $basket_count]);
            }
        }
    }

    public function change_count(Request $request){
        $users = new Users();
        $products = new Products();
        $order = new Orders();
        $discounts = new Discounts();
        $basket = new Basket();
        $user = $users->where('login', Session::get('login')[0])->get();
        $id_user = $user[0]->id;
        $id_discount = $users->where('id', $id_user)->get('id_discount')[0]->id_discount;
        $discount = $discounts->where('id', $id_discount)->get('discount')[0]->discount;
        $discount_image = $discounts->where('id', $id_discount)->get('url_image')[0]->url_image;
        $role = $user[0]->role;
        preg_match('|[^/]+$|', $request->href, $id_product);
        $id_product = $id_product[0];
        $product_count = $products->where('id', $id_product)->get('count')[0]->count;
        if($request->type == 'minus' && $basket->where('id_user', $id_user)->where('id_order', 0)->where('id_product', $id_product)->get('count')[0]->count != 1){
            $products->where('id', $id_product)->update(['count' => $product_count + 1]);
            $basket->where('id_user', $id_user)->where('id_order', 0)->where('id_product', $id_product)->update(['count' => $request->count]);
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
            return view('basket', ['basket' => $basket_all, 'total' => $total,
                'discount' => $discount, 'count' => $basket_count]);
        } elseif ($request->type == 'plus' && $product_count != 0){
            $products->where('id', $id_product)->update(['count' => $product_count - 1]);
            $basket->where('id_user', $id_user)->where('id_order', 0)->where('id_product', $id_product)->update(['count' => $request->count]);
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
            return view('basket', ['basket' => $basket_all, 'total' => $total,
                'discount' => $discount, 'count' => $basket_count,]);
        } else {
            if ($basket->where('id_user', $id_user)->where('id_order', 0)->where('id_product', $id_product)->get('count')[0]->count == 1){
                return redirect()->route('basket');
            } else {
                return redirect()->route('basket')->with('alert', 'К сожалению, товар закончился на складе.');
            }
        }

    }

    public function remove_prod(Request $request){
        $users = new Users();
        $basket = new Basket();
        $products = new Products();
        $user = $users->where('login', Session::get('login')[0])->get();
        $id_user = $user[0]->id;
        preg_match('|[^/]+$|', $request->href, $id_product);
        $id_product = $id_product[0];
        $cancel_count = $basket->where('id_user', $id_user)->where('id_order', 0)->where('id_product', $id_product)->get('count')[0]->count;
        $curr_count = $products->where('id', $id_product)->get('count')[0]->count;
        $products->where('id', $id_product)->update(['count' => $curr_count + $cancel_count]);
        $basket->where('id_user', $id_user)->where('id_order', 0)->where('id_product', $id_product)->delete();

        return redirect()->route('basket');
    }

    public function add_order(OrderRequest $request){
        $order = new Orders();
        $basket = new Basket();
        $users = new Users();
        $id_user = $users->where('login', Session::get('login')[0])->get('id')[0]->id;
        if ($request->sum_price != 0){
            $order->id_user = $id_user;
            $order->lastname = $request->lastname;
            $order->firstname = $request->firstname;
            $order->surname = $request->surname;
            $order->phone = $request->phone;
            $order->delivery = $request->delivery;
            if (empty($request->address)){
                $order->address = null;
            } else {
                $order->address = $request->address;
            }
            if (empty($request->date_delivery)){
                $order->date_delivery = null;
            } else {
                $order->date_delivery = $request->date_delivery;
            }
            $order->payment = $request->payment;
            $order->sum_price = $request->sum_price;
            $order->date_order = Carbon::now()->toDateString();

            $order->save();

            $id_order = $order->where('id_user', $id_user)->get('id_order')->last()->id_order;

            $basket->where('id_user', $id_user)->where('id_order', 0)->update(['id_order' => $id_order]);

            return redirect()->route('basket');
        } else {
            return redirect()->route('basket')->with('alert', 'Нет товаров в корзине.');
        }

    }
}
