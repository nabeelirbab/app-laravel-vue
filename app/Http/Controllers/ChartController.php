<?php

namespace App\Http\Controllers;

use App\Release;
use Illuminate\Http\Request;
use App\Genre;
use App\Phase\Chart\Chart;
use App\Phase\Filter\Filter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class ChartController extends Controller
{   
    protected Chart $chart;
    protected Filter $filter;
    protected array $input;

    public function __construct(Request $request)
    {
        $this->input = $request->all();
    }

    private function reset()
    {
        $this->chart = new Chart(Release::class);
        $this->filter = new Filter($this->chart->get());
    }

    public function get($count = 7)
    {
        if (isset($this->input['classes']) && count($this->input['classes'])) {
            $classVal = $this->input['classes'][0]['val'];

            return Cache::remember('charts:'.$classVal.'.'.$count, now()->addHours(12), function () use ($classVal, $count) {
                return [
                    $classVal => $this->getForClass($classVal, $count)
                ];
            });

        }

        return Cache::remember('charts:'.$count, now()->addHours(12), function () use ($count) {
            return $this->getForAllClasses($count);
        });
    }

    private function getForClass($class, $count = null)
    {
        $this->reset();
        $this->filter->addClassFilter($class);

        if (isset($this->input['genres'])) {
            foreach ($this->input['genres'] as $genreFilter) {
                $genre = Genre::find($genreFilter['id']);
                $this->filter->addGenreFilter($genre);
            }
        }

        return $this->filter->get($count);
    }

    private function getForAllClasses($count = 12)
    {
        $items = Cache::remember('chart_items', now()->addDays(1), function () use ($count) {
            return [
                'album' => $this->getForClass('album', $count),
                'single' => $this->getForClass('single', $count),
                'ep' => $this->getForClass('ep', $count),
                'compilation' => $this->getForClass('compilation', $count),
                'sample' => $this->getForClass('sample', $count),
            ];
        });

        return $items;
    }
}
