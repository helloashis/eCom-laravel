<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'product_name',
        'product_slug',
        'product_qty',
        'short_description',
        'long_description',
        'product_price',
        'discount_price',
        'image_one',
        'image_two',
        'image_one',
        'product_status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
