<?php



Route::group([ 'middleware' => ['web','auth'] ], function() {

    Route::post('bebaslahan/simpan', array('before' => 'csrf', 'uses' => 'BebaslahanController@simpan'));
    Route::post('bebaslahan/update', array('before' => 'csrf', 'uses' => 'BebaslahanController@update'));
    Route::get('bebaslahan/detail/{id}', array('uses' => 'BebaslahanController@detail')); 
    Route::get('bebaslahan/doc/{id}', array('uses' => 'BebaslahanController@doc')); 
    Route::post('bebaslahan/uploaddoc', array('uses' => 'BebaslahanController@uploaddoc')); 
    Route::resource('bebaslahan', 'BebaslahanController');

});


