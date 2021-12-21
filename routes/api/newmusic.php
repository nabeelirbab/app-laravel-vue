<?php

use App\Track;

Route::get('/new-music/{count?}', function ($count = 100) {
    return Track::query()
        ->where('status', 'approved')
        ->take($count)
        ->orderByDesc('created_at')
        ->paginate(15);
});
