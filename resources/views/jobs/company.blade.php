<x-layout>
    <div class="flex items-center">
        <x-page-heading class="mx-auto">Jobs for Company: {{ $employer->name }}</x-page-heading>
        
        <x-employer-logo :width="120" :logo="$employer->logo"></x-employer-logo>
    </div>

    <div class="space-y-6 mt-12">
        @foreach ($jobs as $job)
            <x-job-card-wide :$job />
        @endforeach
    </div>
    <div class="mt-4">
        {{ $jobs->links() }}
    </div>
</x-layout>
