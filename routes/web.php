<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
    Route::get('/', function () {
        return view('welcome');
    });
*/


Route::get('/', 'FrontendController@index');

/*
|------------------------------------
|           Backend route
|------------------------------------
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'AdminController@index');
Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin','Admin\LoginController@Login');

Route::get('admin/logout', 'AdminController@Logout')->name('admin.logout');

/*
|------------------------------------
|           Category route
|------------------------------------
*/

Route::get('admin/categories', 'Admin\CategoryController@index')->name('admin.category');
Route::post('admin/categories.store','Admin\CategoryController@store')->name('store.category');
Route::get('admin/categories/delete/{id}', 'Admin\CategoryController@delete')->name('delete-category');
Route::get('admin/categories/edit/{slug}', 'Admin\CategoryController@edit')->name('edit-category');
Route::post('admin/categories/update', 'Admin\CategoryController@update')->name('update.category');
Route::get('admin/categories/inactive/{id}', 'Admin\CategoryController@inactive')->name('inactive-category');
Route::get('admin/categories/active/{id}', 'Admin\CategoryController@active')->name('active-category');

/*
|------------------------------------
|           Brand route
|------------------------------------
*/

Route::get('admin/brands', 'Admin\BrandController@index')->name('admin.brand');
Route::post('admin/brands.store','Admin\BrandController@store')->name('store.brand');
Route::get('admin/brands/delete/{id}', 'Admin\BrandController@delete')->name('delete-brand');
Route::get('admin/brands/edit/{slug}', 'Admin\BrandController@edit')->name('edit-brand');
Route::post('admin/brands/update', 'Admin\BrandController@update')->name('update.brand');
Route::get('admin/brands/inactive/{id}', 'Admin\BrandController@inactive')->name('inactive-brand');
Route::get('admin/brands/active/{id}', 'Admin\BrandController@active')->name('active-brand');

/*
|------------------------------------
|           Products route
|------------------------------------
*/

Route::get('admin/products/add','Admin\ProductController@addProduct')->name('admin.add-product');
Route::post('admin/products.store','Admin\ProductController@store')->name('store.product');
Route::get('admin/products/manage','Admin\ProductController@manage')->name('admin.manage-product');
Route::get('admin/products/delete/{id}', 'Admin\ProductController@delete')->name('delete-product');
Route::get('admin/products/edit/{slug}', 'Admin\ProductController@edit')->name('edit-product');
Route::post('admin/products/update', 'Admin\ProductController@update')->name('update.product');
Route::get('admin/products/inactive/{id}', 'Admin\ProductController@inactive')->name('inactive-product');
Route::get('admin/products/active/{id}', 'Admin\ProductController@active')->name('active-product');
Route::post('admin/products/img-update', 'Admin\ProductController@updateImg')->name('update.image');

/*
|------------------------------------
|       Coupon route
|------------------------------------
*/

Route::get('admin/coupon', 'Admin\CouponController@index')->name('admin.coupon');
Route::post('admin/coupon.store','Admin\CouponController@store')->name('store.coupon');
Route::get('admin/coupon/inactive/{id}', 'Admin\CouponController@inactive')->name('inactive-coupon');
Route::get('admin/coupon/active/{id}', 'Admin\CouponController@active')->name('active-coupon');
Route::get('admin/coupon/delete/{id}', 'Admin\CouponController@delete')->name('delete-coupon');

/*
|------------------------------------
|       Orders route
|------------------------------------
*/

Route::get('admin/orders', 'Admin\OrderController@index')->name('admin.orders');
Route::get('admin/order/view/{id}', 'Admin\OrderController@orderView');
Route::post('admin/received_order', 'Admin\OrderController@receivedOrder')->name('received.order');
Route::get('admin/order/received/', 'Admin\OrderController@receivedList')->name('admin.receivedorders');

/** ======Slider====== **/


Route::get('admin/slider', 'Admin\SliderController@index')->name('admin.slider');
Route::get('admin/slider/add', 'Admin\SliderController@viewform')->name('admin.add_slider');
Route::post('admin/slider.store','Admin\SliderController@store')->name('store.slider');
Route::get('admin/slider/delete/{id}', 'Admin\SliderController@delete')->name('delete-slider');
Route::get('admin/slider/inactive/{id}', 'Admin\SliderController@inactive')->name('inactive-slider');
Route::get('admin/slider/active/{id}', 'Admin\SliderController@active')->name('active-slider');


/* ======= Blogs ======= */

Route::get('admin/blogs', 'Admin\BlogController@index')->name('admin.blog');
Route::get('admin/blogs/add', 'Admin\BlogController@viewform')->name('admin.add_blog');
Route::post('admin/blogs/new', 'Admin\BlogController@store')->name('store.blog');

Route::get('admin/blogs/delete/{id}', 'Admin\BlogController@delete')->name('delete-blogs');
Route::get('admin/blogs/inactive/{id}', 'Admin\BlogController@inactive')->name('inactive-blogs');
Route::get('admin/blogs/active/{id}', 'Admin\BlogController@active')->name('active-blogs');


/*
|------------------------------------
|           Frontend route
|------------------------------------
*/
Route::get('shop/', 'FrontendController@shop')->name('shoppage');



/* =========Details=========== */

Route::get('product/details/{slug}', 'FrontendController@details')->name('details');

/*============= Views Orders =============*/

Route::get('home/order/vieworder/{id}', 'OrderController@viewOrder')->name('views');


/*=============changePassword==============*/

Route::post('home/changepassword', 'UserController@changePassword')->name('changePassword');


/*======== Cart ==========*/
Route::get('shoping-cart/', 'CartController@index')->name('cart');
Route::post('add/to-cart/{id}', 'CartController@addToCart');
Route::get('remove/{id}', 'CartController@remove')->name('remove');
Route::post('shoping-cart/update/quantity/{id}', 'CartController@UpdateQty')->name('update.qty');
Route::post('shoping-cart/apply-coupon/','CartController@applyCoupon')->name('apply.coupon');
Route::get('shoping-cart/destroy-coupon/', 'CartController@destroyCoupon')->name('destroy.coupon');



/*======== wishlist ==========*/


Route::get('wishlist/', 'WishlistController@index')->name('wishlist');
Route::get('add/to-wishlist/{id}', 'WishlistController@addToWishlist')->name('addwishlist');
Route::get('remove-from-wishlist/{id}', 'WishlistController@remove')->name('remove-wish');


/*======== Check Out ==========*/
Route::get('checkout/', 'CheckoutController@index')->name('checkout');

/*======== place-order ==========*/
Route::post('place-order/', 'OrderController@storeOrder')->name('place-order');
Route::get('order/complete', 'OrderController@orderSuccess')->name('orderSuccess');


