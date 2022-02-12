<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Shipping;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $orders = Order::where('status','Pending')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function orderView($id)
    {
        $order = Order::findOrFail($id);
        $order_item = OrderItem::where('order_id',$id)->get();
        $shipping = Shipping::where('order_id',$id)->first();

        return view('admin.orders.views', compact('order','order_item','shipping'));
    }

    public function receivedOrder(Request $request){

        $id = $request->order_id;
        Order::find($id)->update([
            'status' => 'Confirmed',
        ]);
        return Redirect()->route('admin.orders')->with('msg',"Order received succesfully..!");


    }
    public function receivedList()
    {
        $received_orders = Order::where('status','Confirmed')->latest()->get();
        return view('admin.orders.received', compact('received_orders'));
    }
}
