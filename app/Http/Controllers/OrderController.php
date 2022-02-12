<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Cart;
use App\Shipping;
use App\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function storeOrder(Request $request)
    {
        if (Auth::check()) {


            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'town_city' => 'required',
                'state' => 'required',
                'postcode' => 'required',
                'phone' => 'required | max:14',
                'email' => 'required',
                'payment_type' => 'required',
            ]);
            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'invoice_no' => mt_rand(10000000,99999999),
                'payment_type' => $request->payment_type,
                'total' => $request->total,
                'sub_total' => $request->subtotal,
                'discount_coupon' => $request->coupon_discount,
                'status' => 'Pending',
                'created_at' => Carbon::now(),
            ]);
            $cart_item = Cart::where('user_ip',request()->ip())->latest()->get();
            foreach ($cart_item as $item) {

                OrderItem::insert([
                    'order_id' => $order_id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->product_name,
                    'product_qty' => $item->qty,

                    'created_at' => Carbon::now(),

                ]);
            }

            Shipping::insert([
                'order_id' => $order_id,
                'shipping_first_name' => $request->first_name,
                'shipping_last_name' => $request->last_name,
                'shipping_email' => $request->email,
                'shipping_phone' => $request->phone,
                'address' => $request->address,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'created_at' => Carbon::now(),


            ]);

            if (Session::has('coupon')) {
                session()->forget('coupon');
            }
            Cart::where('user_ip',request()->ip())->delete();
            Wishlist::where('user_id',Auth::id())->delete();

            return Redirect()->route('home')->with('msg','Your order placed done.');
        }else {
            return Redirect()->route('login')->with('wishlist_msg','At first login your account.');
        }


    }


    public function orderSuccess()
    {
        if (Auth::check()) {
            return view('pages.order-complete');
        }else {
            return Redirect()->route('login')->with('wishlist_msg','At first login your account.');
        }
    }
    public function viewOrder($id)
    {
        $order = Order::findOrFail($id);
        $order_item = OrderItem::where('order_id',$id)->get();
        $shipping = Shipping::where('order_id',$id)->first();

        return view('pages.view_order', compact('order','order_item','shipping'));
    }
}
