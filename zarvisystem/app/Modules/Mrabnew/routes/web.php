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

    Route::get('mrabnew/data/{id}', array('uses' => 'MrabnewController@data'));
    Route::get('mrabnew/settermin/{id}', array('uses' => 'MrabnewController@settermin'));
    Route::post('mrabnew/setterminsimpan', array('before' => 'csrf', 'uses' => 'MrabnewController@setterminsave'));
	Route::get('mrabnew/rabm/{id}', array('uses' => 'MrabnewController@rabm'));
    Route::get('mrabnew/view/{id}', array('uses' => 'MrabnewController@view'));
    Route::post('mrabnew/rabm/simpan', array('before' => 'csrf', 'uses' => 'MrabnewController@rabmsimpan'));
    Route::get('mrabnew/add/{id}', array('uses' => 'MrabnewController@add'));
    Route::get('mrabnew/ubah/{id}', array('uses' => 'MrabnewController@ubah'));
    Route::post('mrabnew/ubah/simpan', array('before' => 'csrf', 'uses' => 'MrabnewController@ubahsimpan'));
    Route::get('mrabnew/ajukan/{id_properti}/{id}', array('uses' => 'MrabnewController@ajukan'));
    Route::post('mrabnew/unitdetail', array('before' => 'csrf', 'uses' => 'MrabnewController@unitdetail'));

    Route::resource('mrabnew', 'MrabnewController');


});
