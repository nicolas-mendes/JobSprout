<x-layout>
    
    @isset($tag)
        <x-page-heading>Results for Tag: {{ $tag->title }} </x-page-heading>
    @else
        <x-page-heading>Results for: "{{ $q }}"</x-page-heading>
    @endisset
    
    
    
    <div class="space-y-6">
        @isset($jobs)
            @forelse ($jobs as $job)
                <x-job-card-wide :$job />
            @empty
                <p class="text-gray-500 text-lg justify-self-center mt-40">No jobs found matching your filter.</p>
            @endforelse

        @else
            @forelse ($employers as $employer)
                <x-company-card-wide :$employer />
            @empty
                <p class="text-gray-500 text-lg justify-self-center mt-40">No companies found matching your filter.</p>    
            @endforelse
        @endisset

    </div>
    <div class="mt-4">
        @isset($jobs)
            {{ $jobs->links() }}
        @else
            {{ $employers->links() }}
        @endisset
    </div>
</x-layout>