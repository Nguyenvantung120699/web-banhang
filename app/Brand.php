<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = ['brandsName','logo','history','isActive'];

    public function product(){
        return $this->hasMany('App\Product');
    }
    const ACTIVETRUE = 1;
    const ACTIVEFALSE = 0;
}
