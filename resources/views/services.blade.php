<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Services | BX Cars</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('bxlogo-modified.png') }}">.
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">

    <style>
        .custom-font {
            font-family: 'Poppins';

        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
</head>

<body>
    <header>
        @if(session('success'))
        <div id="success-message" class="fixed top-0 left-0 right-0 bg-green-500 text-white text-center py-2 px-4 z-50">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function () {
                document.getElementById('success-message').style.display = 'none';
            }, 3000); 
        </script>
        @endif
        <div class="relative min-h-screen bg-black"
            style="background-image: url('{{ asset('wallpapertanger4.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div x-data="{ open: false }">
                <nav class="flex justify-between items-center py-8 px-4">
                    <button @click="open = !open" class="space-y-2 focus:outline-none">
                        <div class="w-8 h-0.5 bg-white"></div>
                        <div class="w-8 h-0.5 bg-white"></div>
                        <div class="w-8 h-0.5 bg-white"></div>
                    </button>
                    <!-- Logo -->
                    <a href="/" class="text-3xl uppercase logo text-white">bxcars</a>
                    <div>
                        @if(Route::has('login'))
                        @auth
                        <a class="text-white pr-2 hover:text-yellow-500" href="{{ url('/dashboard') }}"
                            style="cursor: pointer;">
                            ADMIN
                        </a>
                        <span class="text-white pr-2">
                            |
                        </span>
                        <span class="pr-4 text-white hover:text-yellow-500" style="cursor: pointer;"
                            onclick="window.location.href='{{ url('profile') }}'">{{ Auth::user()->name }}</span>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <img class="inline cursor-pointer h-7" src="{{ asset('logout.png') }}" alt="Déconnexion">
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endauth
                        @endif
                    </div>
                </nav>

                <!-- Menu déroulant -->
                <div class="absolute top-0 left-0 w-60 h-screen bg-black transform transition-transform duration-200"
                    :class="{'-translate-x-full': !open, 'translate-x-0': open}">
                    <button @click="open = false" class="p-4 text-white hover:text-red-400">
                        <img src="/close-menu-icon.png" alt="closing the menu button icon"
                            class="w-1/2 rounded-full h-1/2 ">
                    </button>
                    <div class="flex flex-col p-4">
                        <a href="{{ url('/') }}" class="py-2 text-white hover:text-yellow-500">Accueil</a>
                        <a href="{{ url('/services') }}"
                            class="py-2 text-yellow-500 border-b-2 border-gray-100">Services</a>
                        <a href="{{ url('/about') }}" class="py-2 text-white hover:text-yellow-500">À propos</a>
                        <a href="{{ url('/contact') }}" class="py-2 text-white hover:text-yellow-500">Contact</a>
                        @if(Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}"
                            class="py-2 text-gray-400 hover:text-yellow-500">Réservations</a>
                        <a href="{{ url('/membres') }}" class="py-2 text-gray-400 hover:text-yellow-500">Membres</a>
                        <a href="{{ url('/cars/create') }}" class="py-2 text-gray-400 hover:text-yellow-500">MyCARS</a>
                        <a href="{{ url('/user/create') }}" class="py-2 text-gray-400 hover:text-yellow-500">MyADMIN</a>
                        @endauth
                        @endif
                    </div>
                </div>
            </div>
            <h1 class="text-8xl mt-20 font-bold text-white text-center lg:px-32">
                SERVICES
            </h1>

            <h1 class="text-5xl mt-20 font-bold text-white text-center lg:px-32">
                Explorez la gamme complète de nos services dédiés à rendre votre expérience de location unique.
            </h1>
            <div class="min-h-screen flex flex-col items-center justify-center">
                <div class="bg-gray-800 text-white w-full md:w-2/3 lg:w-1/2 xl:w-1/3 mx-auto p-8 rounded-lg shadow-lg">
                    <h1 class="text-4xl font-bold text-center mb-4">Nos Services</h1>
                    <p class="text-xl text-center mb-8">Découvrez l'étendue de nos services sur mesure, conçus pour
                        transformer votre location en une expérience véritablement exceptionnelle.</p>

                    <!-- Services List -->
                    <div class="space-y-4">
                        <!-- Service 1 -->
                        <div
                            class="bg-white text-gray-800 p-4 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                            <h2 class="text-2xl font-semibold">Location courte et longue durée</h2>
                            <p>Que vous ayez besoin d'une voiture pour un jour, une semaine, ou un mois, nous
                                offrons des tarifs flexibles adaptés à vos besoins.</p>
                        </div>

                        <!-- Service 2 -->
                        <div
                            class="bg-white text-gray-800 p-4 rounded-lg  transition-transform duration-300 ease-in-out transform hover:scale-105">
                            <h2 class="text-2xl font-semibold">Livraison et récupération</h2>
                            <p>Profitez de nos services gratuits de livraison et récupération à l'aéroport, à
                                l'agence ou
                                à dans une autre ville au Maroc pour une expérience sans tracas.</p>
                        </div>

                        <!-- Service 3 -->
                        <div
                            class="bg-white text-gray-800 p-4 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                            <h2 class="text-2xl font-semibold">Assurance complète</h2>
                            <p>Tous nos véhicules sont couverts par une assurance complète pour vous garantir une
                                tranquillité d'esprit totale pendant la location.</p>
                        </div>

                        <!-- Service 4 -->
                        <div
                            class="bg-white text-gray-800 p-4 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                            <h2 class="text-2xl font-semibold">Sélection triée sur le volet</h2>
                            <p>Découvrez notre sélection soigneusement choisie de véhicules récents, couvrant vos
                                besoins essentiels depuis les citadines agiles et économiques jusqu'au confort d'un
                                SUV de luxe. Chacun de nos modèles est sélectionné pour offrir une expérience de
                                conduite exceptionnelle, adaptée à vos exigences de mobilité.</p>
                        </div>


                        <!-- Service 5 -->
                        <div
                            class="bg-white text-gray-800 p-4 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                            <h2 class="text-2xl font-semibold">Assistance routière 24/7</h2>
                            <p>Où que vous soyez, notre service d'assistance routière est disponible 24/7 pour vous
                                aider en cas de besoin.</p>
                        </div>

                        <!-- Additional Services -->
                        <p class="text-center mt-8 font-medium">Et bien plus encore... Découvrez tous nos services
                            en nous contactant ou en visitant notre agence!</p>
                    </div>
                </div>
            </div>
    </header>



    <footer class="flex flex-col text-white bg-black border-t-2 border-gray-200">
        <div class="flex flex-col lg:flex-row items-center justify-between py-4 lg:px-12 w-full">
            <div>
                <h1 class="text-3xl uppercase logo">Bxcars</h1>
            </div>
            <div class="flex justify-between gap-4">
                <a href="{{ url('/about') }}" class="text-gray-300 transition-colors hover:text-white">À propos</a>
                <a href="/contact" class="text-gray-300 transition-colors hover:text-white">Contact</a>
            </div>
            <div class="flex flex-row gap-4">
                <a href="https://www.instagram.com/bx_cars_rental/" target="_blank" rel="noopener noreferrer">
                    <div
                        class="flex items-center justify-center w-8 h-8 transition-transform bg-gray-300 rounded-full hover:bg-gray-200 hover:scale-110">
                        <img src="/instagram.svg" alt="instagram icon">
                    </div>
                </a>
                <a href="https://www.facebook.com/people/Bx-Cars/pfbid0K5HQSNgyJPMsKygqBWgqgy8Mtrr99SHEcJt2s2LckipK9GatJLFvcA8r6zeYxiFel/"
                    target="_blank" rel="noopener noreferrer">
                    <div
                        class="flex items-center justify-center w-8 h-8 transition-transform bg-gray-300 rounded-full hover:bg-gray-200 hover:scale-110">
                        <img src="{{ asset('facebook.svg') }}" alt="facebook icon">
                    </div>
                </a>
                <a href="https://www.snapchat.com/add/bxcars-tanger?share_id=HxAMeEKaQeY&locale=fr-BE" target="_blank"
                    rel="noopener noreferrer">
                    <div
                        class="flex items-center justify-center w-8 h-8 transition-transform bg-gray-300 rounded-full hover:bg-gray-200 hover:scale-110">
                        <img src="{{ asset('snapchat.svg') }}" alt="snapchat icon">
                    </div>
                </a>
            </div>
        </div>
        <!-- Utilisation de w-full pour assurer que le background jaune s'étende sur toute la largeur -->
        <div class="w-full text-sm text-center py-2 bg-yellow-500 custom-font">
            <p>MADE IT WITH PASSION ♥ ~ <a href="http://nawfelajari.be" class="text-white hover:text-gray-800"
                    target="_blank" rel="noopener noreferrer">NAWFEL AJARI</a> &#169; 2024</p>
        </div>
    </footer>

</body>

</html>