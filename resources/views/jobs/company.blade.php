<x-layout>
    <x-page-heading> Jobs for Company: {{ $employer->name }}</x-page-heading>



    <div class="flex justify-between items-start mt-10">
        <div>
            <h1 class="text-xl"><strong>Company E-Mail:</strong></h1> <a class="text-sprout" href="mailto:{{ $employer->email }}">{{ $employer->email }}</a>
            <h1 class="text-xl mt-2"><strong>About Company:</strong></h1> <p>{{ $employer->description }}</p>
        </div>
        <div class="mt-1">
            <x-employer-logo :width="120" :logo="$employer->logo"></x-employer-logo>
        </div>
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
