<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request,$id)
    {   $user_ip = request()->ip();
        $check = Cart::where('product_id',$id)->where('user_ip',$user_ip)->first();
        if ($check) {
            Cart::where('product_id',$id)->increment('qty');

            return Redirect()->back()->with('msg','Product add on cart succefully');
        }else {
            Cart::insert([
                'product_id'=> $id,
                'qty'       => 1,
                'price'     => $request->price,
                'user_ip'   => $user_ip,
                'created_at'=> Carbon::now(),
            ]);
            return Redirect()->back()->with('msg','Product added on cart');
        }

    }

    public function index()
    {
        $cart_item = Cart::where('user_ip',request()->ip())->latest()->get();
        $subtotal = Cart::all()->where('user_ip',request()->ip())->sum(
            function ($t){
                return $t->price * $t->qty;
            });
        return view('pages.carts',compact('cart_item','subtotal'));
    }
    public function remove($id)
    {
        Cart::where('id',$id)->where('user_ip',request()->ip())->delete();
        return Redirect()->back()->with('cart',"1 Item remove succesfully!");

    }
    public function UpdateQty(Request $request,$id)
    {
        //$id = $request->id;
        Cart::where('id',$id)->where('user_ip',request()->ip())->update([
            'qty' => $request->qty,
        ]);
        return Redirect()->route('cart')->with('cart',"Quantity update succesfully!");
    }
    public function applyCoupon(Request $request)
    {
        $check_coupon = Coupon::where('coupon_name',$request->coupon)->where('coupon_status',1)->first();
        if ($check_coupon) {
            Session::put('coupon',[
                'coupon_name' => $check_coupon->coupon_name,
                'discount'  => $check_coupon->get_amount,
            ]);
            return Redirect()->route('cart')->with('cart',"Successfully coupon applied");
        } else {
            return Redirect()->back()->with('coupon_txt',"Invalid Or Expired coupon, Please enter the valid coupon!");
        }
    }

    public function destroyCoupon()
    {
        if (Session::has('coupon')) {
            session()->forget('coupon');
            return Redirect()->back()->with('coupon_txt',"Coupon removed successfully");

        }
    }

}
