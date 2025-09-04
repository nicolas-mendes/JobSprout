<x-layout>
    <x-page-heading>Results for Tag: {{ $tag->title }} </x-page-heading>
    
    <div class="space-y-6">
        @foreach ($jobs as $job)
            <x-job-card-wide :$job />
        @endforeach
    </div>
    <div class="mt-4">
        {{ $jobs->links() }}
    </div>
</x-layout>