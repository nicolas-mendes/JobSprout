<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JobSprout</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-black text-white font-honk">

    <div class="px-10">
        <nav class="grid grid-cols-3 items-center py-3 border-b border-white/25">

            <div class="justify-self-start">
                <a href="/">
                    <img class="w-20" src="{{ asset('images/logo.png') }}" alt="">
                </a>
            </div>

            <div class="justify-self-center space-x-6 font-semibold text-lg font-mont">
                <a href="/" class="text-white hover:text-sprout transition-colors duration-300">Jobs</a>
                <a href="/salaries" class="text-white hover:text-sprout transition-colors duration-300">Salaries</a>
                <a href="/companies" class="text-white hover:text-sprout transition-colors duration-300">Companies</a>
            </div>

            <div class="justify-self-end">
                @auth
                    <div class="space-x-6 font-semibold text-md font-mont flex items-center">
                        
                        <a href="/jobs/create" class="text-white hover:text-sprout transition-colors duration-300">Post a Job</a>

                        <form method="POST" action="/logout">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-300">Log Out</button>
                        </form>
                    </div>
                @endauth

                @guest
                    <div class="space-x-6 font-semibold text-md font-mont">
                        <a href="/register" class="text-white hover:text-blue-300 transition-colors duration-300">Sign Up</a>
                        <a href="/login" class="text-white hover:text-sprout transition-colors duration-300">Log In</a>
                    </div>
                @endguest
            </div>

        </nav>

        <main class="mt-10 max-w-[986px] mx-auto pb-8 px-4">
            {{ $slot }}
        </main>
    </div>
    
    @stack('scripts')
</body>

</html>
