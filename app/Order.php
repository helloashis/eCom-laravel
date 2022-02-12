<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id','invoice_no','payment_type','total','sub_total','discount_coupon','status',
    ];
}
