<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = ['brandsName','logo','history','isActive'];

    public function Products(){
        return $this->hasMany('App\Product','brandsId');
    }
    const ACTIVETRUE = 1;
    const ACTIVEFALSE = 0;
}
