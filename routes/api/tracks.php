<?php

use App\Track;

Route::get('/tracks/{count?}', function ($count = 15) {
	if (!is_numeric($count) || $count == 'all')
		return Track::where('status', 'approved')->whereHas('release', function($query) {
                    $query->statuslive();
            })->get();

	return Track::where('status', 'approved')->whereHas('release', function($query) {
                    $query->statuslive();
            })->paginate($count);
});

Route::get('/track/{track}', function (Track $track) {
	return $track->load([
		'preview', 'release', 'release.uploader', 'release.image', 'release.genres'
	]);
});
