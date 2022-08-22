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
    Route::post('gaji/simpan', array('before' => 'csrf', 'uses' => 'GajiController@simpan'));
    Route::get('gaji/detail/{periode}', array('before' => 'csrf', 'uses' => 'GajiController@detail')); 
    Route::resource('gaji', 'GajiController');

}); 
 