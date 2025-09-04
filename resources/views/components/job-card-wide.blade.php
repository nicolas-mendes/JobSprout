@props(['job'])
<x-panel class="flex gap-x-6" >
    
    <x-employer-logo :width="90" :logo="$job->employer->logo"></x-employer-logo>

    <div class="flex-1 flex flex-col">
        <h3 class="self-start text-sm text-gray-400">{{ $job->employer->name }}</h3>
        <a href="/jobs/{{$job->id}}" class="font-bold text-xl mt-2.5 group-hover:text-sprout transition-colors duration-300">{{ $job->title }}</a>
        <p class="text-sm text-gray-400 mt-auto">{{ $job->formatted_salary }}</p>
    </div>

    <div>
        @foreach ($job->tags->take(6) as $tag)
            <x-tag :$tag />
        @endforeach
    </div>
</x-panel>  