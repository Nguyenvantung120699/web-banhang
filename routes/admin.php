<?php
Route::get('index',"AdminController@index");

//route brand
Route::get('brandIndex',"AdminController@brandIndex");
Route::get('brand/create',"AdminController@brandCreate");
Route::post('brand/store',"AdminController@brandStore");
Route::get('brand/edit/{id}',"AdminController@brandEdit");
Route::post('brand/update/{id}',"AdminController@brandUpdate");
Route::get('brand/delete/{id}',"AdminController@brandDestroy");
Route::get('brand/detail/{id}',"AdminController@brandDetail");

//route category
Route::get('categoriesIndex',"AdminController@categoriesIndex");
Route::get('category/create',"AdminController@categoriesCreate");
Route::post('category/store',"AdminController@categoriesStore");
Route::get('category/edit/{id}',"AdminController@categoryEdit");
Route::post('category/update/{id}',"AdminController@categoryUpdate");
Route::get('category/delete/{id}',"AdminController@categoryDestroy");
Route::get('category/detail/{id}',"AdminController@categoryDetail");

//route product
Route::get('productIndex',"AdminController@productIndex");
Route::get('product/create',"AdminController@productCreate");
Route::post('product/store',"AdminController@productStore");
Route::get('product/edit/{id}',"AdminController@productEdit");
Route::post('product/update/{id}',"AdminController@productUpdate");
Route::get('product/delete/{id}',"AdminController@productDestroy");

//route user
Route::get('userIndex',"AdminController@userIndex");
Route::get('user/create',"AdminController@userCreate");
Route::post('user/store',"AdminController@userStore");
Route::get('user/edit/{id}',"AdminController@userEdit");
Route::post('user/update/{id}',"AdminController@userUpdate");
Route::get('user/delete/{id}',"AdminController@userDestroy");

//route user
Route::get('orderIndex',"AdminController@orderIndex");