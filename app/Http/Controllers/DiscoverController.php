<?php

namespace App\Http\Controllers;
use App\Track;
use App\Genre;
use App\Release;
use App\Phase\Filter\Filter;

class DiscoverController extends Controller
{
    protected $filter;

    public function get()
    {
        $this->filter = new Filter(Release::released()->with('uploader', 'image', 'tracks')->get());

        foreach (request('genres') as $genre) {
            $this->filter->addGenreFilter(Genre::find($genre['id']));
        }

        foreach (request('classes') as $class) {
            $this->filter->addClassFilter($class['val']);
        }

        foreach (request('filter') as $filter) {
            $this->filter->addFilterFilter($filter);
        }

        $bpm = request('bpm');
        $minbpm = $bpm[0];
        $maxbpm = $bpm[1];

        $this->filter->addBpmFilter($minbpm, $maxbpm);

        // $this->filter->addKeyFilter(request('keys'));

        return $this->filter->paginate();
    }
}
