<?php

use App\Genre;

Route::get('/samples/genre/{id}', function ($id) {
    $genre = Genre::find($id);
    $items = $genre->samples()->latest('release_date')->paginate(15);

    return compact('genre', 'items');
});
