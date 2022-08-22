<?php


Route::group([ 'middleware' => ['web','auth'], ], function() {

    Route::resource('bank', 'BankController');

});

