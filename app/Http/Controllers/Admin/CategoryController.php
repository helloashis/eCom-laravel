<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.category.index', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|unique:categories,cat_name|max:30',

        ]);
        $slug = strtolower($request->cat_name);

        Category::insert([
            'cat_name' => $request->cat_name,
            'cat_slug' => preg_replace('~[\\\\/:*$&@?"<>| ]~',"-",$slug),
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('msg',"Category added succesfully!");
    }

    public function delete($id)
    {
        $cat = Category::find($id);
        $cat->delete();

        return Redirect()->back()->with('msg',"Category deleted succesfully!");

    }
    public function edit($slug)
    {
        $category = Category::where('cat_slug',$slug)->first();

        return view('admin.category.edit', compact('category'));

    }
    public function update(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|unique:categories,cat_name|max:30',
        ]);
        $slug = strtolower($request->cat_name);
        $id = $request->id;
        Category::find($id)->update([
            'cat_name' => $request->cat_name,
            'cat_slug' => preg_replace('~[\\\\/:*$&@?"<>| ]~',"-",$slug),
            'updated_at' => Carbon::now(),
        ]);

        return Redirect()->route('admin.category')->with('msg',"Category update succesfully..!");
    }

    public function inactive($id)
    {
        Category::find($id)->update([
            'cat_status' => 0,
        ]);
        return Redirect()->route('admin.category')->with('msg',"Category Inactive succesfully!");
    }
    public function active($id)
    {
        Category::find($id)->update([
            'cat_status' => 1,
        ]);
        return Redirect()->route('admin.category')->with('msg',"Category Active succesfully!");
    }
}
