<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/events')->group(function () {
    Route::get('/', 'EventController@searchEvents');
    Route::get('/{event_uuid}', 'EventController@getEvent');
});

Route::prefix('/organizers')->group(function () {
    Route::get('/details/{organizer_uuid}', 'OrganizerController@getOrganizer');
});
