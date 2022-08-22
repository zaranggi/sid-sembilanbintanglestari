<?php


Route::group([ 'middleware' => ['web','auth'], ], function() {

    Route::resource('hiscuti', 'HiscutiController');

});

