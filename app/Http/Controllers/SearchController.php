<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        $q = request()->input('q');
        $searchType = request()->input('search_type', 'jobs');

        if ($searchType === 'companies') {
            $employers = Employer::query()
                ->where('name', 'LIKE', '%' . $q . '%')
                ->simplePaginate(10)
                ->withQueryString();

            return view('results', [
                'employers' => $employers,
                'q' => $q
            ]);
        }

        $filter = request()->input('filter', 'job');
        $query = Job::query()->with(['employer', 'tags']);

        if ($filter === 'tag') {
            $query->whereHas('tags', function ($subQuery) use ($q) {
                $subQuery->where('title', 'LIKE', '%' . $q . '%');
            });
        } else {
            $query->where('title', 'LIKE', '%' . $q . '%');
        }

        $jobs = $query->simplePaginate(10)->withQueryString();

        return view('results', [
            'jobs' => $jobs,
            'q' => $q
        ]);
    }
}
