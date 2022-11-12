<?php

use Illuminate\Http\Request;

Route::get('event/{user_id}/list', 'EventController@listForUser');
Route::get('event/{event_id}/get', 'EventController@get');
Route::prefix('event')->middleware('auth')->group(function () {
    Route::post('create', 'EventController@create');
    Route::post('{event_id}/update', 'EventController@update');
    Route::post('{event_id}/delete', 'EventController@delete');
});