<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        $q = request()->input('q');
        $filter = request()->input('filter','job');

        $query = Job::query()->with(['employer', 'tags']);
        
       if ($filter === 'tag') {
            $query->whereHas('tags', function ($subQuery) use ($q) {
                $subQuery->where('title', 'LIKE', '%' . $q . '%');
            });
        } else {
            $query->where('title', 'LIKE', '%' . $q . '%');
        }

        $jobs = $query->simplePaginate(10)->withQueryString();

        return view('results', ['jobs' => $jobs, 'q' => $q]);
    }
}
