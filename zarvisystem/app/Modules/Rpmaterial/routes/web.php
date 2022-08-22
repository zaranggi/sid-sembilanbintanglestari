<?php


Route::group([ 'middleware' => ['web','auth'] ], function() { 

    Route::get('rpmaterial/detail/{id}', array('uses' => 'RpmaterialController@detail')); 
    Route::post('rpmaterial/listall', array('uses' => 'RpmaterialController@listall')); 
    Route::resource('rpmaterial', 'RpmaterialController');

});

