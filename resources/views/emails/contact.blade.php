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
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
</head>

<body>
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


    <header>
        <div class="relative min-h-screen bg-black"
            style="background-image: url('{{ asset('wallpapertanger3.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
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
                        <a href="{{ url('/services') }}" class="py-2 text-white hover:text-yellow-500">Services</a>
                        <a href="{{ url('/about') }}" class="py-2 text-white hover:text-yellow-500">À propos</a>
                        <a href="{{ url('/contact') }}"
                            class="py-2 text-yellow-500 border-b-2 border-gray-100">Contact</a>
                    </div>
                </div>



                <section>
                    <div class="min-h-screen flex flex-col justify-center items-center text-white ">
                        <div class="text-center">
                            <h1 class="text-7xl font-bold">CONTACTEZ-NOUS</h1>
                            <p class="text-4xl  mt-2 mb-10">
                                Assistance Immédiate – Parce que votre temps est précieux
                            </p>
                        </div>
                        <!-- Flex container pour le formulaire et les paragraphes avec espacement spécifié -->
                        <div class="flex flex-wrap justify-center items-start w-full mx-[-2px]">
                            <div class=" lg:mt-0 w-full lg:w-2/5 lg:ml-[2px]">
                                <div class=" story-section">
                                    <div class="story-content space-y-4">
                                        <p class="story-paragraph">Chez BX Cars, notre priorité est de vous fournir une
                                            expérience
                                            exceptionnelle, que ce soit à travers notre service client dédié, notre
                                            support
                                            technique pour vos réservations, ou notre assistance véhicule. Que vous ayez
                                            besoin
                                            d'aide pour naviguer dans nos services, de conseils pour choisir l'option
                                            qui
                                            vous
                                            convient le mieux, ou d'assistance technique, notre équipe est là pour vous.
                                            Notre
                                            objectif est de répondre à toutes vos questions et préoccupations avec
                                            rapidité
                                            et
                                            efficacité, garantissant ainsi votre entière satisfaction.</p>
                                        <p class="story-paragraph">Êtes-vous à la recherche d'une opportunité de
                                            carrière
                                            enrichissante au sein d'une entreprise dynamique et en pleine croissance ?
                                            BX
                                            Cars est
                                            constamment à la recherche de nouveaux talents pour rejoindre notre
                                            équipe. Que votre expertise réside dans le service à la clientèle, le
                                            support
                                            technique,
                                            la gestion de flotte, ou que vous souhaitiez nous proposer une compétence
                                            unique, nous
                                            serions ravis d'en savoir plus sur vous. BX Cars s'engage à créer un
                                            environnement de
                                            travail inclusif et stimulant, où chaque membre de l'équipe peut se
                                            développer
                                            professionnellement et contribuer à notre succès commun.</p>
                                    </div>
                                </div>

                            </div>
                            <div class="w-full lg:w-1/5 bg-gray-800 p-6 rounded-lg shadow-lg mt-20">
                                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                                    @csrf
                                    <div>
                                        <label for="email" class="block text-sm font-medium">Votre Email</label>
                                        <input type="email" id="email" name="email"
                                            class="mt-1 block w-full p-2 bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                            placeholder="nom@exemple.com" required>
                                    </div>
                                    <div>
                                        <label for="subject" class="block text-sm font-medium">Sujet</label>
                                        <select id="subject" name="subject"
                                            class="mt-1 block w-full p-2 text-gray-500 bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                            <option value="">Veuillez sélectionner</option>
                                            <option value="service_client">Service client</option>
                                            <option value="support_technique">Support technique - Réservation
                                            </option>
                                            <option value="support_vehicule">Support - Véhicule</option>
                                            <option value="recrutement">Recrutement</option>
                                            <option value="autre">Autre</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="message" class="block text-sm font-medium">Votre Message</label>
                                        <textarea id="message" name="message" rows="4"
                                            class="mt-1 block w-full p-2 bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50"
                                            placeholder="Tapez votre message ici..." required></textarea>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                            Envoyer le message
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>





    </header>

    <footer
        class="mt-0 flex flex-col items-center justify-between py-4 text-white border-t-2 border-gray-200 lg:px-12 lg:flex-row">
        <div>
            <h1 class="text-3xl uppercase logo">Bxcars</h1>
        </div>
        <div class="flex justify-between gap-4 ">
            <a href="/about" class="text-gray-300 transition-colors hover:text-white">À propos</a>
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
</body>

</html>