<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __invoke(Tag $tag)
    {   
        $jobs = $tag->jobs() 
                    ->with(['employer', 'tags'])
                    ->latest()
                    ->simplePaginate(10);

       return view('results',[
        'jobs' => $jobs,
        'tag' => $tag,
        ]);
    }
}
