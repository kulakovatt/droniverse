<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function all(){
        $products = new Products();
//        $catalog = $products->paginate(6);
        $catalog = $products->all();
        $brands = $products->distinct()->get('brand');
        $minPrice = $products->min('price');
        $maxPrice = $products->max('price');
        $uniqueResolutions = $products
            ->selectRaw("TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Видеоразрешение:', -1), '|', 1)) as resolution")
            ->where('characteristics', 'LIKE', '%Видеоразрешение:%')
            ->distinct()
            ->get();
        $uniqueProtection = $products
            ->selectRaw("TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Влагозащита:', -1), '|', 1)) as protection")
            ->where('characteristics', 'LIKE', '%Влагозащита:%')
            ->distinct()
            ->get();
        $uniqueFlight = $products
            ->selectRaw("TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Дальность полёта:', -1), '|', 1)) as flight")
            ->where('characteristics', 'LIKE', '%Дальность полёта:%')
            ->distinct()
            ->get();
        $uniqueAperture = $products
            ->selectRaw("TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Диафрагма:', -1), '|', 1)) as aperture")
            ->where('characteristics', 'LIKE', '%Диафрагма:%')
            ->distinct()
            ->get();
        $uniqueMatrix = $products
            ->selectRaw("TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Матрица:', -1), '|', 1)) as matrix")
            ->where('characteristics', 'LIKE', '%Матрица:%')
            ->distinct()
            ->get();
        $uniqueCamera = $products
            ->selectRaw("TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Камера:', -1), '|', 1)) as camera")
            ->where('characteristics', 'LIKE', '%Камера:%')
            ->distinct()
            ->get();
        $uniqueVideo = $products
            ->selectRaw("TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Видеоразрешение:', -1), '|', 1)) as video")
            ->where('characteristics', 'LIKE', '%Видеоразрешение:%')
            ->distinct()
            ->get();
        $uniquePeculiarities = $products
            ->selectRaw("TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Особенности:', -1), '|', 1)) as peculiarities")
            ->where('characteristics', 'LIKE', '%Особенности:%')
            ->distinct()
            ->get();

        return view('catalog', ['data'=>$catalog, 'brands' => $brands, 'min' => $minPrice, 'max' => $maxPrice,
            'uniq_camera' => $uniqueResolutions, 'uniq_protection' => $uniqueProtection, 'uniq_flight' => $uniqueFlight,
            'uniq_aperture' => $uniqueAperture, 'uniq_matrix' => $uniqueMatrix, 'uniq_camera' => $uniqueCamera,
            'uniq_video' => $uniqueVideo, 'uniq_peculiarities' => $uniquePeculiarities]);
    }

    public function sort(Request $request){
        $products = new Products();
//        $products = $products->orderBy('price', $request->sort)->paginate(6)->appends(['sort' => $request->sort]);
        $products = $products->orderBy('price', $request->sort)->get();

        return view('itemCatalog', ['data'=>$products]);

    }

    public function search(Request $request){
        $products = new Products();
        $products = $products->where('name', 'like', '%'.$request->search.'%')->get();

        if (count($products) == 0){
            return 'Ничего не найдено';
        } else {
            return view('itemCatalog', ['data'=>$products]);
        }

    }

    public function filter(Request $request){
        $products = new Products();
        if(!empty($request->brands)){
            $products = $products->whereIn('brand', $request->brands);
        }

        if(!empty($request->camera)){
            $products = $products->where('characteristics', 'like', '%'.$request->camera.'%');
        }

        if(!empty($request->aperture)){
            $products = $products->where('characteristics', 'like', '%'.$request->aperture.'%');
        }

        if(!empty($request->peculiarities)){
            $products = $products->where('characteristics', 'like', '%'.$request->peculiarities.'%');
        }

        if(!empty($request->matrix)){
            $products = $products->where('characteristics', 'like', '%'.$request->matrix.'%');
        }

        if(!empty($request->camera)){
            $products = $products->where('characteristics', 'like', '%'.$request->camera.'%');
        }

        if(!empty($request->video)){
            $products = $products->where('characteristics', 'like', '%'.$request->video.'%');
        }

        if(!empty($request->flight)){
            $products = $products->where('characteristics', 'like', '%: '.$request->flight.'%');
        }

        if(!empty($request->lightweight)){
            $products = $products->whereRaw("SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Вес: ', -1), 'г', 1) < 250");
        }

        if(!empty($request->time)){
            if($request->time == 'less'){
                $products = $products->whereRaw("SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Время полёта: ', -1), 'мин', 1) < 30");
            } elseif ($request->time == 'between'){
                $products = $products->whereBetween(DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Время полёта: ', -1), 'мин', 1)"), [30, 40]);
            } elseif ($request->time == 'more'){
                $products = $products->whereRaw("SUBSTRING_INDEX(SUBSTRING_INDEX(characteristics, 'Время полёта: ', -1), 'мин', 1) > 40");
            }
        }

        if(!empty($request->protect)){
            $products = $products->where('characteristics', 'like', '%'.$request->protect.'%');
        } elseif ($request->protect == 'none'){
            $products = $products->whereNotLike('characteristics', '%IP%');
        }

        if($request->priceFrom || $request->priceTo){
            $products = $products->whereBetween('price', [$request->priceFrom, $request->priceTo]);
        }

        $products = $products->get();

        if (count($products) == 0){
            return 'Ничего не найдено';
        } else {
            return view('itemCatalog', ['data'=>$products]);
        }
    }
}
