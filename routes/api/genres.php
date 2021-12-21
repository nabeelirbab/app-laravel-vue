<?php

use App\Genre;

Route::get('/genres/{count?}', function ($count = 'all') {
    return Cache::remember('genres:'.$count, now()->addDays(14), function () use ($count) {
        if (!is_numeric($count) || $count == 'all') {
            //return Genre::all();
            return Genre::paginate(count(Genre::all()));
        }

        return Genre::paginate($count);
    });
});

Route::get('/genre/{genre}', function (Genre $genre) {
    $items = $genre->releases()->released()->paginate(20);
    //$items = Genre::all();

    return compact('genre', 'items');
});
