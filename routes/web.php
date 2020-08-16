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


Auth::routes();
Route::get('/logout',function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->to("/login");
 });

Route::get('/', 'HomeController@index')->name('home');
Route::get("/detail-product/{id}","HomeController@productDetail");

Route::get("/danh-muc/{id}","HomeController@listingCategory");

Route::get("/open-cart","HomeController@openCart")->middleware("auth");
Route::get("/shopping/{id}","HomeController@shopping")->middleware("auth");
Route::post("/shopping/{id}","HomeController@pshopping")->middleware("auth");
Route::get("/cart","HomeController@cart")->middleware("auth");
Route::get("/clear-cart","HomeController@clearCart")->middleware("auth");
