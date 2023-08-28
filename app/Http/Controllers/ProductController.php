<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEquipmentRequest;
use App\Http\Requests\AddImagesRequest;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Images;
use App\Models\Basket;
use App\Models\Equipment;
use Session;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Products::find($id);
        $imagesSlide = Images::where([
            ['id_product', '=', $id],
            ['type', '=', 'slider'],
        ])->get();

        $equipment = Equipment::where('id_product', $id)->get();

        $characteristics = $product->characteristics;
        $arr = explode(" | ", $characteristics);
        $name = [];
        $value = [];
        $arrParts = [];
        $dataAll = [];
        foreach ($arr as $item) {
            $nameValue = explode(": ", $item);
            if (isset($nameValue[1])){
                array_push($name, $nameValue[0]);
                array_push($value, $nameValue[1]);
            }
            $data = Products::whereRaw('LOCATE(?, characteristics)', [$item])->get();
            $count = Products::whereRaw('LOCATE(?, characteristics)', [$item])->count();
            if ($count > 0) {
                foreach ($data as $row) {
                    if (in_array($row->characteristics, $arrParts)) {
                        continue;
                    } else {
                        array_push($arrParts, $row->characteristics);
                        if ($id != $row->id){
                            array_push($dataAll, $row);
                        }
                    }
                }
            }
        }

        return view('product', ['product' => $product, 'imagesSlide' => $imagesSlide, 'character' => $arr, 'names' => $name, 'values' => $value, 'equipment' => $equipment, 'similar' => array_slice($dataAll, 0, 3)]);
    }

    public function add_basket(Request $request){
        $users = new Users();

        if (empty(Session::get('login'))){
            return response()->json(['error' => 'Необходимо авторизоваться.'], 400);
        } else {
            $status = $users->where('login', Session::get('login')[0])->get('role')[0]->role;
        }

        if ($status == 1 || $status == 2) {
            return response()->json(['error' => 'С рабочих аккаунтов нельзя добавлять товары.'], 400);
        } else if ($status == 0){
            $products = new Products();
            $id_user = $users->where('login', Session::get('login')[0])->get('id')[0]->id;
            $id_prod = $products->where('name', $request->name_product)->get('id')[0]->id;
            $stock_count = $products->where('id', $id_prod)->get('count')[0]->count;
            $basket = new Basket();
            //если в basket еще нет
            if($basket->where('id_user', $id_user)->where('id_order', 0)->where('id_product', $id_prod)->count() == 0 && $stock_count > 0){
                $basket->count = 1;
                $basket->id_user = $id_user;
                $basket->id_product = $id_prod;
                $basket->save();
                $products->where('id', $id_prod)->update(['count' => $stock_count - 1]);
            } else if ($basket->where('id_user', $id_user)->where('id_order', 0)->where('id_product', $id_prod)->count() > 0 && $stock_count > 0) { //если есть, то получить количество товара уже в basket и к нему добавлять 1, пока не дойдет до доступного кол-ва
                $curr_count = $basket->where('id_user', $id_user)->where('id_order', 0)->where('id_product', $id_prod)->get('count')[0]->count;
                if ($curr_count < $products->where('id', $id_prod)->get('count')[0]->count){
                    $basket->where('id_user', $id_user)->where('id_order', 0)->where('id_product', $id_prod)->update(['count' => $curr_count + 1]);
                    $products->where('id', $id_prod)->update(['count' => $stock_count - 1]);
                } else {
                    return response()->json(['error' => 'Данный товар закончился на складе.'], 400);
                }

            }
            return response()->json(['success' => 'Товар успешно добавлен в корзину.']);
        } else {

        }
    }

    public function add_equipment(AddEquipmentRequest $req){
        $equipment = new Equipment();
        $equipment->id_product = $req->id;
        $equipment->name = $req->name;
        $equipment->url = 'images/'.$req->thumbnail;
        $equipment->count = $req->count;

        $equipment->save();

        return 'Комплектация добавлена успешно.';
    }

    public function add_images(AddImagesRequest $req){
        $image = new Images();
        $image->id_product = $req->id;
        $image->type = $req->type;
        $image->url = 'images/'.$req->thumbnail;

        $image->save();
        return 'Изображение добавлено успешно.';
    }
}
