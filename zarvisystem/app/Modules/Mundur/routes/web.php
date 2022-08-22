<?php


Route::group([ 'middleware' => ['web','auth'] ], function() { 
    
    Route::post('mundur/isikan', array('before' => 'csrf', 'uses' => 'MundurController@isikan')); 
    Route::post('mundur/autocomplete', array('before' => 'csrf', 'uses' => 'MundurController@autocomplete')); 
    Route::resource('mundur', 'MundurController');

});

