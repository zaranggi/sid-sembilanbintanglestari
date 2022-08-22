<?php


Route::group([ 'middleware' => ['web','auth'], ], function() {
    Route::get('appizin/approve/{id}', array('uses' => 'AppizinController@approve')); 
    Route::get('appizin/tolak/{id}', array('uses' => 'AppizinController@tolak')); 
    Route::resource('appizin', 'AppizinController');

});

