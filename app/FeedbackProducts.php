<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackProducts extends Model
{
    protected $table = 'feedbackproducts';

    protected $fillable = ['usersId','name','productsId','point','feel','image'];

    public function Products(){
        return $this->hasMany("\App\Product",'productsId');
    }

}
