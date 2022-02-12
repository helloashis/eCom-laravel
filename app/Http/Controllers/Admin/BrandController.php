<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $brands = Brand::latest()->get();

        return view('admin.brand.index', compact('brands'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands,brand_name|max:30',

        ]);
        $slug = strtolower($request->brand_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => preg_replace('~[\\\\/:*$&@?"<>| ]~',"-",$slug),
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('msg',"Brand added succesfully!");
    }

    public function delete($id)
    {
        $cat = Brand::find($id);
        $cat->delete();

        return Redirect()->back()->with('msg',"Brand deleted succesfully!");

    }
    public function edit($slug)
    {
        $brand = Brand::where('brand_slug',$slug)->first();

        return view('admin.brand.edit', compact('brand'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands,brand_name|max:30',
        ]);
        $slug = strtolower($request->brand_name);
        $id = $request->id;
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => preg_replace('~[\\\\/:*$&@?"<>| ]~',"-",$slug),
            'updated_at' => Carbon::now(),
        ]);

        return Redirect()->route('admin.brand')->with('msg',"Brand update succesfully..!");
    }

    public function inactive($id)
    {
        Brand::find($id)->update([
            'brand_status' => 0,
        ]);
        return Redirect()->route('admin.brand')->with('msg',"Brand Inactive succesfully!");
    }
    public function active($id)
    {
        Brand::find($id)->update([
            'brand_status' => 1,
        ]);
        return Redirect()->route('admin.brand')->with('msg',"Brand Active succesfully!");
    }
}
