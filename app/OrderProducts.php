<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $table = 'orderProducts';

    protected $fillable = ['orderId','productId','quantity','price','total'];
}
