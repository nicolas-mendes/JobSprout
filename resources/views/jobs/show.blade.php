<x-layout>
    <x-page-heading>
        {{ $job->title }}
    </x-page-heading>
    <div class="flex justify-between items-center">
        <div>
            <h1 class="mt-5 text-xl"><strong>Job Link:</strong></h1> <a class="text-sprout" href="{{ $job->url }}">{{$job->url}}</a>
            <h1 class="mt-5 text-xl"><strong>Company:</strong></h1> <a class="text-sprout" href="/company/{{ $job->employer->id }}"> {{ $job->employer->name }}</a>
            <h1 class="mt-5 text-xl"><strong>Salary per Year:</strong></h1> <p>U$ {{ number_format($job['salary'], 2, '.', ' ') }}</p>
        </div>
        <div>
            <x-employer-logo :width="140" :logo="$job->employer->logo"></x-employer-logo>
            @can('update', $job)
                <x-button :href="route('jobs.edit', $job)" class="bg-white/25 border border-white/30 mt-5"> Edit </x-button>
            @endcan
        </div>
    </div>
    <h1 class="my-5 text-xl"><strong>Description of the job:</strong></h1>
    <p>{{ $job['description'] }}</p>
</x-layout>
