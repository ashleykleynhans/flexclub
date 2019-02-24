<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/events')->group(function () {
    Route::get('/', 'EventController@searchEvents');
});
