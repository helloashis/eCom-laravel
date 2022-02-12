<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function index()
    {   if (Auth::check()) {
            $wish_item = Wishlist::where('user_id',Auth::id())->latest()->get();
            return view('pages.wishlist',compact('wish_item'));
        }else {
            return Redirect()->route('login')->with('wishlist_msg','At first login your account.');
        }
    }
    public function addToWishlist(Request $request,$id)
    {
        if (Auth::check()) {
            $check = Wishlist::where('product_id',$id)->where('user_id',Auth::id())->first();
            if ($check) {
                return Redirect()->back()->with('msg','This product allready added in wishlist.');
            }else {
                Wishlist::insert([
                    'product_id'=> $id,
                    'user_id'   => Auth::id(),
                    'created_at'=> Carbon::now(),
                ]);
                return Redirect()->back()->with('msg','Product added on wishlist');
            }
        } else {
            return Redirect()->route('login')->with('wishlist_msg','At first login your account.');
        }




    }
    public function remove($id)
    {
        Wishlist::where('id',$id)->where('user_id',Auth::id())->delete();
        return Redirect()->back()->with('cart',"1 Item remove succesfully!");

    }
}
