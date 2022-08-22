<?php



Route::group([ 'middleware' => ['web','auth'] ], function() {

    Route::post('appbebaslahan/simpan', array('before' => 'csrf', 'uses' => 'AppbebaslahanController@simpan'));
    Route::post('appbebaslahan/update', array('before' => 'csrf', 'uses' => 'AppbebaslahanController@update'));
    Route::get('appbebaslahan/detail/{id}', array('uses' => 'AppbebaslahanController@detail'));
    Route::get('appbebaslahan/doc/{id}', array('uses' => 'AppbebaslahanController@doc'));
    Route::post('appbebaslahan/uploaddoc', array('uses' => 'AppbebaslahanController@uploaddoc'));
    Route::resource('appbebaslahan', 'AppbebaslahanController');

    Route::get('appbebaslahan/approve/{id}', array('uses' => 'AppbebaslahanController@approve'));
    Route::get('appbebaslahan/reject/{id}', array('uses' => 'AppbebaslahanController@reject'));

});


