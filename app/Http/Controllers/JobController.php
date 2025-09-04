<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $featuredJobs = Job::latest()
        ->with(['employer', 'tags'])
        ->where('featured', true)
        ->take(6)
        ->get();

    
        $jobs = Job::latest()
        ->with(['employer', 'tags'])
        ->where('featured', false)
        ->simplePaginate(6);

    
        $tags = Tag::withCount('jobs')
        ->orderBy('jobs_count', 'desc')
        ->take(15)
        ->get();

        return view('jobs.index', [
        'featuredJobs' => $featuredJobs,
        'jobs'         => $jobs,
        'tags'         => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'title' => ['required','string','max:255'],
            'salary' => ['required','numeric','decimal:0,2','max:99999999.99'],
            'location' => ['required','string','max:255'],
            'schedule' => ['required', Rule::in(['Part-Time', 'Full-Time'])],
            'url' => ['required', 'active_url','max:255'],
            'description' => ['required','max:65535'],
            'tags' => ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if ($attributes['tags'] ?? false) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }

        return redirect("/jobs/$job->id");
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Job $job)
    {
        request()->validate([
            'title' => ['required','string','max:255','min:3'],
            'salary' => ['required','numeric','decimal:0,2'],
            'description' => ['required','string','max:65535']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
            'description' => request('description')
        ]);

        return redirect('/jobs/'.$job->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return view('jobs.index');
    }

}
