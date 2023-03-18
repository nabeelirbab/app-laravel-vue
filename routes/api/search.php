<?php

use App\Phase\Filter\Filter;
use App\Release;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// Route::post('/search/{userPG?}/{releasePG?}/{trackPG?}', 'SearchController@index');
Route::post('/search/user/{userPG?}', 'SearchController@user');
Route::post('/search/release/{releasePG?}', 'SearchController@release');
Route::post('/search/track/{trackPG?}', 'SearchController@track');
