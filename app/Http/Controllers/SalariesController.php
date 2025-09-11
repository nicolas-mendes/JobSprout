<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SalariesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = QueryBuilder::for(Job::class)
            ->with(['employer', 'tags'])
            ->allowedFilters([
                AllowedFilter::partial('title'),

                AllowedFilter::callback('min_salary', function ($query, $value) {
                    $query->where('salary', '>=', $value*1000);
                }),

                AllowedFilter::callback('max_salary', function ($query, $value) {
                    $query->where('salary', '<=', $value*1000);
                }),


                AllowedFilter::callback('tags_in', function ($query, $value) {
                    $tags = explode(',', $value);
                    $query->whereHas('tags', function ($subQuery) use ($tags) {
                        $subQuery->whereIn('title', $tags);
                    });
                }),
                
                AllowedFilter::callback('tags_ex', function ($query, $value) {
                    $tags = explode(',', $value);
                    $query->whereDoesntHave('tags', function ($subQuery) use ($tags) {
                        $subQuery->whereIn('title', $tags);
                    });
                }),
            ])
            ->latest()
            ->simplePaginate(10)
            ->withQueryString();

        return view('jobs.salaries', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
