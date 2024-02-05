<div class="container">

</div>
{{-- resources/views/about.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>A propos - BX Cars</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@600&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IM+Fell+Double+Pica+SC&family=Inter&family=Koulen&family=League+Gothic&family=Lobster&family=Playfair+Display+SC&family=Saira+Condensed:wght@600&family=Saira+Stencil+One&family=Waterfall&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    @vite('resources/css/app.css')
</head>

<body>
    <header class="flex flex-col min-h-screen">
        <section class="relative min-h-screen text-white bg-red-500 mb-60"
            style="background-image: url('{{ asset('aboutbg.jpg') }}'); background-size: cover; background-position: center top; background-repeat: no-repeat;">


            <nav class="flex flex-row justify-between py-8 lg:px-20">
                <div class="space-y-2">
                    <div class="w-8 h-0.5 bg-white"></div>
                    <div class="w-8 h-0.5 bg-white"></div>
                    <div class="w-8 h-0.5 bg-white"></div>
                </div>
                <a href="/" class="text-3xl text-white uppercase logo ml-20">bxcars</a>
            </nav>
            <section class="px-32 py-32">
                <h1 class="text-5xl font-semibold text-center">À propos de nous</h1>
                <h3 class="mt-4 text-lg text-center lg:px-56">
                    Avec une passion débordante pour l'automobile et l'entrepreneuriat, Yassine Cherradi Ben Naji a
                    fondé BX Cars pour révolutionner l'expérience de location de véhicules. Fort d'une expérience riche
                    en gestion d'entreprise, il pilote la stratégie globale de l'agence, veillant à offrir un service
                    exceptionnel à chaque client. C'est ainsi qu'il ouvre les portes de BX Cars le 1e juin 2023.
                </h3>

                <div class="flex flex-row items-center justify-center mt-16 gap-10">
                    <div class="flex flex-col gap-8">
                        <div class="flex flex-row items-center gap-4 p-8 border-2 border-gray rounded-3xl ">
                            <div class="flex items-center px-4 bg-gray-200 rounded-xl">
                                <img src="/avatar.png" alt="avatar icon" class="icons-2 ">
                            </div>
                            <div class="flex flex-col w-full gap-4">
                                <h3 class="text-xl font-semibold">Yassine Cherradi Ben Naji</h3>
                                <p>Entrepreneur et fondateur de BX Cars</p>
                                <p>Langues : Arabe, français, néerlandais et anglais</p>
                            </div>
                        </div>
                        <div class="flex flex-row items-center gap-4 p-8 border-2 border-gray rounded-3xl ">
                            <div class="flex items-center px-4 bg-gray-200 rounded-xl">
                                <img src="/avatar.png" alt="avatar icon" class="icons-2 ">
                            </div>
                            <div class="flex flex-col gap-4">
                                <h3 class="text-xl font-semibold">Omar Ben Cheikh</h3>
                                <p>Gestionnaire de Parc Automobile et Responsable de flotte</p>
                                <p>Langues : Arabe</p>
                            </div>
                        </div>
                        <div class="flex flex-row items-center gap-4 p-8 border-2 border-gray rounded-3xl">
                            <div class="flex items-center px-4 bg-gray-200 rounded-xl">
                                <img src="/avatar.png" alt="avatar icon" class="icons-2 ">
                            </div>
                            <div class="flex flex-col gap-4">
                                <h3 class="text-xl font-semibold">Youssef El Alami Talbi</h3>
                                <p>Réceptionniste et Gestionnaire de contrats</p>
                                <p>Langues : Arabe</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-50 h-50 flex items-center justify-center overflow-hidden rounded-full">
                        <img src="/agence.jpg" alt="agency" class="object-cover w-full h-full">
                    </div>
                </div>
            </section>


    </header>
    <main>

    </main>

    <footer
        class="mt-0 flex flex-col items-center justify-between py-4 text-white border-t-2 border-gray-200 lg:px-12 lg:flex-row">
        <div>
            <h1 class="text-3xl uppercase logo">Bxcars</h1>
        </div>
        <div class="flex justify-between gap-4 ">
            <a href="/about" class="text-gray-300 transition-colors hover:text-white">About</a>
            <a href="/contact" class="text-gray-300 transition-colors hover:text-white">Contact</a>
        </div>

        <div class="flex flex-row gap-4">
            <div
                class="flex items-center justify-center w-8 h-8 transition-transform bg-gray-300 rounded-full hover:bg-gray-200 hover:scale-110">
                <img src="/instagram.svg" alt="instagram icon">
            </div>
            <div
                class="flex items-center justify-center w-8 h-8 transition-transform bg-gray-300 rounded-full hover:bg-gray-200 hover:scale-110">
                <img src="{{ asset('facebook.svg') }}" alt="">
            </div>
            <img src="" alt="">
        </div>
    </footer>
    <script>
        "@fontsource/lexend-tera";
    </script>
</body>

</html>