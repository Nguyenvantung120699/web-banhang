<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['userId','customerName','shippingAddress','telephone','grandTotal','paymentMethod','customerNote','status'];

    const STATUS_PENDING = 0;
    const STATUS_PROCESS = 1;
    const STATUS_SHIPPING = 2;
    const STATUS_COMPLETE = 3;
    const STATUS_CANCEL = 4;
}
