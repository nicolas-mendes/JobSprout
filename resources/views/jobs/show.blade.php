<x-layout>
    <x-page-heading>
        {{ $job->title }}
    </x-page-heading>

    @if ($job->tags->isNotEmpty())
        <section>
            <h1 class="mt-5 text-xl"><strong>Tags:</strong></h1>
            <div class="flex mt-4 flex-wrap gap-x-1 gap-y-2">
                @foreach ($job->tags as $tag)
                    <x-tag :$tag />
                @endforeach
            </div>
        </section>
    @endif


    <div class="flex justify-between items-start mt-10">
        <div>
            <h1 class="text-xl"><strong>Job Link:</strong></h1> <a class="text-sprout" href="{{ $job->url }}">{{$job->url}}</a>
            <h1 class="mt-5 text-xl"><strong>Company:</strong></h1> <a class="text-sprout" href="/company/{{ $job->employer->id }}"> {{ $job->employer->name }}</a>
            <h1 class="mt-5 text-xl"><strong>Location:</strong></h1> <p> {{ $job->location }} </p>
            <h1 class="mt-5 text-xl"><strong>Schedule:</strong></h1> <p> {{ $job->schedule }} </p>
            <h1 class="mt-5 text-xl"><strong>Salary per Year:</strong></h1> <p>U$ {{ number_format($job['salary'], 2, '.', ' ') }}</p>
        </div>
        <div class="mt-1">
            <x-employer-logo :width="180" :logo="$job->employer->logo" class="justify-self-top"></x-employer-logo>
            @can('update', $job)
                <x-button :href="route('jobs.edit', $job)" class="bg-white/10 !py-2 !px-4 border border-white/15 mt-5 text-white/50"> Edit </x-button>
            @endcan
        </div>
    </div>
    <h1 class="my-5 text-xl"><strong>Description of the job:</strong></h1>
    <p>{{ $job['description'] }}</p>
</x-layout>
