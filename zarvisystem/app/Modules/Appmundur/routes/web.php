<?php


Route::group([ 'middleware' => ['web','auth'], ], function() {
    Route::get('appmundur/approve/{id}', array('uses' => 'AppmundurController@approve')); 
    Route::get('appmundur/tolak/{id}', array('uses' => 'AppmundurController@tolak')); 
    Route::resource('appmundur', 'AppmundurController');

});

