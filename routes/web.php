<?php

Route::get('/', function () {
    return 'teste';
});

Route::group(['prefix' => 'seller'], function() {

  Route::get('{any}', function() {
    return view('home');
  })->where('any', '.*');

});

Route::group(['prefix' => 'api/v1'], function() {

  Route::resource('category', 'CategoryController');
  Route::resource('product', 'ProductController');

});