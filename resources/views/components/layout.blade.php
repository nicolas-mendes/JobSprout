<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HirePath</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-black text-white font-honk">

    <div class="px-10">
        <nav class="flex justify-between items-center py-3 border-b border-white/25">
            <div>
                <a href="">
                    <img class="w-20" src="{{ Vite::asset('resources/images/logo.png') }}" alt="">
                </a>
            </div>

            <div class="space-x-6 font-semibold text-lg font-mont">
                <a href="">Jobs</a>
                <a href="">Carrers</a>
                <a href="">Salaries</a>
                <a href="">Companies</a>
            </div>

            <div>
                <a href="">Post a Job</a>
            </div>
        </nav>
        
        <main class="mt-10 max-w-[986px] mx-auto pb-8 px-4">
            {{ $slot }}
        </main>
    </div>

</body>

</html>
