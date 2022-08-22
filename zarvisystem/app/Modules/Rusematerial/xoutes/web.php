<?php


Route::group([ 'middleware' => ['web','auth'] ], function() { 

    Route::get('rusematerial/detail/{id}', array('uses' => 'RusematerialController@detail')); 
    Route::post('rusematerial/listall', array('uses' => 'RusematerialController@listall')); 
    Route::resource('rusematerial', 'RusematerialController');

});

