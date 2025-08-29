@props(['job'])
<x-panel class="flex flex-col text-center ">
    <div class="self-start text-sm">{{ $job->employer->name }}</div>

    <div class="py-4">
        <a href="{{ $job->url }}" class="text-xl group-hover:text-sprout font-bold transition-colors duration-300">{{ $job->title }}</a>
        <p class="text-sm mt-4">{{ $job->formatted_salary }}</p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
            @foreach ($job->tags as $tag)
                <x-tag :$tag size="small" />
            @endforeach
        </div>

        <x-employer-logo :width="42" :logo="$job->employer->logo"></x-employer-logo>
    </div>
</x-panel>
