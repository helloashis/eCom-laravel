<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {

        if (Auth::check())
        {

            $request->validate([

                'old_pass' => ['required', 'string', 'min:4',  new MatchOldPassword],
                'password' => ['required', 'string', 'min:4', 'confirmed'],

            ]);

            User::find(Auth::user()->id)->update([
                    'password' => Hash::make($request->password),
                    'updated_at' => Carbon::now(),
                ]);
            return Redirect()->route('home')->with('change_password',"Password changed succesfully..!");
        }else {
            return Redirect()->route('login')->with('wishlist_msg','At first login your account.');
        }
    }
}
