<?php

namespace App\Phase\Filter;

use App\Genre;

use Log;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class Filter
 *
 * Given a collection of items, return a filtered collection where items conform to a set of specified filters.
 *
 * @package App\Phase\Filter
 */
class Filter
{
    private $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Get all items which remain after the filters have been added
     *
     * @param  null  $count
     *
     * @return mixed
     */
    public function get($count = null)
    {
        return ($count ? $this->items->take($count) : $this->items);
    }

    /**
     * Paginate the items which remain after the filters have been added
     *
     * @param  int  $perPage
     * @param  null  $page
     * @param  array  $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $this->items = $this->items instanceof Collection ? $this->items : Collection::make($this->items);

        return new LengthAwarePaginator(
            array_values($this->items->forPage($page, $perPage)->toArray()),
            $this->items->count(),
            $perPage,
            $page,
            $options
        );
    }

    /**
     * Remove all items which do not have the specified genre attached
     *
     * @param  Genre  $filterGenre
     *
     * @return $this
     */
    public function addGenreFilter(Genre $filterGenre)
    {
        $this->items = $this->items->filter(function ($item) use ($filterGenre) {
            $genreLists = (isset($item->release->genres)) ? $item->release->genres : (isset($item->genres) ? $item->genres : []);
            foreach ($genreLists as $genre) {
                if ($genre->id == $filterGenre->id) {
                    return true;
                }
            }
            return false;
        })->values();
        return $this;
    }

    /**
     * Remove all items which are not of the specified class (e.g. 'album', 'single' etc.)
     *
     * @param $filterClass
     *
     * @return $this
     */
    public function addClassFilter($filterClass)
    {
        $this->items = $this->items->filter(function ($item) use ($filterClass) {
            $className = isset($item->release->class) ? $item->release->class : $item->class;
            if ($className == Str::singular($filterClass)) { // Allow pluralised e.g. albums and album will both work
                return true;
            }
            return false;
        })->values();

        return $this;
    }

    /**
     * Remove all items which are not of the specified key (e.g. 'a', 'c+')
     *
     * @param $filterKey
     *
     * @return $this
     */
    public function addKeyFilter($filterKey)
    {

        $filterKey = collect($filterKey);
        $keyValues = [];
        foreach ($filterKey as $key) {
            $keyValues[] = $key['val'];
        }
        $this->items = $this->items->filter(function ($item) use ($keyValues) {
            if ($item->type == 'release') {
                foreach ($item->tracks as $track) {
                    if (in_array($track->key, $keyValues)) {
                        return true;
                    }
                }
            } else {
                if (in_array($item->key, $keyValues)) {
                    return true;
                }
            }
            return false;
        })->values();
        return $this;
    }

    /**
     * Remove all items which are not of the selected BPM
     *
     * @param $filterKey
     *
     * @return $this
     */
    public function addBpmFilter($minbpm, $maxbpm)
    {

        $this->items = $this->items->filter(function ($item) use ($minbpm, $maxbpm) {
            if (isset($item->bpm)) {
                if ($item->bpm >= $minbpm && $item->bpm <= $maxbpm) {
                    return true;
                }
            } else {
                foreach ($item->tracks as $track) {
                    if ($track->bpm >= $minbpm && $track->bpm <= $maxbpm) {
                        return true;
                    }
                }
            }

            return false;
        });
        return $this;
    }


    /**
     * Filter the items by the selected filter.
     *
     * @param $filter
     *
     * @return $this
     */
    public function addFilterFilter($filter)
    {
        switch (strtolower($filter)) {
            case 'latest':
                $this->items = $this->items->sortByDesc('release_date')->values();
                break;
            case 'popular':
                $this->items = $this->items->sortByDesc('score')->values();
                break;
            case 'labels':
                break;
            case 'producers':
                $this->items = $this->items->sortBy('uploaded_by')->values();
                break;
        }

        return $this;
    }
}
