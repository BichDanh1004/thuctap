<?php

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


Route::get('home', [
	'as'=>'home',
	'uses'=>'PageController@home'
]);
Route::get('productdetail/{id}','ProductController@productdetail');
Route::get('product/{id}','ProductController@product');

//đăng ký
Route::get('register','UserController@register');
Route::post('checkregister','UserController@checkregister');

// đăng nhập
Route::get('login','UserController@login');
Route::post('checklogin','UserController@checkLogin');
//đăng xuất.
Route::get('logout','UserController@logout');

//tìm kiếm
Route::get('search','UserController@search');

//cart
Route::get('cart','CartController@cart');
Route::get('add-to-cart/{id}',[
	'as'=>'themgiohang',
	'uses'=>'CartController@Addcart'
]);
Route::get('delete_cart/{id}',[
	'as'=>'xoagiohang',
	'uses'=>'CartController@deletecart'
]);
Route::get('lien-he',[
	'as'=>'getlienhe',
	'uses'=>'PageController@getlienhe'
]);
Route::post('lien-he',[
	'as'=>'postlienhe',
	'uses'=>'PageController@postlienhe'
]);
//bill
Route::get('show','BillController@show');
Route::post('billdetail','BillController@billdetail');
//admin
Route::group(['prefix'=> "admin"],function(){
	Route::group(['prefix' => 'user'], function(){
		Route::get('create','UserController@create');
		Route::post('create','UserController@store');

		Route::get('edit/{id}','UserController@edit');
		Route::post('edit/{id}','UserController@update');

		Route::get('index','UserController@index');

		Route::get('show/{id_user}','UserController@show');

		Route::get('delete/{id_user}','UserController@destroy');
	});
	Route::group(['prefix' => 'type'], function(){
		Route::get('create',['as'=>'admin.type.getcreatetype','uses'=>'ProductTypeController@create']);
		Route::post('create',['as'=>'admin.type.postcreatetype','uses'=>'ProductTypeController@store']);
		Route::get('edit/{id_product_type}','ProductTypeController@edit');
		Route::post('edit/{id_product_type}','ProductTypeController@update');
		Route::get('index','ProductTypeController@index');
		Route::get('delete/{id_product_type}','ProductTypeController@destroy');
		
	});
	Route::group(['prefix' => 'product'], function(){
		Route::get('create','ProductController@create');
		Route::post('create','ProductController@store');
		Route::get('edit/{id_product}','ProductController@edit');
		Route::post('edit/{id_product}','ProductController@update');
		Route::get('index','ProductController@index');
		Route::get('show','ProductController@show');
	});
	
    Route::group(['prefix' => 'images'], function() {
     
        Route::get('create/{id_product}','PageController@create')->name('images.create');
        Route::post('{id_product}','PageController@store')->name('images.store');
        
        Route::delete('{id_image}','PageController@destroy')->name('images.destroy');
    });

	Route::group(['prefix' => 'bill'], function(){
		Route::get('index','BillController@index');
		Route::get('showbill','BillController@showbill');
		
});
Route::group(['prefix' => 'login'], function(){
		Route::get('/','UserController@getLogin');	
});
		
});

