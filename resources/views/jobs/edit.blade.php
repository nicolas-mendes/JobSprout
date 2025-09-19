<x-layout>
    <x-page-heading>Edit Job</x-page-heading>
    <x-forms.form method="POST" :action="route('jobs.update', $job)">
        @method('PATCH')
        <x-forms.input label="Title" name="title" placeholder="Astronaut" :value="$job->title" />
        <x-forms.input label="Salary" name="salary" type="number" min="0" step="0.01" placeholder="U$100,000.00"
            :value="$job->salary" />
        <x-forms.input label="Location" name="location" type="location" placeholder="Paris, France" :value="$job->location" />

        <x-forms.select label="Schedule" name="schedule" :value="$job->schedule">
            <option> Full-Time</option>
            <option> Part-Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="https://url-for-your-actual-job/astronaut.com"
            :value="$job->url" />
        <x-forms.checkbox label="Feature (Extra Cost)" name="featured" :checked="$job->featured" />

        <x-forms.divider />

        <x-forms.textarea label="Description" name="description"
            placeholder="We are seeking adventurous individuals to join our elite corps of astronauts."
            :value="$job->description" />

        <x-forms.input label="TAGS (comma separated)" name="tags" placeholder="space, cientist, NASA"
            :value="$job->tags->pluck('title')->implode(', ')" />

        <div class="flex justify-between items-center">
            
            <form method="POST" action="{{ route('jobs.destroy', $job) }}">
                @csrf
                @method('DELETE')

                <x-forms.button
                    onclick="return confirm('Are you sure you want to permanently delete this job?')"
                    class="!bg-red-500">
                    Delete
                </x-forms.button>
            </form>

            <x-forms.button>Edit</x-forms.button>
        </div>

    </x-forms.form>
</x-layout>
