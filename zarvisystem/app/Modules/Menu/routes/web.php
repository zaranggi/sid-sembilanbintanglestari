<?php


Route::group([ 'middleware' => ['web','auth'], ], function() {

    Route::resource('menu', 'MenuController');

});

