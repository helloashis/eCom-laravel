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
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @if (Session('cart'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{{Session('cart')}}</strong>
                        </div>
                    @endif
                    @if (Session('coupon_txt'))
                        <div class="alert alert-warning alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{{Session('coupon_txt')}}</strong>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_item as $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="width:80px;height:80px;" src="{{ asset('uploads/products/'.$item->product->image_one) }}" alt="">
                                            <h5>{{ $item->product->product_name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ $item->price }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <form action="{{ route('update.qty',$item->id) }}" method="post">
                                                    @csrf
                                                    <div class="pro-qty">
                                                        <input type="text" name="qty" value="{{ $item->qty }}">
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            ${{ $sub_total = $item->price * $item->qty }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{ url('remove',$item->id) }}"><span class="icon_close"></span></a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    @if (Session::has('coupon'))
                    @else
                        <div class="shoping__continue">
                            <div class="shoping__discount">
                                <h5>Discount Codes</h5>
                                <form action="{{ route('apply.coupon') }}" method="POST">
                                    @csrf
                                    <input type="text" name="coupon" value="{{ old('coupon') }}" placeholder="Enter your coupon code">
                                    <button type="submit" class="site-btn">APPLY COUPON</button>
                                </form>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>

                        <ul>

                            <li>Subtotal <span>&#2547;{{ $subtotal }}</span></li>
                            @if (Session::has('coupon'))
                                <li>Discount
                                    <small> ( Coupon: {{ Session()->get('coupon')['coupon_name'] }} )</small>
                                    <span text-left>
                                        {{ Session()->get('coupon')['discount'] }}% ( - {{ $discount = round($subtotal*Session()->get('coupon')['discount']/100) }} Tk )
                                        &nbsp;<a href="{{ route('destroy.coupon') }}" class="btn btn-success btn-sm icon_close float-right"></a>
                                    </span>

                                </li>
                                <li>Total <span>&#2547;{{ $subtotal - $discount }}</span></li>
                            @else
                                <li>Total <span>&#2547;{{ $subtotal }}</span></li>
                            @endif

                        </ul>
                        <a href="{{ route('checkout') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->


@endsection
