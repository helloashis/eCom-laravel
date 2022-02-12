<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $sliders = Slider::latest()->get();

        return view('admin.slider.index',compact('sliders'));
    }

    public function viewform()
    {
        $categories = Category::where('cat_status','1')->latest()->get();
        return view('admin.slider.create',compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:sliders,title|max:50',
            'sub_title' => 'required|max:50',
            'category' => 'required',
            'image' => 'required|mimes:jps,jpeg,png,gif',

        ]);

        $image_one = $request->file('image');
        $fileName_gen1 = 'slider_'.hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(870,431)->save('uploads/sliders/'.$fileName_gen1);

        $slug = preg_replace('~[\\\\/:*$&@?"<>| ]~',"-",strtolower($request->title));


        Slider::insert([
            'category_id' => $request->category,
            'title' => $request->title,
            'slug' => $slug,
            'sub_title' => $request->sub_title,
            'image' => $fileName_gen1,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->back()->with('msg',"A new slider created succesfully!");
    }

    public function delete($id)
    {
        $get_img = Slider::findOrFail($id);

        $img_one = 'uploads/sliders/'.$get_img->image;
        unlink($img_one);

        Slider::findOrFail($id)->delete();

        return Redirect()->back()->with('msg',"Slider deleted succesfully!");

    }

    public function inactive($id)
    {
        Slider::find($id)->update([
            'status' => 0,
        ]);
        return Redirect()->route('admin.slider')->with('msg',"Slider Inactive succesfully!");
    }
    public function active($id)
    {
        Slider::find($id)->update([
            'status' => 1,
        ]);
        return Redirect()->route('admin.slider')->with('msg',"Slider Active succesfully!");
    }
}
