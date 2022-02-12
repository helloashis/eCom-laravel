<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cart_item = Cart::where('user_ip',request()->ip())->latest()->get();
            $subtotal = Cart::all()->where('user_ip',request()->ip())->sum(
                function ($t){
                    return $t->price * $t->qty;
            });
            return view('pages.checkout',compact('cart_item','subtotal'));
        }else{
            return Redirect()->route('login')->with('wishlist_msg','At first login your account.');
        }
    }
}
