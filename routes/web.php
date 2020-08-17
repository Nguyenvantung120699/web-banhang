<?php

use Illuminate\Support\Facades\Route;

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
Route::prefix("admin")->middleware(['auth',"check_admin"])->group(function (){
    include_once("admin.php");
});

Route::get('/', 'HomeController@index')->name('home');
Route::get("/detail-product/{id}","HomeController@productDetail");

Route::get("/danh-muc/{id}","HomeController@listingCategory");
Route::get("/thuong-hieu/{id}","HomeController@listingBrand");

Route::get("search",'HomeController@getSearch');

Route::get("/open-cart","HomeController@openCart")->middleware("auth");
Route::get("/shopping/{id}","HomeController@shopping")->middleware("auth");
Route::post("/shopping/{id}","HomeController@pshopping")->middleware("auth");
Route::get("/cart","HomeController@cart")->middleware("auth");
Route::get("/clear-cart","HomeController@clearCart")->middleware("auth");

Route::get("/user-profile/{id}","HomeController@userprofileindex");
Route::get('user-profile/create',"HomeController@userprofileCreate");
Route::post('user-profile/store',"HomeController@userprofileStore");
Route::post('user-profile/update/{id}',"HomeController@userprofileUpdate");


Auth::routes();
Route::get('/logout',function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->to("/login");
 });

 Route::post("postLogin","HomeController@postLogin");