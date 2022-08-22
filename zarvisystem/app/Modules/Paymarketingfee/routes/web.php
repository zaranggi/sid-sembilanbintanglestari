<?php


Route::group([ 'middleware' => ['web','auth'] ], function() {

    Route::get('paymarketingfee/cetak/{kode}', array('uses' => 'PaymarketingfeeController@cetak'));
    Route::post('paymarketingfee/simpanbayar', array('before' => 'csrf', 'uses' => 'PaymarketingfeeController@simpanbayar'));
    Route::resource('paymarketingfee', 'PaymarketingfeeController');

});

