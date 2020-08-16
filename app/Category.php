<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['categoriesName','logo','description','isActive'];

    public function Products(){
        return $this->hasMany('App\Product','categoriesId');
    }

    const ACTIVETRUE = 1;
    const ACTIVEFALSE = 0;
}
