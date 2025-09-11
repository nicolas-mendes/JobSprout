<x-layout>
    
    @isset($tag)
        <x-page-heading>Results for Tag: {{ $tag->title }} </x-page-heading>
    @else
        <x-page-heading>Results for: "{{ $q }}"</x-page-heading>
    @endisset
    
    
    
    <div class="space-y-6">
        @isset($jobs)
            @foreach ($jobs as $job)
            <x-job-card-wide :$job />
            @endforeach
        @else
            @foreach ($employers as $employer)
                <x-company-card-wide :$employer />
            @endforeach
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