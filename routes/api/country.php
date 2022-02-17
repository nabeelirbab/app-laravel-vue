<?php 

Route::get('/countries', function () {
    return \DB::table("countries")->distinct("iso_code")->get();
});