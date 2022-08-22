<?php


Route::group([ 'middleware' => ['web','auth'], ], function() {
    Route::post('hisabsen/preview', array('before' => 'csrf', 'uses' => 'HisabsenController@preview'));  
    Route::resource('hisabsen', 'HisabsenController');

});

