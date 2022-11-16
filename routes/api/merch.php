<?php

Route::middleware('auth')->post('/merch', 'MerchController@store');
Route::get('/merch', 'MerchController@index');

Route::prefix('merch')->middleware('auth')->group(function () {
    Route::post('{merch_id}/delete', 'MerchController@delete');
});
