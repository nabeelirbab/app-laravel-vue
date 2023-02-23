<?php

use App\Phase\Filter\Filter;
use App\Release;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::post('/search/{userPG?}/{releasePG?}/{trackPG?}', 'SearchController@index');
