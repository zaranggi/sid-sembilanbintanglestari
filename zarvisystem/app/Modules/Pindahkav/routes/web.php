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
    Route::get('pindahkav/preview/{id}', array('uses' => 'PindahkavController@preview')); 
    Route::get('pindahkav/tambah', array('uses' => 'PindahkavController@tambah')); 
    Route::get('pindahkav/listunit/{id}', array('uses' => 'PindahkavController@listunit')); 
    Route::post('pindahkav/unitdetail', array('before' => 'csrf', 'uses' => 'PindahkavController@unitdetail')); 
    Route::post('pindahkav/isikan', array('before' => 'csrf', 'uses' => 'PindahkavController@isikan')); 
    
    Route::get('pindahkav/setpindah/{id}', array('uses' => 'PindahkavController@setpindah')); 
    Route::resource('pindahkav', 'PindahkavController'); 
}); 