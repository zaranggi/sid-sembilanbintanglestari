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

Route::group([ 'middleware' => ['web','auth'] ], function() {

    Route::post('profile/ubah', array('before' => 'csrf','uses' => 'ProfileController@ubah'));
    Route::post('profile/updatequotes', array('before' => 'csrf','uses' => 'ProfileController@updatequotes'));
    Route::resource('profile', 'ProfileController');

});
