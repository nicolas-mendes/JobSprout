<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JobSprout</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
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
                    <img class="w-20" src="{{ Vite::asset('resources/images/logo.png') }}" alt="">
                </a>
            </div>

            <div class="justify-self-center space-x-6 font-semibold text-lg font-mont">
                <a href="/">Jobs</a>
                <a href="/salaries">Salaries</a>
                <a href="/companies">Companies</a>
            </div>

            <div class="justify-self-end">
                @auth
                    <div class="space-x-6 font-semibold text-md font-mont flex items-center">
                        <a href="/jobs/create">Post a Job</a>

                        <form method="POST" action="/logout">
                            @csrf
                            @method('DELETE')
                            <button>Log Out</button>
                        </form>
                    </div>
                @endauth

                @guest
                    <div class="space-x-6 font-semibold text-md font-mont">
                        <a href="/register">Sign Up</a>
                        <a href="/login">Log In</a>
                    </div>
                @endguest
            </div>

        </nav>

        <main class="mt-10 max-w-[986px] mx-auto pb-8 px-4">
            {{ $slot }}
        </main>
    </div>

</body>

</html>
