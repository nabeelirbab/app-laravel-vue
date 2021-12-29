<?php

use App\News;
use App\Category;

Route::get('/news/category/{category}/{count?}', function ($category, $count = 15) {
    $articles = News::whereHas('categories', function ($q) use ($category) {
        $q->where('categories.path', '/' . $category);
    });
    return paginateOrAll($articles, $count);
});
Route::get('/news/{count?}', function ($count = 10) {
    // return Cache::remember('news:'.$count, now()->addHours(12), function () use ($count) {
    //FIXME: wip
    return News::published()
        ->with([
            'image',
            'user' => function ($q) {
                return $q->select('id', 'name', 'first_name', 'last_name', 'path');
            },
        ])
        ->withCount('comments', 'likes', 'shares')
        ->paginate($count);
    // return paginateOrAll(News::published(), $count);
    // });
});

Route::get('/news/article/{id}', function ($identifier) {
    if (is_numeric($identifier)) {
        return News::with('user', 'image')->findOrFail($identifier);
    }
    // FIXME: check all pages for this path
    return News::where('path', $identifier)->first();
});
