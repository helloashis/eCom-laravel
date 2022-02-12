<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blog.index',compact('blogs'));
    }
    public function viewform()
    {
        return view('admin.blog.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:sliders,title|max:50',
            'description' => 'required',
            'thumbnail' => 'required|mimes:jps,jpeg,png,gif,webp',

        ]);

        $image_one = $request->file('thumbnail');
        $fileName_gen1 = 'blogthumb_'.hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(370,266)->save('uploads/blogs/'.$fileName_gen1);

        $slug = preg_replace('~[\\\\/:*$&@?"<>| ]~',"-",strtolower($request->title));

        Blog::insert([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'thumbnail' => $fileName_gen1,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('msg',"A new blog post created succesfully!");
    }
    public function delete($id)
    {
        $get_img = Blog::findOrFail($id);

        $img_one = 'uploads/blogs/'.$get_img->thumbnail;
        unlink($img_one);

        Blog::findOrFail($id)->delete();

        return Redirect()->back()->with('msg',"Post deleted succesfully!");

    }

    public function inactive($id)
    {

        Blog::find($id)->update([
            'status' => 0,
        ]);
        return Redirect()->route('admin.blog')->with('msg',"Post Inactive succesfully!");
    }
    public function active($id)
    {
       $blog = Blog::find($id)->update([
            'status' => 1,
        ]);
        if ($blog) {

            return Redirect()->route('admin.blog')->with('msg',"Post Active succesfully!");
        }else{

            return Redirect()->route('admin.blog')->with('msg',"Something went wrong");

        }
    }
}
