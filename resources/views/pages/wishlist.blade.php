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
                        <h2>Wish-List</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Wish-List</span>
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
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wish_item as $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="width:80px;height:80px;" src="{{ asset('uploads/products/'.$item->product->image_one) }}" alt="">
                                            <h5>{{ $item->product->product_name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            &#2547;{{ $item->product->product_price }}
                                        </td>

                                        <td class="shoping__cart__item__close">
                                            <form action="{{ url('add/to-cart/'.$item->product->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $item->product->product_price }}" name="price">
                                                <button type="submit" class="site-btn">Add to cart</button>
                                            </form>

                                        </td>

                                        <td class="shoping__cart__item__close">
                                            <a href="{{ route('remove-wish',$item->id) }}"><span class="icon_close"></span></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->


@endsection
