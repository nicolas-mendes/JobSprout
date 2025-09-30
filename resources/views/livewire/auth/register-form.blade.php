<x-forms.form wire:submit="register">

    <x-forms.input label="Nome" name="name" wire:model="name" />
    <x-forms.input label="E-mail" name="email" type="email" wire:model="email" />

    <x-forms.input label="Password" name="password" type="password" wire:model.live="password" />


    <div class="mt-2 space-y-1 text-sm">
        @if (!$passwordHasMinLength)
            <p class="text-gray-500">
                <span class="mr-2">•</span> Minimum of 8 characters
            </p>
        @endif
        @if (!$passwordHasUppercase)
            <p class="text-gray-500">
                <span class="mr-2">•</span> At least one uppercase (A-Z)
            </p>
        @endif
        @if (!$passwordHasLowercase)
            <p class="text-gray-500">
                <span class="mr-2">•</span> PAt least one lowercase (a-z)
            </p>
        @endif
        @if (!$passwordHasNumber)
            <p class="text-gray-500">
                <span class="mr-2">•</span> At least one number (0-9)
            </p>
        @endif
        @if (!$passwordHasSymbol)
            <p class="text-gray-500">
                <span class="mr-2">•</span> At least one symbol (ex: ! @ # $)
            </p>
        @endif
    </div>

    <x-forms.input label="Password Confirmation" name="password_confirmation" type="password"
        wire:model.live="password_confirmation" />

    @if (!empty($password_confirmation) && !$passwordsMatch)
        <div class="mt-2 space-y-1 text-sm">
            <p class="text-red-500">
                <span class="mr-2">✗</span> The Passwords does not match
            </p>
        </div>
    @endif

    <x-forms.divider />

    <x-forms.input label="Employer Name" name="employer" wire:model="employer" />
    <x-forms.input label="Employer Logo" name="logo" type="file" wire:model="logo" accept=".png,.svg,.jpg,.jpeg,.webp" />
    <x-forms.input label="Employer E-mail" name="employer_email" type="email"
        placeholder="Not Required: Personal e-mail by default" wire:model="employer_email" />
    <x-forms.textarea label="Description" name="description" placeholder="We are seeking adventurous individuals..."
        wire:model="description" />

    <x-forms.button>Create Account</x-forms.button>
</x-forms.form>