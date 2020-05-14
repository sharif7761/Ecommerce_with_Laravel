<?php

use Illuminate\Support\Facades\Route;

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


//frontend

    Route::get('/', 'HomeController@index');
    
    //show product by category and manu
    Route::get('/product_by_category/{category_id}', 'HomeController@product_by_category');
    Route::get('/product_by_manufacture/{manufacture_id}', 'HomeController@product_by_manufacture');
    Route::get('/view_product/{product_id}', 'HomeController@product_details_by_id');


    //cart
    Route::post('/add-to-cart', 'CartController@add_to_cart');
    Route::get('/show-cart', 'CartController@show_cart');
    Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
    Route::post('/update-cart', 'CartController@update_cart');

    //checkout
    Route::get('/login-check', 'CheckoutController@login_check');
    Route::get('/checkout', 'CheckoutController@checkout');
    Route::post('/save_shipping_details', 'CheckoutController@save_shipping_details');
    Route::get('/payment', 'CheckoutController@payment');
    //order
    Route::post('/place-order', 'CheckoutController@place_order');
    Route::get('/manage-order', 'CheckoutController@manage_order');
    Route::get('/view_order/{order_id}', 'CheckoutController@view_order');
    Route::get('/inactive_order/{order_id}', 'CheckoutController@inactive_order');
    Route::get('/active_order/{order_id}', 'CheckoutController@active_order');
    Route::get('/delete_order/{order_id}', 'CheckoutController@delete_order');

    
    //login,registration,logout
    Route::post('/customer-registration', 'CheckoutController@customer_registration');
    Route::post('/customer-login', 'CheckoutController@customer_login');
    Route::get('/customer_logout', 'HomeController@customer_logout');





//backend

    Route::get('/dashboard', 'SuperAdminController@index');
    Route::get('/logout', 'SuperAdminController@logout');
    Route::get('/admin', 'AdminController@index');
    Route::post('/admin-dashboard', 'AdminController@dashboard');


    //category

    Route::get('/add-category', 'CategoryController@index');
    Route::get('/all-category', 'CategoryController@all_category');
    Route::post('/save-category', 'CategoryController@save_category');
    Route::get('/inactive_category/{category_id}', 'CategoryController@inactive_category');
    Route::get('/active_category/{category_id}', 'CategoryController@active_category');
    Route::get('/edit_category/{category_id}', 'CategoryController@edit_category');
    Route::post('/update-category/{category_id}', 'CategoryController@update_category');
    Route::get('/delete_category/{category_id}', 'CategoryController@delete_category');

    //manufacture

    Route::get('/add-manufacture', 'ManufactureController@index');
    Route::post('/save-manufacture', 'ManufactureController@save_manufacture');
    Route::get('/all-manufacture', 'ManufactureController@all_manufacture');
    Route::get('/inactive_manufacture/{manufacture_id}', 'ManufactureController@inactive_manufacture');
    Route::get('/active_manufacture/{manufacture_id}', 'ManufactureController@active_manufacture');
    Route::get('/edit_manufacture/{manufacture_id}', 'ManufactureController@edit_manufacture');
    Route::post('/update-manufacture/{manufacture_id}', 'ManufactureController@update_manufacture');
    Route::get('/delete_manufacture/{manufacture_id}', 'ManufactureController@delete_manufacture');


    //products
    Route::get('/add-product', 'ProductController@index');
    Route::post('/save-product', 'ProductController@save_product');
    Route::get('/all-product', 'ProductController@all_product');
    Route::get('/inactive_product/{product_id}', 'ProductController@inactive_product');
    Route::get('/active_product/{product_id}', 'ProductController@active_product');
    Route::get('/delete_product/{product_id}', 'ProductController@delete_product');



    //slider
    Route::get('/add-slider', 'SliderController@index');
    Route::post('/save-slider', 'SliderController@save_slider');
    Route::get('/all-slider', 'SliderController@all_slider');
    Route::get('/inactive_slider/{slider_id}', 'SliderController@inactive_slider');
    Route::get('/active_slider/{slider_id}', 'SliderController@active_slider');
    Route::get('/delete_slider/{slider_id}', 'SliderController@delete_slider');

