<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>

<body>
    <div class="h-screen bg-black text-white">
        <nav class="flex flex-row justify-between">

            <a href="/">bxcars</a>
            <button class=" border-2 border-red-600 rounded-lg">
                <a href="login">Login / Register</a>
            </button>
        </nav>

    </div>

</body>

</html>
