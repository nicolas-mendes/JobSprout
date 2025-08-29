<x-layout>
    <x-page-heading>New Job</x-page-heading>
    <x-forms.form method="POST" action="/jobs">
        <x-forms.input label="Title" name="title" placeholder="Astronaut" />
        <x-forms.input label="Salary" name="salary" type="number" min="0" step="0.01" placeholder="U$100,000.00"/>
        <x-forms.input label="Location" name="location" type="location" placeholder="Paris, France"/>

        <x-forms.select label="Schedule" name="schedule">
            <option> Full-Time</option>
            <option> Part-Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="https://url-for-your-actual-job/astronaut.com" />
        <x-forms.checkbox label="Feature (Extra Cost)" name="featured" />

        <x-forms.divider />

        <x-forms.textarea label="Description" name="description" placeholder="We are seeking adventurous individuals to join our elite corps of astronauts." />

        <x-forms.input label="TAGS (comma separated)" name="tags" placeholder="space, cientist, NASA"/>
    
        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
</x-layout>