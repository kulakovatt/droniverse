<?php

use Illuminate\Support\Facades\Route;
use App\Models\Products;
use App\Models\Training;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $products = new Products();
    $trainings = new Training();
    return view('home', ['products' => $products->inRandomOrder()->take(3)->get(), 'trainings' => $trainings->all()]);
})->name('home');

Route::get('/catalog', function () {
    return view('catalog');
});

Route::get('/delivery', function () {
    return view('delivery');
});

Route::get('/auth', function () {
    return view('auth');
});

Route::get('/reg', function () {
    return view('register');
});

Route::get('/account', function () {
    return view('account');
});

Route::get('/studing', function () {
    return view('studing');
});

Route::get('/basket', function (){
   return view('basket');
});

Route::get('/orderMail', function () {
    return view('orderMail');
});

Route::get('/account', 'App\Http\Controllers\AccountController@who_user')->name('office_view');
Route::get('/basket', 'App\Http\Controllers\BasketController@who_user')->name('basket');

Route::post('/reg/submit', 'App\Http\Controllers\RegisterController@submit');
Route::post('/regist-training', 'App\Http\Controllers\TrainingController@regist_training');
Route::post('/auth/submit', 'App\Http\Controllers\AuthController@submit');
Route::post('/account/add', 'App\Http\Controllers\AccountController@add');
Route::post('/account/add-training', 'App\Http\Controllers\TrainingController@add');
Route::post('/account/add-equipment', 'App\Http\Controllers\ProductController@add_equipment');
Route::post('/account/add-images', 'App\Http\Controllers\ProductController@add_images');
Route::post('/account/edit', 'App\Http\Controllers\AccountController@edit')->name('Edit');
Route::post('/account/edit-training', 'App\Http\Controllers\TrainingController@edit')->name('Edit');
Route::post('/account/delete-training', 'App\Http\Controllers\TrainingController@delete')->name('Delete');
Route::post('/account/delete', 'App\Http\Controllers\AccountController@delete')->name('Delete');
Route::post('/basket/count', 'App\Http\Controllers\BasketController@change_count')->name('ChangeCount');
Route::post('/basket/remove-prod', 'App\Http\Controllers\BasketController@remove_prod')->name('RemoveProd');
Route::post('/basket/order/add', 'App\Http\Controllers\BasketController@add_order')->name('AddOrder');
Route::post('/account/order/confirm', 'App\Http\Controllers\AccountController@confirm_order')->name('ConfirmOrder');
Route::post('/account/order/issued', 'App\Http\Controllers\AccountController@issued_order')->name('IssuedOrder');
Route::post('/account/order/cancel', 'App\Http\Controllers\AccountController@cancel_order')->name('CancelOrder');
Route::post('/account/edit', 'App\Http\Controllers\AccountController@edit');
Route::post('/account/delete', 'App\Http\Controllers\AccountController@delete');
Route::get('/signout', 'App\Http\Controllers\AuthController@signout');
Route::get('/send', 'App\Http\Controllers\MailController@send')->name('send');
Route::get('/repeat/send', 'App\Http\Controllers\VerifyController@repeat_send')->name('repeat');

Route::get('/verify', function () {
    return view('verify');
})->name('verify');

Route::post('/reg/submit/verify', 'App\Http\Controllers\VerifyController@input_code');

Route::get('/about', function () {
    return view('about');
});

Route::get('/support', function () {
    return view('support');
});

Route::get('/support', 'App\Http\Controllers\SupportController@chat');
Route::get('/catalog', 'App\Http\Controllers\CatalogController@all');
Route::get('/admin-get-training', 'App\Http\Controllers\TrainingController@get_data');
Route::get('/admin-get', 'App\Http\Controllers\AccountController@get_data');
Route::post('/catalog/sort', 'App\Http\Controllers\CatalogController@sort')->name('Sort');
Route::post('/catalog/search', 'App\Http\Controllers\CatalogController@search')->name('Search');
Route::post('/catalog/filter', 'App\Http\Controllers\CatalogController@filter')->name('Filter');
Route::get('catalog/product/{id}', 'App\Http\Controllers\ProductController@show');
Route::post('/add-basket', 'App\Http\Controllers\ProductController@add_basket')->name('Basket');

Route::get('/order-send', 'App\Http\Controllers\PDFController@index')->name('order-send');
