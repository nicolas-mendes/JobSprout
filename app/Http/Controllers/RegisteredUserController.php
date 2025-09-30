<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // $userAttributes = $request->validate([
        //     "name" => ['required','max:255'],
        //     "email" => ['required','email','max:255','unique:users,email'],
        //     "password" => ['required','confirmed', Password::default()],
        // ]);
        
        // $employerAttributes = $request->validate([
        //     "employer" => ['required','max:255'],
        //     "logo" => ['required',File::types(['png','svg','jpg','jpeg','webp','gif'])],
        //     "employer_email" => ['nullable','email','max:255','unique:employers,email'],
        //     "description" => ['required','max:65535'],
        // ]);


        // $user = User::create($userAttributes);

        // $logoPath = $request->logo->store('logos', 'public');

        // $user->employer()->create([
        //     'name' => $employerAttributes['employer'],
        //     'email' => $employerAttributes['employer_email'] ?? $userAttributes['email'],
        //     'description' => $employerAttributes['description'],
        //     'logo' => $logoPath,
        // ]);

        // Auth::login($user);

        // return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
