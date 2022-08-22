<?php


Route::group([ 'middleware' => ['web','auth'], ], function() {

    Route::resource('dockonsumen', 'DockonsumenController');

});

