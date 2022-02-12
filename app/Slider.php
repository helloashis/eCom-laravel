<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'category_id','title','slug','sub_title','image',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
