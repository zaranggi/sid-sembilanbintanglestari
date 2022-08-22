<?php

Route::group([ 'middleware' => ['web','auth'], ], function() {

    Route::post('berkaskonsumen/suratnya', array('before' => 'csrf', 'uses' => 'BerkaskonsumenController@suratnya'));
    Route::post('berkaskonsumen/mykonsumen', array('before' => 'csrf', 'uses' => 'BerkaskonsumenController@mykonsumen'));
    Route::post('berkaskonsumen/simpangambar', array('before' => 'csrf', 'uses' => 'BerkaskonsumenController@simpangambar'));
    Route::post('berkaskonsumen/autocomplete', array('before' => 'csrf', 'uses' => 'BerkaskonsumenController@autocomplete'));
    Route::get('berkaskonsumen/data/{id}', array('uses' => 'BerkaskonsumenController@datakonsumen'));
    Route::get('berkaskonsumen/doc/{id}', array('uses' => 'BerkaskonsumenController@doc'));
    Route::resource('berkaskonsumen', 'BerkaskonsumenController');

});



