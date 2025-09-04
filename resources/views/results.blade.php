<x-layout>
    
    @isset($tag)
        <x-page-heading>Results for Tag: {{ $tag->title }} </x-page-heading>
    @else
        <x-page-heading>Results for: "{{ $q }}"</x-page-heading>
    @endisset
    
    
    
    <div class="space-y-6">
        @foreach ($jobs as $job)
            <x-job-card-wide :$job />
        @endforeach
    </div>
    <div class="mt-4">
        {{ $jobs->links() }}
    </div>
</x-layout>