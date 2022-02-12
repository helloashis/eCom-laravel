@extends('admin.layout')
    @if ($order->status == 'Pending')
        @section('orders') active @endsection
    @else
        @section('receivedorders') active @endsection
    @endif
@section('admin_content')

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Admin</a>
        @if ($order->status == 'Pending')
            <span class="breadcrumb-item ">Orders</span>
        @else
            <span class="breadcrumb-item ">Receive Orders</span>
        @endif
      <span class="breadcrumb-item active">View Order</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row justify-content-center mt-2">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header p-4">
                        <a class="pt-2 d-inline-block" href="" data-abc="true">Order view</a>
                        <div class="float-right">
                            <h3 class="mb-0">Invoice #{{ $order->invoice_no }}</h3>
                            Date: {{ date('d-m-Y', strtotime($order->created_at)) }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6 ">
                                <h4 class="mb-3">Shipping Address:</h4>
                                <h3 class="text-dark mb-1">{{ $shipping->shipping_first_name }} {{ $shipping->shipping_last_name }}</h3>
                                <div>{{ $shipping->address }}</div>
                                <div>{{ $shipping->address }}-{{ $shipping->postcode }}, {{ $shipping->state }} </div>
                                <div>Email: {{ $shipping->shipping_email }}</div>
                                <div>Phone: {{ $shipping->shipping_phone }}</div>
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Item</th>
                                        <th class="right">Price</th>
                                        <th class="center">Qty</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($order_item as $item)

                                    <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td class="left strong">{{ $item->product_name}}</td>
                                        <td class="right">&#2547; {{ $item->product->product_price}}</td>
                                        <td class="center">{{ $item->product_qty}}</td>
                                        <td class="right">&#2547; {{ $item->product->product_price*$item->product_qty }}</td>
                                    </tr>
                                    <?php $i++;?>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5 text-center">
                                <h5 class="border border-danger pt-3 pb-3 text-danger">{{ $order->payment_type }}</h5>
                            </div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Subtotal</strong>
                                            </td>
                                            <td class="right">&#2547; {{ $order->sub_total }}</td>
                                        </tr>
                                        @if ($order->discount_coupon == Null)

                                        @else
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Discount ({{$order->discount_coupon}}%)</strong>
                                            </td>
                                            <td class="right"><span>-</span> &#2547; {{ round($order->discount_coupon * $order->sub_total /100) }}</td>
                                        </tr>

                                        @endif

                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Total</strong> </td>
                                            <td class="right">
                                                <strong class="text-dark">&#2547; {{ $order->total }}</strong>
                                            </td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        @if ($order->status == 'Pending')
                                            <tr>
                                                <td colspan="2">
                                                    <form action="{{ route('received.order') }}" method="post">
                                                        @csrf

                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                                                        <button type="submit" class="btn btn-success btn-sm btn-block">Received Order</button>

                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row -->

    </div><!-- sl-pagebody -->


@endsection


