<x-layout>
    <x-page-heading>Register</x-page-heading>
    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
        <x-forms.input label="Name" name="name" />
        <x-forms.input label="E-mail" name="email" type="email"/>

        <x-forms.input label="Password" name="password" type="password" wire:model.live="password"/>

        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" wire:model.live="password_confirmation"/>

        <x-forms.divider />

        <x-forms.input label="Employer Name" name="employer" />
        <x-forms.input label="Employer Logo" name="logo" type="file"/>
        <x-forms.input label="Employer E-mail" name="employer_email" type="email" placeholder="Not Required: Personal e-mail by default"/>
        <x-forms.textarea label="Description" name="description" placeholder="We are seeking adventurous individuals to join our elite corps of astronauts." />

        <x-forms.button>Create Account</x-forms.button>
    </x-forms.form>
</x-layout>

