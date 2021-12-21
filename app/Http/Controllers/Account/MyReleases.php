<?php

namespace App\Http\Controllers\Account;

use App\Release;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyReleases extends Controller
{
    public function index()
    {
        return paginateOrAll(Release::where('uploaded_by', Auth::id())->with('tracks', 'uploader'), 15, 'release_date');
    }

    public function update(Request $request, $release)
    {
        $release = Release::findOrFail($release);
        $release->status = $request->status;
        $release->save();

        return [
            'type' => 'success',
            'message' => "The Release status has been changed to $request->status",
        ];
    }

    public function destroy(Request $request, $release)
    {
        $release = Release::findOrFail($release);
        $release->delete();

        return [
            'type' => 'success',
            'message' => 'Release has been deleted',
        ];
    }
}
