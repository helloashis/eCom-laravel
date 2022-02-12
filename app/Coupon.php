<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'coupon_name', 'experied_date','get_amount', 'coupon_status',
    ];
}
