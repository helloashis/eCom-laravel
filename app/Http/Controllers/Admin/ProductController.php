<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /* **** Show product form **** */
    public function addProduct(Request $request)
    {
        $categories = Category::where('cat_status','1')->latest()->get();
        $brands = Brand::where('brand_status','1')->latest()->get();

        return view('admin.product.add',compact('categories','brands'));
    }

    /* **** store single product  **** */
    public function store(Request $request)
    {

        $request->validate([
            'product_name' => 'required|unique:products,product_name|max:30',
            'category' => 'required',
            'brand' => 'required',
            'price' => 'required',
            //'discount_price' => 'required',
            'quantity' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'image_one' => 'required|mimes:jps,jpeg,png,gif',
            'image_two' => 'required|mimes:jps,jpeg,png,gif',
            'image_three' => 'required|mimes:jps,jpeg,png,gif',

        ]);

        $image_one = $request->file('image_one');
        $fileName_gen1 = 'product_'.hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(270,270)->save('uploads/products/'.$fileName_gen1);
        $img_path1 = 'uploads/products/'.$fileName_gen1;

        $image_two = $request->file('image_two');
        $fileName_gen2 = 'product_'.hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
        Image::make($image_two)->resize(270,270)->save('uploads/products/'.$fileName_gen2);
        $img_path2 = 'uploads/products/'.$fileName_gen2;

        $image_three = $request->file('image_three');
        $fileName_gen3 = 'product_'.hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
        Image::make($image_three)->resize(270,270)->save('uploads/products/'.$fileName_gen3);
        $img_path3 = 'uploads/products/'.$fileName_gen3;


        $slug = preg_replace('~[\\\\/:*$&@?"<>| ]~',"-",strtolower($request->product_name));

        Product::insert([
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'product_name' => $request->product_name,
            'product_slug' => $slug,
            'product_price' => $request->price,
            //'discount_price' => $request->discount_price,
            'product_qty' => $request->quantity,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image_one' => $fileName_gen1,
            'image_two' => $fileName_gen2,
            'image_three' => $fileName_gen3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return Redirect()->back()->with('msg',"A new product added succesfully!");

    }

    public function manage()
    {
        $products = Product::latest()->get();
        return view('admin.product.manage',compact('products'));
    }

    public function delete($id)
    {
        $get_img = Product::findOrFail($id);

        $img_one = 'uploads/products/'.$get_img->image_one;
        $img_two = 'uploads/products/'.$get_img->image_two;
        $img_three = 'uploads/products/'.$get_img->image_three;
        unlink($img_one);
        unlink($img_two);
        unlink($img_three);

        Product::findOrFail($id)->delete();

        return Redirect()->back()->with('msg',"Product deleted succesfully!");

    }

    public function inactive($id)
    {
        Product::find($id)->update([
            'product_status' => 0,
        ]);
        return Redirect()->route('admin.manage-product')->with('msg',"Product Inactive succesfully!");
    }
    public function active($id)
    {
        Product::find($id)->update([
            'product_status' => 1,
        ]);
        return Redirect()->route('admin.manage-product')->with('msg',"Product Active succesfully!");
    }

    public function edit($slug)
    {
        $product = Product::where('product_slug',$slug)->first();
        $categories = Category::where('cat_status','1')->latest()->get();
        $brands = Brand::where('brand_status','1')->latest()->get();

        return view('admin.product.edit', compact('product','categories','brands'));

    }

    public function update(Request $request)
    {
        $slug = str_replace(" ","-",strtolower($request->product_name));
        $id = $request->product_id;
        Product::findOrFail($id)->update([
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'product_name' => $request->product_name,
            'product_slug' => $slug,
            'product_price' => $request->price,
            'discount_price' => $request->discount_price,
            'product_qty' => $request->quantity,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'updated_at' => Carbon::now(),
        ]);
        return Redirect()->route('admin.manage-product')->with('msg',"A product update succesfully!");

    }
    public function updateImg(Request $request)
    {

        $id = $request->product_id;
        $image_one_path = "uploads/products/".$request->image_one;
        $image_two_path = "uploads/products/".$request->image_two;
        $image_three_path = "uploads/products/".$request->image_three;


        if($request->has('image_one')){
            if(file_exists($image_one_path)) {
                unlink($image_one_path);
            }
            $image_one = $request->file('image_one');
            $fileName_gen1 = 'product_'.hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(270,270)->save('uploads/products/'.$fileName_gen1);
            Product::findOrFail($id)->update([
                'image_one' => $fileName_gen1,
                'updated_at' => Carbon::now(),
            ]);
            return Redirect()->route('admin.manage-product')->with('msg',"Image succesfully updated!");

        }


    }
}
