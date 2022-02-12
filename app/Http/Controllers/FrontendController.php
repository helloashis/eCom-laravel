<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Brand;
use App\Category;
use Illuminate\Http\Request;
use App\Product;
use App\Slider;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::where('product_status',1)->latest()->get();
        $top_products = Product::where('product_status',1)->orderby('id','ASC')->get();
        $review_products = Product::where('product_status',1)->orderby('product_name','ASC')->get();
        $categories = Category::where('cat_status','1')->latest()->get();
        $brands = Brand::where('brand_status','1')->latest()->get();
        $sliders = Slider::where('status','1')->limit(1)->latest()->get();
        $blogs = Blog::where('status','1')->limit(3)->latest()->get();
        return view('pages.index', compact('products','categories','brands','top_products','review_products','sliders','blogs') );
    }

    public function details($details)
    {
        $products = Product::where('product_slug',$details)->first();
        $rlt_products = Product::where('category_id',$products->category->id)->where('id','!=',$products->id)->orderby('id')->get();

        return view('pages.details',compact('products','rlt_products'));
    }
    public function shop()
    {
        $products = Product::where('product_status',1)->paginate(12);
        $sell_off = Product::where('discount_price','!=',NULL)->where('product_status',1)->orderby('id','ASC')->get();

        return view('pages.shop', compact('products','sell_off') );
    }



}
