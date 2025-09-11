<x-layout>
    <div class="space-y-12">
        <section class="text-center pt-6">
            <h1 class="text-3xl font-bold font-mont">Companies</h1>

            <x-forms.form action="/search" class="mt-6">
                <div class="flex items-center bg-white/15 rounded-xl px-2 py-3 focus-within:ring-2 focus-within:ring-white/50 w-full max-w-3xl">    
                <input type="hidden" name="search_type" value="companies">
                <input name="q" placeholder="Umbrella Corporation . . ."
                        class="bg-transparent flex-1 text-white placeholder:text-white/50 focus:outline-none">
                </div>
            </x-forms.form>

        </section>

        <section>
            <x-section-heading>Recent Companies</x-section-heading>
            <div class="mt-4 space-y-6">
                @foreach ($employers as $employer)
                    <x-company-card-wide :$employer />
                @endforeach
            </div>
            {{-- Pagination --}}
            <div class="mt-4">
                {{ $employers->links() }}
            </div>
        </section>
    </div>
</x-layout>
