@extends('layouts.master_layout')


@section('content')
 <!-- Hero Section Begin -->
 <section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categories</span>
                    </div>
                    @php
                        $categories = App\Category::latest()->where('cat_status',1)->get();
                    @endphp
                    <ul style="display: none">
                        @foreach ($categories as $item)
                            <li><a href="#">{{ $item->cat_name }}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>View Order Details </h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>My Account</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="container mt-2 mb-2">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('home') }}" class="btn btn-primary">Go Back</a>
                        <span class="text-center">Order Item</span>
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
                            <div class="col-sm-6">
                                <div class="float-right">
                                    <h3 class="mb-0">Invoice #{{ $order->invoice_no }}</h3>
                                    Date: {{ date('d-m-Y', strtotime($order->created_at)) }}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-striped">
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
                                <h5 class="border border-danger pt-3 pb-3 text-danger"> <b>{{ $order->payment_type }}</b> </h5>
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
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
