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
                        <h2>{{ $products->product_name }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <a href="./index.html">{{ $products->category->cat_name }}</a>
                            <span>{{ $products->product_name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img width="100%" class="product__details__pic__item--large" src="{{ asset('uploads/products/'.$products->image_one ) }}" alt="{{ $products->product_name }}">
                        </div>
                        <div class="product__details__pic__slider owl-carousel owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(-862px, 0px, 0px); transition: all 1.2s ease 0s; width: 1725px;">
                                    <div class="owl-item cloned" style="width: 123.75px; margin-right: 20px;">
                                        <img data-imgbigurl="{{ asset('uploads/products/'.$products->image_one ) }}" src="{{ asset('uploads/products/'.$products->image_one ) }}" alt="{{ $products->product_name }}">
                                    </div>
                                    <div class="owl-item cloned" style="width: 123.75px; margin-right: 20px;">
                                        <img data-imgbigurl="{{ asset('uploads/products/'.$products->image_two ) }}" src="{{ asset('uploads/products/'.$products->image_two ) }}" alt="{{ $products->product_name }}">
                                    </div>
                                    <div class="owl-item cloned" style="width: 123.75px; margin-right: 20px;">
                                        <img data-imgbigurl="{{ asset('uploads/products/'.$products->image_three ) }}" src="{{ asset('uploads/products/'.$products->image_three ) }}" alt="{{ $products->product_name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="owl-nav disabled">
                                <button type="button" role="presentation" class="owl-prev">
                                    <span aria-label="Previous">‹</span>
                                </button>
                                <button type="button" role="presentation" class="owl-next">
                                    <span aria-label="Next">›</span>
                                </button>
                            </div>
                            <div class="owl-dots disabled">
                                <button role="button" class="owl-dot active">
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $products->product_name }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(5 reviews)</span>
                        </div>
                        <div class="product__details__price">&#2547; {{ $products->product_price }}</div>
                        <p>
                            {!! $products->short_description !!}
                        </p>
                        <div class="product__details__quantity">
                            <!--div class="pro-qty">
                                <input type="text" name="qty" value="1">
                            </div-->
                        </div>
                        @if ($products->product_qty >0)
                            <form action="{{ url('add/to-cart/'.$products->id) }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $products->product_price }}" name="price">
                                <button type="submit" class="primary-btn">ADD TO CARD</button>

                                <a href="{{ route('addwishlist',$products->id) }}" class="heart-icon"><span class="icon_heart_alt"></span></a>
                            </form>
                        @else
                            <h5 class="text-danger">
                                <marquee behavior="" direction=""><b> Stock Out </b> || <b> Stock Out </b> || <b> Stock Out </b> || <b> Stock Out </b></marquee>

                            </h5>
                        @endif
                        <ul>
                            <li><b>Availability</b>
                                @if ($products->product_qty >0)
                                    <span>In Stock</span>
                                @else
                                    <span class="text-danger"><b> Stock Out</b></span>
                                @endif
                            </li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <!--li><b>Weight</b> <span>0.5 kg</span></li-->
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Product Rating</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews <span>(5)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>{!! $products->long_description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Product Rating</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($rlt_products)

                    @foreach ($rlt_products as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $item->category->cat_slug }}">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="{{ asset('uploads/products/'.$item->image_one) }}">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="{{ route('addwishlist',$item->id) }}"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="{{ route('details',$item->product_slug) }}"><i class="fa fa-retweet"></i></a></li>
                                        <li>
                                            <form action="{{ url('add/to-cart/'.$item->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $item->product_price }}" name="price">
                                                <button type="submit" class="cart-btn"><i class="fa fa-shopping-cart"></i></button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#">{{ $item->product_name }}</a></h6>
                                    <h5>${{ $item->product_price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            No Data found.
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </section>



@endsection
