<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable =['productName','productsDescription','thumbnail','gallery','categoriesId','brandsId','price','quantity','isActive'];

    public function category(){
        return $this->belongsTo("App\Category","categoriesId");
    }

    public function brand(){
        return $this->belongsTo('App\Brand','brandsId');
    }
    public function getPrice(){
        return number_format($this->price,0,',','.');
    }

    const ACTIVETRUE = 1;
    const ACTIVEFALSE = 0;
}
