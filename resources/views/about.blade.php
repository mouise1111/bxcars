<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>À propos | BX Cars</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('bxlogo-modified.png') }}">.

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@600&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IM+Fell+Double+Pica+SC&family=Inter&family=Koulen&family=League+Gothic&family=Lobster&family=Playfair+Display+SC&family=Saira+Condensed:wght@600&family=Saira+Stencil+One&family=Waterfall&display=swap"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .custom-font {
            font-family: 'Poppins';

        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #map {
            height: 90px;
            width: 100%;
        }
    </style>
</head>


<body
    style="background-image: url('{{ asset('wallpapertanger3.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <header>
        <div class="relative min-h-screen absolute -top-10">
            @if(session('success'))
            <div id="successMessage" class="bg-green-500 text-white text-center p-5 rounded mb-2">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function () {
                    document.getElementById('successMessage').style.display = 'none';
                }, 4000);
            </script>
            @endif
            <div x-data="{ open: false }">
                <nav class="flex justify-between items-center py-8 px-4">
                    <button @click="open = !open" class="space-y-2 focus:outline-none">
                        <div class="w-8 h-0.5 bg-white"></div>
                        <div class="w-8 h-0.5 bg-white"></div>
                        <div class="w-8 h-0.5 bg-white"></div>
                    </button>
                    <!-- Logo -->
                    <a href="/" class="text-3xl uppercase logo text-white">bxcars</a>
                    <div class="hidden sm:flex">
                        @if(Route::has('login'))
                        @auth
                        <a class="text-white pr-2 hover:text-yellow-500" href="{{ url('/dashboard') }}"
                            style="cursor: pointer;">ADMIN</a>
                        <span class="text-white pr-2">|</span>
                        <span class="pr-4 text-white hover:text-yellow-500" style="cursor: pointer;"
                            onclick="window.location.href='{{ url('profile') }}'">{{ Auth::user()->name }}</span>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <img class="inline cursor-pointer h-7" src="{{ asset('logout.png') }}" alt="Déconnexion">
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf
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
                            class="w-1/2 rounded-full h-1/2 w-8 h-8 mt-5">
                    </button>
                    <div class="flex flex-col p-4">
                        <a href="{{ url('/') }}" class="py-2 text-white hover:text-yellow-500">Accueil</a>
                        <a href="{{ url('/services') }}" class="py-2 text-white hover:text-yellow-500">Services</a>
                        <a href="{{ url('/about') }}" class="py-2 text-yellow-500 border-b-2 border-gray-100">À
                            propos</a>
                        <a href="{{ url('/contact') }}" class="py-2 text-white hover:text-yellow-500">Contact</a>
                        @if(Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}"
                            class="py-2 text-gray-400 hover:text-yellow-500">Réservations</a>
                        <a href="{{ url('/membres') }}" class="py-2 text-gray-400 hover:text-yellow-500">Membres</a>
                        <a href="{{ url('/cars/create') }}" class="py-2 text-gray-400 hover:text-yellow-500">MyCARS</a>
                        <a href="{{ url('/user/create') }}" class="py-2 text-gray-400 hover:text-yellow-500">MyADMIN</a>
                        <a href="{{ url('/profile') }}" class="sm:hidden py-2 text-gray-400 hover:text-yellow-500">Mon
                            compte</a>
                        <a href="#" class="sm:hidden py-2 text-gray-400 hover:text-yellow-500"
                            onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            <img class="inline cursor-pointer h-3" src="{{ asset('logout.png') }}" alt="Déconnexion">
                            Déconnexion
                        </a>
                        @endauth
                        @endif
                    </div>
                </div>
            </div>
            <h1
                class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl mt-10 md:mt-20 font-bold text-white text-center px-4 lg:px-32">
                À PROPOS
            </h1>

            <h1
                class="text-3xl sm:text-4xl md:text-5xl lg:text-5xl mt-10 md:mt-20 font-bold text-white text-center px-4 lg:px-32">
                Découvrez l'histoire derrière chaque Kilomètre avec BX Cars
            </h1>
            <div class="story-section mt-20 md:mt-40">
                <div class="story-content px-4 md:px-10 lg:px-20">
                    <p class="story-paragraph text-base sm:text-lg md:text-xl">
                        Dans l'effervescence de Bruxelles, une vision audacieuse prenait forme dans l'esprit d'un jeune
                        entrepreneur passionné par l'innovation et l'aventure. Yassine Cherradi Ben Naji, armé d'une
                        détermination sans faille et d'un amour profond pour sa ville natale, Tanger, a décidé de
                        transformer le paysage de la mobilité au Maroc. Son rêve? Fonder BX Cars, une entreprise
                        synonyme de qualité, d'innovation et de confiance.
                    </p>
                    <p class="story-paragraph text-base sm:text-lg md:text-xl mt-4">
                        Le voyage de Yassine n'a pas été sans embûches. Naviguant entre les défis bureaucratiques, la
                        recherche des partenariats stratégiques, et l'instauration d'une culture d'entreprise solide, il
                        a su avec brio poser les jalons d'une réussite remarquable. BX Cars n'est pas seulement une
                        entreprise; c'est le reflet d'une passion, d'une ambition et d'un engagement envers la qualité
                        et l'excellence.
                    </p>
                    <p class="story-paragraph text-base sm:text-lg md:text-xl mt-4">
                        BX Cars, c'est l'histoire d'un retour aux sources, transformé en quête de perfection. C'est là,
                        entre les ruelles chargées d'histoire de Tanger et le rythme effréné de Bruxelles, que Yassine a
                        tissé le fil d'une entreprise destinée à devenir une référence dans le monde de la location de
                        voitures. Rejoignez-nous pour un voyage exceptionnel, où tradition et modernité se rencontrent
                        pour donner vie à vos rêves d'évasion.
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="py-32 bg-gray-900 text-white">
            <div class="container mx-auto px-4">
                <h1 class="text-5xl font-semibold text-center">À propos de nous</h1>
                @if(Route::has('login'))
                @auth
                <div class="flex justify-center mt-6">
                    <a href="{{ url('/membres') }}"
                        class="bg-yellow-500 text-2xl text-white px-6 py-3 rounded transition duration-500 hover:bg-black">Gestion
                        de membres</a>
                </div>
                @endauth
                @endif
                <div class="mt-16 flex flex-col lg:flex-row items-center gap-10">
                    <!-- Membres -->
                    <div class="flex-1">
                        @foreach ($membres as $membre)
                        <div class="flex flex-row items-center gap-4 p-8 border-2 border-gray-300 rounded-3xl mb-4">
                            <div class="px-4">
                                <img src="/avatar.png" alt="Avatar" class="w-24 h-24 rounded-xl">
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold">{{ $membre->nom }}</h3>
                                <p>{{ $membre->fonction }}</p>
                                <p>Langues : {{ $membre->language }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Photo et Infos centrés dans leur conteneur -->
                    <div class="flex flex-col items-center flex-1 border-2 border-gray-500 rounded-xl p-4">
                        <div class="flex flex-col items-center">
                            <img src="/agence.jpg" alt="Agence" class="mb-8 rounded-full"
                                style="width: 250px; height: 250px;">
                            <div class="text-center">
                                <h2 class="text-2xl font-semibold mb-4">Contactez-nous</h2>
                                <p><strong>Adresse :</strong> 15 Rue Hay Beauséjour 1, Tanger (Maroc)</p>
                                <p><strong>Heures d'ouverture :</strong> Lun - Ven, 9h - 17h</p>
                                <p><strong>Email :</strong> info@bxcars.be</p>
                                <p><strong>Téléphone :</strong> +32 491 76 89 74</p>
                            </div>
                            <a href="{{ url('/contact') }}"
                                class="mt-5 inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">
                                Contactez-nous
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-16 md:py-32 bg-gray-900"
            style="background-image: url('/tangierview.jpg'); background-size: cover; background-position: center;">
            <h1 class="text-3xl md:text-5xl font-semibold text-center text-white">À propos de l'agence</h1>
            <div class="container mx-auto px-4 text-white md:px-8 lg:pl-20 lg:pr-20 mt-10 md:mt-20">
                <div class="mb-6 md:mb-10">
                    <h2 class="text-xl md:text-2xl font-semibold mb-3 md:mb-4">Histoire de l'Agence</h2>
                    <p class="text-md md:text-lg">
                        Fondée en 2023, BX Cars est née de la passion de Yassine Cherradi Ben Naji pour l'automobile et
                        l'entrepreneuriat. Notre agence a parcouru un long chemin, marqué par l'innovation et un
                        engagement inébranlable envers la qualité.
                    </p>
                </div>

                <div class="mb-6 md:mb-10">
                    <h2 class="text-xl md:text-2xl font-semibold mb-3 md:mb-4">Mission et Vision</h2>
                    <p class="text-md md:text-lg">
                        Notre mission est de révolutionner l'expérience de location de voitures au Maroc, en fournissant
                        un service exceptionnel, une flotte moderne et une flexibilité sans précédent. Visionnaires,
                        nous œuvrons pour devenir le leader marocain de la mobilité, en anticipant les besoins de nos
                        clients et en adoptant les technologies vertes.
                    </p>
                </div>

                <div class="mb-6 md:mb-10">
                    <h2 class="text-xl md:text-2xl font-semibold mb-3 md:mb-4">Valeurs et Philosophie</h2>
                    <p class="text-md md:text-lg">
                        L'intégrité, l'innovation et l'engagement client sont au cœur de tout ce que nous faisons. Nous
                        croyons en une approche éthique des affaires, en cultivant une culture d'entreprise positive et
                        en investissant dans notre communauté.
                    </p>
                </div>

                <div class="mb-6 md:mb-10">
                    <h2 class="text-xl md:text-2xl font-semibold mb-3 md:mb-4">Engagement envers les Clients et la
                        Communauté</h2>
                    <p class="text-md md:text-lg">
                        Chez BX Cars, chaque client est unique. C'est pourquoi nous offrons des services personnalisés
                        comme la prise de véhicule gratuite à l'aéroport, à l'agence ou dans n'importe quelle ville du
                        Maroc. Notre engagement s'étend à la communauté, à travers diverses initiatives écologiques et
                        sociales.
                    </p>
                </div>

                <hr class="my-6">

                <div class="text-center">
                    <h2 class="text-xl md:text-2xl font-semibold mb-3 md:mb-4 mt-6 md:mt-10">Rejoignez notre équipe!
                    </h2>
                    <p class="text-md md:text-lg mb-4 md:mb-6">
                        Passionné par l'automobile et le service client? BX Cars est toujours à la recherche de talents.
                        Contactez-nous pour faire partie de notre aventure!
                    </p>
                    <a href="{{ url('/contact') }}"
                        class="mt-4 md:mt-5 inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">
                        Contactez-nous
                    </a>
                </div>
            </div>
        </section>


        <section>
            <div id="map" style=" height: 600px; }"></div>
        </section>
    </main>

    <footer class="text-white bg-black border-t-2 border-gray-200">
        <div class="flex flex-col lg:flex-row items-center justify-between py-4 px-4 lg:px-12 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl uppercase logo">Bxcars</h1>
            </div>
            <div class="flex justify-between gap-2 lg:gap-4">
                <a href="{{ url('/about') }}" class="text-gray-300 transition-colors hover:text-white">À propos</a>
                <a href="/services#section1" class="text-gray-300 transition-colors hover:text-white">Conditions</a>
                <a href="/contact" class="text-gray-300 transition-colors hover:text-white">Contact</a>
            </div>
            <div class="flex flex-row gap-2 lg:gap-4">
                <a href="https://www.instagram.com/bx_cars_rental/" target="_blank" rel="noopener noreferrer">
                    <div
                        class="flex items-center justify-center w-8 h-8 transition-transform bg-gray-300 rounded-full hover:bg-gray-200 hover:scale-110">
                        <img src="/instagram.svg" alt="instagram icon">
                    </div>
                </a>

                <!-- Facebook -->
                <a href="https://www.facebook.com/people/Bx-Cars/pfbid0K5HQSNgyJPMsKygqBWgqgy8Mtrr99SHEcJt2s2LckipK9GatJLFvcA8r6zeYxiFel/"
                    target="_blank" rel="noopener noreferrer">
                    <div
                        class="flex items-center justify-center w-8 h-8 transition-transform bg-gray-300 rounded-full hover:bg-gray-200 hover:scale-110">
                        <img src="{{ asset('facebook.svg') }}" alt="facebook icon">
                    </div>
                </a>

                <!-- Snapchat -->
                <a href="https://www.snapchat.com/add/bxcars-tanger?share_id=HxAMeEKaQeY&locale=fr-BE" target="_blank"
                    rel="noopener noreferrer">
                    <div
                        class="flex items-center justify-center w-8 h-8 transition-transform bg-gray-300 rounded-full hover:bg-gray-200 hover:scale-110">
                        <img src="{{ asset('snapchat.svg') }}" alt="snapchat icon">
                    </div>
                </a>
            </div>
        </div>
        <div class="w-full text-xs lg:text-sm text-center py-2 bg-yellow-500 custom-font">
            <p>MADE IT WITH PASSION ♥ ~ <a href="http://nawfelajari.be" class="text-white hover:text-gray-800"
                    target="_blank" rel="noopener noreferrer">NAWFEL AJARI</a> &#169; 2024</p>
        </div>
    </footer>

    <script>
        var map = L.map('map').setView([35.73912798560225, -5.8717320174806755], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        L.marker([35.75087829113416, -5.831858625204238]).addTo(map)
            .bindPopup('15 Rue Hay Beauséjour 1, Tanger (Maroc)<br>Agence | Garage BX Cars');

        L.marker([35.72737767907435, -5.911605409757113]).addTo(map)
            .bindPopup("Parking de l'Aéroport Ibn Batouta");
    </script>
</body>

</html>