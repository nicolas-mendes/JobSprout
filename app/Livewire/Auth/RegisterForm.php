<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

use Livewire\Exceptions\FileUploadException;

use Livewire\Component;
use Livewire\WithFileUploads;

class RegisterForm extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $employer = '';
    public $logo;
    public string $employer_email = '';
    public string $description = '';

    public bool $passwordHasMinLength = false;
    public bool $passwordHasUppercase = false;
    public bool $passwordHasLowercase = false;
    public bool $passwordHasNumber = false;
    public bool $passwordHasSymbol = false;
    public bool $passwordsMatch = false;

    public function updatedLogo()
    {
        try {
            $this->validateOnly('logo', [
                'logo' => [
                    'required',
                    File::types(['png', 'svg', 'jpg', 'jpeg', 'webp', 'gif']),
                    'max:2048'
                ],
            ]);
        } catch (\Exception $e) {
            $this->addError('logo', 'The file is to large, the maximum size is 2MB');
            $this->logo = null;
        }
    }

    public function updatedPassword($value)
    {
        $this->checkPasswordStrength($value);
        $this->checkIfPasswordsMatch();
    }

    public function updatedPasswordConfirmation($value)
    {
        $this->checkIfPasswordsMatch();
    }

    private function checkPasswordStrength(string $password): void
    {
        $this->passwordHasMinLength = strlen($password) >= 8;
        $this->passwordHasUppercase = (bool) preg_match('/[A-Z]/', $password);
        $this->passwordHasLowercase = (bool) preg_match('/[a-z]/', $password);
        $this->passwordHasNumber    = (bool) preg_match('/[0-9]/', $password);
        $this->passwordHasSymbol    = (bool) preg_match('/[\W_]/', $password);
    }

    private function checkIfPasswordsMatch(): void
    {
        $this->passwordsMatch = !empty($this->password) && $this->password === $this->password_confirmation;
    }

    public function register()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'employer' => ['required', 'string', 'max:255'],
            'logo' => ['required', File::types(['png', 'svg', 'jpg', 'jpeg', 'webp', 'gif']),'max:2048' ],
            'employer_email' => ['nullable', 'email', 'max:255', 'unique:employers,email'],
            'description' => ['required', 'string', 'max:65535'],
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $logoPath = $this->logo->store('logos', 'public');

        $user->employer()->create([
            'name' => $this->employer,
            'email' => $this->employer_email ?: $this->email,
            'description' => $this->description,
            'logo' => $logoPath,
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
