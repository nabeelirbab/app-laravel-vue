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
    //wip
    // return 'asdf';
    return News::published()
        ->with([
            'image',
            'user' => function ($q) {
                $q->select('id', 'name', 'first_name', 'last_name');
            },
        ])
        ->withCount('comments', 'likes', 'shares')
        ->paginate($count);
    // return paginateOrAll(News::published(), $count);
    // });
});

Route::get('/news/article/{id}', function ($identifier) {
    if (is_numeric($identifier)) {
        return News::findOrFail($identifier);
    }

    return News::where('path', $identifier)->first();
});
