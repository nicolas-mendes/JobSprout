<x-layout>
    <div class="space-y-12">
        <section class="text-center pt-6">
            <h1 class="text-3xl font-bold font-mont">Let's Find your Next Job</h1>

            {{-- <form action="/search" class="mt-6">
                <input type="text" name="q" id="q" placeholder="Frontend Developer..." class="rounded-xl bg-white/15 border border-white/10 px-5 py-4 w-full max-w-3xl">
            </form> --}}
            <x-forms.form action="/search" class="mt-6">
                <div class="flex items-center bg-white/15 rounded-xl px-2 py-3 focus-within:ring-2 focus-within:ring-white/50 w-full max-w-3xl">

                    <select name="filter" class="">
                        <option value="job" class="text-black">Job</option>
                        <option value="tag" class="text-black">Tag</option>
                    </select>

                    <div class="h-6 w-px bg-white/25 mx-2"></div>
                    
                    <input type="hidden" name="search_type" value="jobs">
                    <input name="q" placeholder="Frontend Developer . . ."
                        class="bg-transparent flex-1 text-white placeholder:text-white/50 focus:outline-none">
                </div>
            </x-forms.form>

        </section>

        <section class="pt-4">
            <x-section-heading>Featured Jobs</x-section-heading>
            <div class="grid lg:grid-cols-3 gap-8 mt-8">
                @foreach ($featuredJobs as $job)
                    <x-job-card :$job />
                @endforeach
            </div>
        </section>


        <section>
            <x-section-heading>Tags</x-section-heading>
            <div class="flex mt-4 flex-wrap gap-x-1 gap-y-2">
                @foreach ($tags as $tag)
                    <x-tag :$tag />
                @endforeach


            </div>
        </section>

        <section>
            <x-section-heading>Recent Jobs</x-section-heading>
            <div class="mt-4 space-y-6">
                @foreach ($jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach
            </div>
            {{-- Pagination --}}
            <div class="mt-4">
                {{ $jobs->links() }}
            </div>
        </section>
    </div>
</x-layout>
