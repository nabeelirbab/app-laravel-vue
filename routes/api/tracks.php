<?php

use App\Track;

Route::get('/tracks/{count?}', function ($count = 15) {
	if (!is_numeric($count) || $count == 'all')
		return Track::where('status', 'approved')->whereHas('release', function ($query) {
			$query->statuslive();
		})->get();

	return Track::where('status', 'approved')->whereHas('release', function ($query) {
		$query->statuslive();
	})->paginate($count);
});

Route::get('/track/{track}', function (Track $track) {
	dd("treackajksnasjndjka");
	return $track->load([
		'preview', 'release', 'release.uploader', 'release.image', 'release.genres'
	]);
});


Route::get('price-ranges-for-tracks', function () {
	return [
		'single_track_price_from' => setting('single_track_price_from'),
		'single_track_price_to' => setting('single_track_price_to'),
		'album_price_from' => setting('album_price_from'),
		'album_price_to' => setting('album_price_to'),
	];
});
