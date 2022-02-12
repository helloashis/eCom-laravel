@extends('layouts.master_layout')
@section('index') active @endsection
@section('content')
  <!-- Hero Section Begin -->
  <section class="hero">
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
                    <ul>
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

                @foreach ($sliders as $item)

                    <div class="hero__item set-bg" data-setbg="{{ asset('uploads/sliders') }}/{{ $item->image }}">
                        <div class="hero__text">
                            <span>{{ $item->category->cat_name }}</span>
                            <h2>
                                {{ $item->title }}
                            </h2>
                            <p>{{ $item->sub_title }}</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>

                @endforeach


            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">

                <div class="categories__slider owl-carousel">
                    @foreach ($products as $item)

                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('uploads/products/'.$item->image_one) }}">
                                <h5><a href="#">{{ $item->product_name }}</a></h5>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categories as $item)
                                <li data-filter=".{{ $item->cat_slug }}">{{ $item->cat_name }}</li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($products as $item)

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
                                <h5>&#2547;{{ $item->product_price }}</h5>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('frontend') }}/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('frontend') }}/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($products as $item)
                                <div class="latest-prdouct__slider__item">

                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height: 110px; width:110px;" src="{{ asset('uploads/products/'.$item->image_one) }}" alt="{{ $item->product_slug }}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $item->product_name }}</h6>
                                            <span>&#2547;{{ $item->product_price }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($top_products as $item)
                                <div class="latest-prdouct__slider__item">

                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height: 110px; width:110px;" src="{{ asset('uploads/products/'.$item->image_one) }}" alt="{{ $item->product_slug }}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $item->product_name }}</h6>
                                            <span>&#2547;{{ $item->product_price }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($review_products as $item)
                                <div class="latest-prdouct__slider__item">

                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height: 110px; width:110px;" src="{{ asset('uploads/products/'.$item->image_one) }}" alt="{{ $item->product_slug }}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $item->product_name }}</h6>
                                            <span>&#2547;{{ $item->product_price }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($blogs as $item)


                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img width="370px" height="266px" src="{{ asset('uploads/blogs') }}/{{ $item->thumbnail }}" alt="{{ $item->title }}">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i>

                                     {{ date('M d, Y', strtotime($item->created_at)) }}
                                </li>
                                <!--li><i class="fa fa-comment-o"></i> 5</li-->
                            </ul>
                            <h5><a href="{{ $item->slug }}">{{ $item->title }}</a></h5>
                            <p>
                                {!! substr($item->description, 0, 200) !!}
                            </p>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </section>
    <!-- Blog Section End -->

@endsection
