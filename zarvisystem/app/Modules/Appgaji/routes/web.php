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
    Route::get('appgaji/approve/{id}', array('uses' => 'AppgajiController@approve')); 
    Route::get('appgaji/reject/{id}', array('uses' => 'AppgajiController@reject')); 
    Route::get('appgaji/detail/{periode}', array('before' => 'csrf', 'uses' => 'AppgajiController@detail')); 
    Route::resource('appgaji', 'AppgajiController');

}); 
 