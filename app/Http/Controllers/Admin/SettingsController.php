<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Meta;
use App\Page;
use App\Setting;

class SettingsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $settings = Setting::all()->keyBy('key');

        return view('admin.settings.edit')->with('settings', $settings);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validationMessages = [
            'single_track_price_from.lt' => 'From Price should be less than To Price',
            'single_track_price_to.gt' => 'To Price should be greater than From Price',
            'album_price_from.lt' => 'From Price should be less than To Price',
            'album_price_to.gt' => 'To Price should be greater than From Price',

            'single_track_price_from.numeric' => 'From Price should be numeric',
            'single_track_price_to.numeric' => 'To Price should be numeric',
            'album_price_from.numeric' => 'From Price should be numeric',
            'album_price_to.numeric' => 'To Price should be numeric'

        ];
        $validated = $request->validate([
            'title' => 'required|max:255',
            'logo_title' => 'required|max:255',
            'admin_email' => 'required|email|max:255',
            'wav_fee' => 'required|integer|min:0',
            'tax_rate' => 'required|numeric|min:0|max:1',
            'purchase_approval_threshold' => 'required|numeric|min:0',
            'banned_words' => 'required|string|max:255',
            'featured_spot_price' => 'required|numeric|min:0',

            'single_track_price_from' => 'required|numeric|min:0|lt:single_track_price_to',
            'single_track_price_to' => 'required|numeric|min:0|gt:single_track_price_from',
            'album_price_from' => 'required|numeric|min:0|lt:album_price_to',
            'album_price_to' => 'required|numeric|min:0|gt:album_price_from'
        ], $validationMessages);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back();
    }
}
