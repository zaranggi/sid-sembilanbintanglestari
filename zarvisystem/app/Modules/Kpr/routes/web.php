<?php

Route::group([ 'middleware' => ['web','auth'], ], function() {

    Route::post('kpr/update', array('before' => 'csrf', 'uses' => 'KprController@update'));   
    Route::post('kpr/mykonsumen', array('before' => 'csrf', 'uses' => 'KprController@mykonsumen'));  
    Route::post('kpr/autocomplete', array('before' => 'csrf', 'uses' => 'KprController@autocomplete'));
    Route::get('kpr/data/{id}', array('uses' => 'KprController@datakonsumen')); 
    Route::get('kpr/create/{id}', array('uses' => 'KprController@create')); 
    Route::resource('kpr', 'KprController');


});
 
 