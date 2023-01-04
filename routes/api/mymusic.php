<?php

Route::prefix('mymusic')/*->middleware('auth')*/->group(function () {
    Route::get('/{user_id?}', 'APIMyMusicController@getMyMusic');
    Route::get('/uploaded/{user_id}', 'APIMyMusicController@getUploadedMusic');
    Route::get('/download/{format}/{trackid}', 'APIMyMusicController@downloadTrack');
    //Route::get('/stream/{trackid}', 'APIMyMusicController@streamTrack');
});
