<x-layout>
    <x-page-heading>Advanced Job Search</x-page-heading>

    <x-panel class="mb-8">
        <x-forms.form method="GET" action="/salaries">
            <x-forms.input label="Title" name="filter[title]" placeholder="PHP Developer..."
                value="{{ request('filter.title') }}" />

            <div class="inline-flex items-center gap-x-2 mb-2">
                <span class="w-2 h-2 bg-white inline-block"></span>
                <p class="font-bold">Salary Filter</p>
            </div>
            <div class="flex justify-between gap-x-4">
                <div>
                    <label for="min_salary" class="block font-semibold text-white/85">Minimum</label>
                    <div class="mt-1 flex items-center gap-x-2">
                        <p class="text-gray-400">$</p>
                        <input type="text" name="filter[min_salary]" id="min_salary" placeholder="50"
                            value="{{ request('filter.min_salary') }}"
                            class="w-24 rounded-xl bg-white/10 border border-white/10 px-1 py-2 text-center">
                        <p class="text-gray-400">thousand p/year</p>
                    </div>
                </div>

                <div>
                    <label for="min_salary" class="block font-semibold text-white/85">Maximum</label>
                    <div class="mt-1 flex items-center gap-x-2">
                        <p class="text-gray-400">$</p>
                        <input type="text" name="filter[max_salary]" id="max_salary" placeholder="150"
                            value="{{ request('filter.max_salary') }}"
                            class="w-24 rounded-xl bg-white/10 border border-white/10 px-1 py-2 text-center">
                        <p class="text-gray-400">thousand p/year</p>
                    </div>
                </div>
            </div>

            <x-forms.input label="Tags Included" name="filter[tags_in]" placeholder="Laravel, PHP, API"
                value="{{ request('filter.tags_in') }}" />

            <div class="mt-4 flex justify-between gap-x-4">
                <a href="/salaries" class="bg-white rounded py-2 px-6 font-bold text-black">Clear</a>
                <x-forms.button>Filter</x-forms.button>
            </div>
        </x-forms.form>
    </x-panel>

    <div class="space-y-6 mt-18">
        @forelse ($jobs as $job)
            <x-job-card-wide :$job />
        @empty
            <p class="text-gray-500 text-lg justify-self-center mt-40">No jobs found matching your filter.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $jobs->links() }}
    </div>
</x-layout>
