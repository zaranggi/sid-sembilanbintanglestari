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

    Route::get('mrab/data/{id}', array('uses' => 'MrabController@data'));
    Route::get('mrab/settermin/{kode}', array('uses' => 'MrabController@settermin')); 
    Route::get('mrab/rabm/{kode}', array('uses' => 'MrabController@rabm'));  	
    Route::get('mrab/view/{id_properti}/{tipe_unit}/{kode}', array('uses' => 'MrabController@view'));  	
    Route::get('mrab/rabmhapus/{kode}', array('uses' => 'MrabController@rabmdelete'));  
    Route::post('mrab/rabm/simpan', array('before' => 'csrf', 'uses' => 'MrabController@rabmsimpan'));  
    Route::get('mrab/add/{id}', array('uses' => 'MrabController@add'));  
    Route::get('mrab/ubah/{kode}', array('uses' => 'MrabController@ubah'));
    Route::get('mrab/ajukan/{kode}', array('uses' => 'MrabController@ajukan'));
    Route::post('mrab/ubah/simpan', array('before' => 'csrf', 'uses' => 'MrabController@ubahsimpan'));  
    Route::post('mrab/unitdetail', array('before' => 'csrf', 'uses' => 'MrabController@unitdetail'));
    Route::get('mrab/hapus/{kode}}', array('uses' => 'MrabController@rabhapus'));	
    Route::post('mrab/settermin/simpan', array('before' => 'csrf', 'uses' => 'MrabController@setterminsave'));  
    Route::resource('mrab', 'MrabController');


});
  