<x-layout>
    <div class="flex items-center">
        <x-page-heading class="mx-auto">Jobs for Company: {{ $employer->name }}</x-page-heading>
        <x-employer-logo :width="120" :logo="$employer->logo"></x-employer-logo>
    </div>

    <h1 class="text-xl font-bold">About Company:</h1>
    <div class="mt-5 ms-5">
        {{ $employer->description }}
    </div>

    <div class="space-y-6 mt-12">
        @forelse ($jobs as $job)
            <x-job-card-wide :$job />
        @empty
            <p class="text-gray-500 text-lg justify-self-center mt-40">No jobs have been posted by this company yet.</p>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $jobs->links() }}
    </div>
</x-layout>
