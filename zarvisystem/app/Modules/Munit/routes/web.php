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
Route::group([ 'middleware' => ['web','auth'], ], function() {
    
    Route::post('munit/simpangambar', array('before' => 'csrf', 'uses' => 'MunitController@simpangambar')); 
    Route::post('munit/saveadd', array('before' => 'csrf', 'uses' => 'MunitController@saveadd')); 
    Route::post('munit/saveedit', array('before' => 'csrf', 'uses' => 'MunitController@saveedit')); 
    Route::get('munit/tambah/{id}', array('uses' => 'MunitController@tambah')); 
    Route::get('munit/unit/{id}', array('uses' => 'MunitController@unit')); 
    Route::resource('munit', 'MunitController');

});

