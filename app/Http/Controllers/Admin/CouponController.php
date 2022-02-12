<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $coupon = Coupon::latest()->get();

        return view('admin.coupon.index', compact('coupon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required|unique:coupons,coupon_name|max:30',
            'get_amount' => 'required',
            'experied_date' => 'required',

        ]);


        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'get_amount' => $request->get_amount,
            'experied_date' => $request->experied_date,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('msg',"A new coupon created succesfully!");
    }

    public function delete($id)
    {
        Coupon::find($id)->delete();

        return Redirect()->back()->with('msg',"Coupon deleted succesfully!");

    }

    public function inactive($id)
    {
        Coupon::find($id)->update([
            'coupon_status' => 0,
        ]);
        return Redirect()->route('admin.coupon')->with('msg',"Coupon Inactive succesfully!");
    }
    public function active($id)
    {
        Coupon::find($id)->update([
            'coupon_status' => 1,
        ]);
        return Redirect()->route('admin.coupon')->with('msg',"Coupon Active succesfully!");
    }
}
