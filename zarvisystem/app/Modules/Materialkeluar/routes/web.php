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
	//Route::post('materialkeluar/unit/tambah', array('before' => 'csrf', 'uses' => 'MaterialkeluarController@unittambah')); 
	//Route::get('materialkeluar/unit/delete', array('uses' => 'MaterialkeluarController@unitdelete')); 
	
	Route::post('materialkeluar/unit/simpan', array('before' => 'csrf', 'uses' => 'MaterialkeluarController@unitsimpan')); 
	Route::post('materialkeluar/fasum/simpan', array('before' => 'csrf', 'uses' => 'MaterialkeluarController@fasumsimpan')); 
	Route::post('materialkeluar/revisi/simpan', array('before' => 'csrf', 'uses' => 'MaterialkeluarController@revisisimpan')); 
	
	Route::get('materialkeluar/listunit/{id}', array('uses' => 'MaterialkeluarController@listunit')); 
    Route::get('materialkeluar/fasum/', array('uses' => 'MaterialkeluarController@fasum'));
    Route::get('materialkeluar/unit/', array('uses' => 'MaterialkeluarController@unit'));
    Route::get('materialkeluar/revisi/', array('uses' => 'MaterialkeluarController@revisi'));
    Route::resource('materialkeluar', 'MaterialkeluarController');

});
  