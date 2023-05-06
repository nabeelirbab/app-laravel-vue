<?php 

Route::get('/countries', function () {
    return \DB::table("countries")->where('status', 'active')->distinct("iso_code")->get();
});