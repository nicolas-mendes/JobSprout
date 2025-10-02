<x-layout>
    <x-page-heading>Register</x-page-heading>

    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">

        <x-forms.input label="Name" name="name" />

        <x-forms.input label="E-mail" name="email" type="email" />


        <x-forms.input label="Password" name="password" type="password" />

        <div id="password_rules" class="mt-2 space-y-1 text-sm text-red-500/50 hidden">
            <p id="length">✗ Minimum of 8 characters </p>
            <p id="uppercase">✗ At least one uppercase (A-Z) </p>
            <p id="lowercase">✗ At least one lowercase (a-z) </p>
            <p id="number">✗ At least one number (0-9) </p>
            <p id="symbol">✗ At least one symbol (ex: ! @ # $) </p>
        </div>


        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />

        <div class="mt-2 text-sm text-red-500/50">
            <p id="match" class="hidden"></p>
        </div>

        <x-forms.divider />

        <x-forms.input label="Employer Name" name="employer" />

        <x-forms.input label="Employer Logo" name="logo" type="file" accept=".png,.svg,.jpg,.jpeg,.webp"/>
        <div id="logo_rules" class="text-sm text-red-500/50 hidden">
            <p id="logo_rules_p"></p>
        </div>

        <x-forms.input label="Employer E-mail" name="employer_email" type="email"
            placeholder="Not Required: Personal e-mail by default" />

        <x-forms.textarea label="Description" name="description"
            placeholder="We are seeking adventurous individuals to join our elite corps of astronauts." />

        <x-forms.button>Create Account</x-forms.button>

    </x-forms.form>

    @push('scripts')
    @vite(['resources/js/auth/passwordVerification.js','resources/js/auth/fileVerification.js'])
    @endpush
</x-layout>
