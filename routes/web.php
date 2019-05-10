<?php

Route::get('/', function () {
  return redirect('seller/dashboard');
});

Route::get('home', function () {
  return redirect('seller/dashboard');
});

Route::middleware(['auth'])->group(function () {

  Route::group(['prefix' => 'seller'], function() {

    Route::get('{any}', function() {
      return view('home');
    })->where('any', '.*');

  });

  Route::group(['prefix' => 'api/v1'], function() {

    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('seller', 'SellerController');
    Route::resource('client', 'ClientController');
    Route::resource('paymode', 'PaymodeController');

    Route::get('logout', 'SellerController@logout');

  });

});
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
