<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Http\Request;
use App\User;
use App\Release;
use App\Track;
use App\Phase\Filter\Filter;
use App\Genre;
use DB;
use Illuminate\Support\Arr;

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

    public function user(Request $request, $userPG = 1)
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

        $userChunks = $users->chunk(20);


        if (isset($userChunks[$userPG - 1])) {
            return ($request->get('newsearch') == 1) ? [
                'term' => !empty($validated['term']) ? $validated['term'] : '',
                'genres' => !empty($validated['genres']) ? $validated['genres'] : [],
                'classes' => !empty($validated['classes']) ? $validated['classes'] : [],
                'bpm' => !empty($validated['bpm']) ? $validated['bpm'] : [],
                'keys' => !empty($validated['keys']) ? $validated['keys'] : [],
                'users' => array_values($userChunks[$userPG - 1]->toArray()),
                'userChunkCount' => $userChunks->count(),
            ]
                : [
                    'users' => array_values($userChunks[$userPG - 1]->toArray()),
                    'userChunkCount' => $userChunks->count(),
                ];
        } else {
            return [];
        }
    }

    public function release(Request $request, $releasePG = 1)
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

        // $releaseQuery = Release::with(['uploader', 'tracks.artist'])->where('status', 'live')
        //     ->where(function ($q) use ($validated) {
        //         $q->where('name', 'like', '%' . $validated['term'] . '%')
        //             ->orWhereHas('uploader', function ($query) use ($validated) {
        //                 return $query->where('name', 'like', '%' . $validated['term'] . '%');
        //             });
        //     });

        // $releases = collect($releaseQuery
        //     ->get());
        // dd($releases);

        $releaseQuery = DB::table('releases')
            ->select(DB::raw('releases.*, tracks.id as track_ids,
             users.name as uploader_name, users.email as uploader_email, users.path as uploader_path
             '))
            ->join('users', 'releases.uploaded_by', '=', 'users.id')
            ->join('tracks', 'releases.id', '=', 'tracks.release_id')
            ->where('releases.status', '=', 'live')
            ->where('releases.deleted_at', '=', null)
            ->where(function ($q) use ($validated) {
                $q->where('releases.name', 'like', '%' . $validated['term'] . '%')
                    ->orWhere(function ($q2) use ($validated) {
                        $q2->where('users.name', 'like', '%' . $validated['term'] . '%')
                            ->where('users.id', '=', DB::raw('releases.uploaded_by'));
                    });
            })
            ->get()
            ->map(function ($release) {
                $tempRelease = Release::where('id', $release->id)->first();
                // dd($tempRelease->genres);
                // $release->image = Asset::with('files')->where('id', $release->image_id)->first();
                $release->type = 'release';
                if ($tempRelease) {
                    $release->image = $tempRelease->image;
                    $release->genres = $tempRelease->genres;
                    $release->is_liked = $tempRelease->is_liked;
                    $release->is_shared = $tempRelease->is_shared;
                    $release->is_recent = $tempRelease->is_recent;
                }
                $release->tracks = Track::where('release_id', $release->id)->get();
                $release->uploader = [
                    'name' => $release->uploader_name,
                    'email' => $release->uploader_email,
                    'path' => $release->uploader_path,
                ];
                unset(
                    $release->uploader_name,
                    $release->uploader_email,
                    $release->uploader_path,
                    $release->image->files,
                );
                return $release;
            });

        $filter = new Filter($releaseQuery);

        if (collect($validated['genres'])->isNotEmpty()) {
            foreach ($validated['genres'] as $genre) {
                $genreDetails = Genre::find($genre['id']);
                $filter->addGenreFilter($genreDetails);
            }
        }

        if (collect($validated['classes'])->isNotEmpty()) {
            foreach ($validated['classes'] as $class) {
                $filter->addClassFilter($class['val']);
            }
        }

        if (collect($validated['bpm'])->isNotEmpty()) {
            $filter->addBpmFilter($validated['bpm'][0], $validated['bpm'][1]);
        }

        if (collect($validated['keys'])->isNotEmpty()) {
            // dd($filter->addKeyFilter($validated['keys']));
            $filter->addKeyFilter($validated['keys']);
        }
        $releaseChunks = $filter->get()->chunk(20);

        if (isset($releaseChunks[$releasePG - 1])) {
            return ($request->get('newsearch') == 1) ? [
                'term' => !empty($validated['term']) ? $validated['term'] : '',
                'genres' => !empty($validated['genres']) ? $validated['genres'] : [],
                'classes' => !empty($validated['classes']) ? $validated['classes'] : [],
                'bpm' => !empty($validated['bpm']) ? $validated['bpm'] : [],
                'keys' => !empty($validated['keys']) ? $validated['keys'] : [],
                'releases' => array_values($releaseChunks[$releasePG - 1]->toArray()),
                'releaseChunkCount' => $releaseChunks->count(),
            ]
                : [
                    'releases' => array_values($releaseChunks[$releasePG - 1]->toArray()),
                    'releaseChunkCount' => $releaseChunks->count(),
                ];
        } else {
            return [];
        }
    }

    public function track(Request $request, $trackPG = 1)
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

        // $releaseQuery = Release::with(['uploader', 'tracks.artist'])->where('status', 'live')
        //     ->where(function ($q) use ($validated) {
        //         $q->where('name', 'like', '%' . $validated['term'] . '%')
        //             ->orWhereHas('uploader', function ($query) use ($validated) {
        //                 return $query->where('name', 'like', '%' . $validated['term'] . '%');
        //             });
        //     });

        // $releaseIds = $releaseQuery->pluck("id")->toArray();
        // $releaseNames = $releaseQuery->pluck("name")->toArray();
        // $tracks = collect(Track::where('status', 'approved')
        //     ->where('name', 'like', '%' . $validated['term'] . '%')
        //     ->orWhereHas('artist', function ($query) use ($validated) {
        //         return $query->where('name', 'like', '%' . $validated['term'] . '%');
        //     })
        //     ->with(['release.image', 'artist'])
        //     ->whereHas('release', function ($query) {
        //         $query->statuslive();
        //     })
        //     ->where(function ($query) use ($releaseIds, $releaseNames) {
        //         $query->whereNotIn("release_id", $releaseIds)
        //             ->orWhereNotIn("name", $releaseNames); // if related to selected release and name is same ignore the track
        //     })
        //     ->get());

        $releaseQuery = DB::table('releases')
            ->select(DB::raw('releases.*'))
            ->join('users', 'releases.uploaded_by', '=', 'users.id')
            ->where('releases.status', '=', 'live')
            ->where('releases.deleted_at', '=', null)
            ->where(function ($q) use ($validated) {
                $q->where('releases.name', 'like', '%' . $validated['term'] . '%')
                    ->orWhere(function ($q2) use ($validated) {
                        $q2->where('users.name', 'like', '%' . $validated['term'] . '%')
                            ->where('users.id', '=', DB::raw('releases.uploaded_by'));
                    });
            })
            ->get();

        $releaseIds = $releaseQuery->pluck("id")->toArray();
        $releaseNames = $releaseQuery->pluck("name")->toArray();
        $tracks =  DB::table('tracks')
            ->select(DB::raw('tracks.*, users.name as artist_name, users.email as artist_email, users.path as artist_path'))
            ->join('releases', 'tracks.release_id', '=', 'releases.id')
            ->join('users', 'tracks.uploaded_by', '=', 'users.id')
            ->where('tracks.status', 'approved')
            ->where('releases.status', 'live')
            ->where(function ($q) use ($validated) {
                $q->where('tracks.name', 'like', '%' . $validated['term'] . '%')
                    ->orWhere(function ($q2) use ($validated) {
                        $q2->where('users.name', 'like', '%' . $validated['term'] . '%');
                    });
            })
            ->where(function ($query) use ($releaseIds, $releaseNames) {
                $query->whereNotIn('tracks.release_id', $releaseIds)
                    ->orWhereNotIn('tracks.name', $releaseNames);
            })
            ->get()
            ->map(function ($track) {
                $tempTrack = Track::where('id', $track->id)->first();
                // $track->streamable = Asset::with('files')->where('id', $track->streamable_id)->first();
                $track->type = 'track';
                $track->streamable = $tempTrack->streamable;
                $track->is_liked = $tempTrack->is_liked;
                $track->is_shared = $tempTrack->is_shared;
                $track->is_recent = $tempTrack->is_recent;
                $track->release = Release::where('id', $track->release_id)->first();
                $track->artist = [
                    'name' => $track->artist_name,
                    'email' => $track->artist_email,
                    'path' => $track->artist_path,
                ];
                unset(
                    $track->artist_name,
                    $track->artist_email,
                    $track->artist_path,
                );
                return $track;
            });



        $trackfilter = new Filter($tracks);

        if (collect($validated['genres'])->isNotEmpty()) {
            foreach ($validated['genres'] as $genre) {
                $genreDetails = Genre::find($genre['id']);
                $trackfilter->addGenreFilter($genreDetails);
            }
        }

        if (collect($validated['classes'])->isNotEmpty()) {
            foreach ($validated['classes'] as $class) {
                $trackfilter->addClassFilter($class['val']);
            }
        }

        if (collect($validated['bpm'])->isNotEmpty()) {
            $trackfilter->addBpmFilter($validated['bpm'][0], $validated['bpm'][1]);
        }

        if (collect($validated['keys'])->isNotEmpty()) {
            $trackfilter->addKeyFilter($validated['keys']);
        }

        $trackChunks = $trackfilter->get()->chunk(20);

        // dd($trackChunks);

        if (isset($trackChunks[$trackPG - 1])) {
            return ($request->get('newsearch') == 1) ? [
                'term' => !empty($validated['term']) ? $validated['term'] : '',
                'genres' => !empty($validated['genres']) ? $validated['genres'] : [],
                'classes' => !empty($validated['classes']) ? $validated['classes'] : [],
                'bpm' => !empty($validated['bpm']) ? $validated['bpm'] : [],
                'keys' => !empty($validated['keys']) ? $validated['keys'] : [],
                'tracks' => array_values($trackChunks[$trackPG - 1]->toArray()),
                'trackChunkCount' => $trackChunks->count(),
            ]
                : [
                    'tracks' => array_values($trackChunks[$trackPG - 1]->toArray()),
                    'trackChunkCount' => $trackChunks->count(),
                ];
        } else {
            return [];
        }
    }
}
