<?php


Route::group([ 'middleware' => ['web','auth'], ], function() {
    Route::get('appcuti/approve/{id}', array('uses' => 'AppcutiController@approve')); 
    Route::get('appcuti/tolak/{id}', array('uses' => 'AppcutiController@tolak')); 
    Route::resource('appcuti', 'AppcutiController');

});

