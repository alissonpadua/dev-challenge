<?php

Route::get('/', function () {
    return 'teste';
});

Route::group(['prefix' => 'seller'], function() {

  Route::get('{any}', function() {
    return view('home');
  })->where('any', '.*');

});