<x-layout>
    <div class="space-y-12">
        <section class="text-center pt-6">
            <h1 class="text-3xl font-bold font-mont">Let's Find your Next Job</h1>

            {{-- <form action="/search" class="mt-6">
                <input type="text" name="q" id="q" placeholder="Frontend Developer..." class="rounded-xl bg-white/15 border border-white/10 px-5 py-4 w-full max-w-3xl">
            </form> --}}
            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="Frontend Developer..." class="bg-white/15 w-full max-w-3xl"/>
            </x-forms.form>

        </section>

        <section class="pt-8">
            <x-section-heading>Featured Jobs</x-section-heading>
            <div class="grid lg:grid-cols-3 gap-8 mt-8">
                @foreach ($featuredJobs as $job)
                    <x-job-card :$job />
                @endforeach
            </div>
        </section>


        <section>
            <x-section-heading>Tags</x-section-heading>
            <div class="mt-4 space-x-1">
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
        </section>
    </div>
</x-layout>
    