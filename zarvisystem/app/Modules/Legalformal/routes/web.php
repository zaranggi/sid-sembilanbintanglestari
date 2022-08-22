<?php
Route::group([ 'middleware' => ['web','auth'] ], function() {
    
    Route::get('legalformal/data/{id}', array('uses' => 'LegalformalController@datalegalitas'));
    Route::get('legalformal/addnew/{id}', array('uses' => 'LegalformalController@addnew')); 
    Route::get('legalformal/editlegal/{id}', array('uses' => 'LegalformalController@editlegal')); 
    Route::resource('legalformal', 'LegalformalController');

});


 
