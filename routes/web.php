<?php

Route::get('/', function () {
    return view('app');
});

Route::group(['prefix' => 'api/'], function() {
    Route::resource('tasks', 'TasksController');
    Route::get('tasks/{id}/map', 'TasksController@map');

});
