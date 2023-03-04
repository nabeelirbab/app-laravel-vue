<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Release;
use App\Track;
use App\Phase\Filter\Filter;
use App\Genre;

class SearchController extends Controller
{

    /**
     * 
     * Main Search
     * 
     */
    public function index(Request $request, $userPG = 1, $releasePG = 1, $trackPG = 1)
    {
        $validated = $request->validate([
            'term' => 'string|nullable',

            'genres' => 'array',
            'genres.*.id' => 'exists:genres,id',

            'classes' => 'array',
            'classes.*.val' => 'string',
            'classes.*.name' => 'string',

            'keys' => 'array',
            'keys.val' => 'string',
            'keys.name' => 'string',

            'bpm' => 'array'
        ]);

        if (auth()->user() && !$validated['term'] && !$validated['genres']) {
            $validated['genres'] = auth()->user()->interests;
        }

        $users = User::whereHas('roles', function ($q) use ($validated) {
            $q->whereIn('roles.name', ['pro', 'artist', 'admin', 'standard'])
                ->where(function ($q) use ($validated) {
                    $q->where('users.name', 'like', '%' . $validated['term'] . '%');
                });
        })->get();

        $releaseQuery = Release::with(['uploader', 'tracks.artist'])->where('status', 'live')
            ->where(function ($q) use ($validated) {
                $q->where('name', 'like', '%' . $validated['term'] . '%')
                    ->orWhereHas('uploader', function ($query) use ($validated) {
                        return $query->where('name', 'like', '%' . $validated['term'] . '%');
                    });
            });

        $releases = collect($releaseQuery
            ->get());

        $releaseIds = $releaseQuery->pluck("id")->toArray();
        $releaseNames = $releaseQuery->pluck("name")->toArray();
        $tracks = collect(Track::where('status', 'approved')
            ->where('name', 'like', '%' . $validated['term'] . '%')
            ->orWhereHas('artist', function ($query) use ($validated) {
                return $query->where('name', 'like', '%' . $validated['term'] . '%');
            })
            ->with(['release.image', 'artist'])
            ->whereHas('release', function ($query) {
                $query->statuslive();
            })
            ->where(function ($query) use ($releaseIds, $releaseNames) {
                $query->whereNotIn("release_id", $releaseIds)
                    ->orWhereNotIn("name", $releaseNames); // if related to selected release and name is same ignore the track
            })
            ->get());


        $filter = new Filter($releases);
        $trackfilter = new Filter($tracks);

        if (collect($validated['genres'])->isNotEmpty()) {
            foreach ($validated['genres'] as $genre) {
                $genreDetails = Genre::find($genre['id']);
                $filter->addGenreFilter($genreDetails);
                $trackfilter->addGenreFilter($genreDetails);
            }
        }

        if (collect($validated['classes'])->isNotEmpty()) {
            foreach ($validated['classes'] as $class) {
                $filter->addClassFilter($class['val']);
                $trackfilter->addClassFilter($class['val']);
            }
        }

        if (collect($validated['bpm'])->isNotEmpty()) {
            $filter->addBpmFilter($validated['bpm'][0], $validated['bpm'][1]);
            $trackfilter->addBpmFilter($validated['bpm'][0], $validated['bpm'][1]);
        }

        if (collect($validated['keys'])->isNotEmpty()) {
            $filter->addKeyFilter($validated['keys']);
            $trackfilter->addKeyFilter($validated['keys']);
        }

        $data = collect();

        // $data = $filter->get();
        // $data = $data->chunk(20);


        // if ($validated['term']) $data = $data->merge($users);

        // $data = $data->merge($trackfilter->get())->merge($filter->get());
        // dd($data);

        $userChunks = $users->chunk(7);
        $releaseChunks = $filter->get()->chunk(7);
        $trackChunks = $trackfilter->get()->chunk(7);

        // dd($trackChunks);

        if (isset($userChunks[$userPG - 1]) || isset($releaseChunks[$releasePG - 1]) || isset($trackChunks[$trackPG - 1])) {
            return ($request->get('newsearch') == 1) ? [
                'term' => !empty($validated['term']) ? $validated['term'] : '',
                'genres' => !empty($validated['genres']) ? $validated['genres'] : [],
                'classes' => !empty($validated['classes']) ? $validated['classes'] : [],
                'bpm' => !empty($validated['bpm']) ? $validated['bpm'] : [],
                'keys' => !empty($validated['keys']) ? $validated['keys'] : [],
                'users' => array_values($userChunks[$userPG - 1]->toArray()),
                'releases' => array_values($releaseChunks[$releasePG - 1]->toArray()),
                'tracks' => array_values($trackChunks[$trackPG - 1]->toArray()),
                'userChunkCount' => $userChunks->count(),
                'releaseChunkCount' => $releaseChunks->count(),
                'trackChunkCount' => $trackChunks->count(),
            ]
                : [
                    'users' => array_values($userChunks[$userPG - 1]->toArray()),
                    'releases' => array_values($releaseChunks[$releasePG - 1]->toArray()),
                    'tracks' => array_values($trackChunks[$trackPG - 1]->toArray()),
                    'userChunkCount' => $userChunks->count(),
                    'releaseChunkCount' => $releaseChunks->count(),
                    'trackChunkCount' => $trackChunks->count(),
                ];
        } else {
            return [];
        }
    }
}
