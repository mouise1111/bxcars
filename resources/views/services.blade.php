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


<body
    style="background-image: url('{{ asset('wallpapertanger3.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <header>
        <div class="relative min-h-screen -top-10">
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
                <div class="absolute top-0 left-0 w-60 h-screen bg-black transform transition-transform duration-200 rounded-lg shadow-lg"
                    style="z-index: 20;" :class="{'-translate-x-full': !open, 'translate-x-0': open}">
                    <button @click="open = false" class="p-4 text-white hover:text-red-400">
                        <img src="/close-menu-icon.png" alt="closing the menu button icon"
                            class="w-1/2 rounded-full h-1/2 w-8 h-8 mt-5">
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
                        <a href="#" class="sm:hidden py-2 text-gray-400 hover:text-yellow-500"
                            onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            <img class="inline cursor-pointer h-3" src="{{ asset('logout.png') }}" alt="Déconnexion">
                            Déconnexion
                        </a>
                        @endauth
                        @endif
                    </div>
                </div>


                <section>
                    <h1
                        class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl mt-10 sm:mt-16 md:mt-20 font-bold text-white text-center px-4 sm:px-8 md:px-16 lg:px-32">
                        SERVICES
                    </h1>

                    <h2
                        class="mb-10 text-xl sm:text-3xl md:text-4xl lg:text-5xl mt-10 sm:mt-14 md:mt-16 lg:mt-20 font-bold text-white text-center px-4 sm:px-8 md:px-16 lg:px-32">
                        Explorez la gamme complète de nos services dédiés à rendre votre expérience de location unique.
                    </h2>

                    <div class="min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
                        <div
                            class="bg-gray-800 text-white w-full sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl mx-auto p-6 sm:p-8 md:p-10 rounded-lg shadow-lg">
                            <h1 class="text-3xl sm:text-4xl font-bold text-center mb-4">Nos Services</h1>
                            <p class="text-lg sm:text-xl md:text-2xl text-center mb-8">Découvrez l'étendue de nos
                                services sur mesure, conçus pour transformer votre location en une expérience
                                véritablement exceptionnelle.</p>

                            <!-- Services List -->
                            <div class="space-y-4">
                                <!-- Service 1 -->
                                <div
                                    class="bg-white text-gray-800 p-4 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                                    <h2 class="text-xl sm:text-2xl font-semibold">Location courte et longue durée</h2>
                                    <p>Que vous ayez besoin d'une voiture pour un jour, une semaine, ou un mois, nous
                                        offrons des tarifs flexibles adaptés à vos besoins.</p>
                                </div>

                                <!-- Service 2 -->
                                <div
                                    class="bg-white text-gray-800 p-4 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                                    <h2 class="text-xl sm:text-2xl font-semibold">Livraison et récupération</h2>
                                    <p>Profitez de nos services gratuits de livraison et récupération à l'aéroport, à
                                        l'agence ou dans une autre ville au Maroc pour une expérience sans tracas.</p>
                                </div>

                                <!-- Service 3 -->
                                <div
                                    class="bg-white text-gray-800 p-4 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                                    <h2 class="text-xl sm:text-2xl font-semibold">Assurance complète</h2>
                                    <p>Tous nos véhicules sont couverts par une assurance complète pour vous garantir
                                        une tranquillité d'esprit totale pendant la location.</p>
                                </div>

                                <!-- Service 4 -->
                                <div
                                    class="bg-white text-gray-800 p-4 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                                    <h2 class="text-xl sm:text-2xl font-semibold">Sélection triée sur le volet</h2>
                                    <p>Découvrez notre sélection soigneusement choisie de véhicules récents, couvrant
                                        vos besoins essentiels depuis les citadines agiles et économiques jusqu'au
                                        confort d'un SUV de luxe. Chacun de nos modèles est sélectionné pour offrir une
                                        expérience de conduite exceptionnelle, adaptée à vos exigences de mobilité.</p>
                                </div>

                                <!-- Service 5 -->
                                <div
                                    class="bg-white text-gray-800 p-4 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                                    <h2 class="text-xl sm:text-2xl font-semibold">Assistance routière 24/7</h2>
                                    <p>Où que vous soyez, notre service d'assistance routière est disponible 24/7 pour
                                        vous aider en cas de besoin.</p>
                                </div>

                                <!-- Additional Services -->
                                <p class="text-center mt-8 font-medium">Et bien plus encore... Découvrez tous nos
                                    services en nous contactant ou en visitant notre agence!</p>
                            </div>
                        </div>
                    </div>
                </section>


                <section class="py-16 md:py-32 bg-gray-800 mt-10">
                    <h1 class="text-3xl md:text-5xl font-semibold text-center text-yellow-500">Conditions générales - BX
                        Cars</h1>
                    <div class="container mx-auto px-4 text-white md:px-10 lg:px-20 xl:pl-40 xl:pr-40 mt-10 md:mt-20">
                        <div class="mb-10">
                            <h2 class="text-xl md:text-2xl font-semibold text-yellow-500 mb-4">1. Introduction</h2>
                            <p class="text-md md:text-lg">
                                Ces conditions générales de location (ci-après dénommées "Conditions") régissent toutes
                                les locations de véhicules effectuées auprès de BX Cars, ci-après dénommée "la Société".
                                En signant l'accord de location, le locataire (ci-après dénommé "le Client") accepte ces
                                Conditions sans réserve.
                            </p>
                        </div>

                        <!-- Continuation des Conditions Générales -->
                        <div class="mb-10">
                            <h2 class="text-xl md:text-2xl font-semibold text-yellow-500 mb-4">2. Conditions de Location
                            </h2>
                            <div class="text-md md:text-lg mb-4">
                                <h3 class="font-bold text-yellow-600">2.1 Éligibilité</h3>
                                <p>Le Client doit être âgé d'au moins 21 ans et détenir un permis de conduire valide
                                    depuis au moins 2 ans pour les catégories de véhicules standards, et d'au moins 25
                                    ans avec un permis valide depuis 3 ans pour les véhicules de luxe ou de spécialité.
                                    Une pièce d'identité ou un passeport valide au nom du Client seront
                                    exigées au moment de la location.</p>
                            </div>
                            <div class="text-md md:text-lg mb-4">
                                <h3 class="font-bold text-yellow-600">2.2 Durée de Location</h3>
                                <p>La durée minimale de location est de 24 heures. Toute heure supplémentaire sera
                                    facturée comme une journée complète après dépassement d'une période de grâce de 59
                                    minutes.</p>
                            </div>
                            <div class="text-md md:text-lg mb-4">
                                <h3 class="font-bold text-yellow-600">2.3 Tarification et Paiements</h3>
                                <p>Les tarifs sont établis sur la base de périodes de 24 heures, incluant l'assurance de
                                    base obligatoire. Les services supplémentaires seront facturés en sus. Le paiement
                                    intégral est requis au moment de la prise en charge du véhicule. Au cas où l'annonce
                                    d'un véhicule affiche une caution,
                                    le montant de caution, peut être bloquée.</p>
                            </div>
                            <div class="text-md md:text-lg mb-4">
                                <h3 class="font-bold text-yellow-600">2.4 Assurance et Responsabilité</h3>
                                <p>Une assurance de base est incluse dans la location. Elle couvre la responsabilité
                                    civile, le vol, et les dommages au véhicule sous certaines conditions. Une franchise
                                    reste à la charge du Client en cas de sinistre. Des assurances complémentaires
                                    peuvent être souscrites au moment de la location.</p>
                            </div>
                            <div class="text-md md:text-lg mb-4">
                                <h3 class="font-bold text-yellow-600">2.5 Utilisation du Véhicule</h3>
                                <p>Le véhicule doit être utilisé dans le respect des lois de circulation et ne doit pas
                                    être employé pour des courses, des tests de vitesse ou toute activité illicite. La
                                    location est strictement personnelle. Le prêt ou la sous-location du véhicule à des
                                    tiers est interdit sans l'accord écrit de la Société.</p>
                            </div>
                            <div class="text-md md:text-lg mb-4">
                                <h3 class="font-bold text-yellow-600">2.6 Retour du Véhicule</h3>
                                <p>Le véhicule doit être retourné à la date, à l'heure et au lieu convenus. Un retard de
                                    restitution entraînera des frais supplémentaires. Le véhicule doit être rendu dans
                                    le même état qu'au départ, à l'exception de l'usure normale. Des frais de nettoyage
                                    ou de réparation pourront être facturés si nécessaire.</p>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h2 class="text-xl md:text-2xl font-semibold text-yellow-500 mb-4">3. Annulation et
                                Modification</h2>
                            <p class="text-lg">Toute annulation ou modification de la réservation doit être notifiée au
                                moins 48 heures avant la date et l'heure de prise en charge prévues, sous peine de
                                frais.</p>
                        </div>

                        <div class="mb-10">
                            <h2 class="text-xl md:text-2xl font-semibold text-yellow-500 mb-4">4. Responsabilités de la
                                Société
                            </h2>
                            <p class="text-lg">La Société s'engage à fournir un véhicule en bon état de marche,
                                répondant aux spécifications de la catégorie réservée. En cas de défaillance mécanique
                                non imputable au Client, la Société s'engage à remplacer le véhicule dans les plus brefs
                                délais.</p>
                        </div>

                        <hr>

                        <div class="text-center">
                            <h2 class="text-2xl font-semibold mb-4 mt-10">Rejoignez notre équipe!</h2>
                            <p class="text-lg mb-6">Passionné par l'automobile et le service client? BX Cars est
                                toujours à la recherche de talents. Contactez-nous pour faire partie de notre aventure!
                            </p>
                            <a href="{{ url('/contact') }}"
                                class="mt-5 inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">Contactez-nous</a>
                        </div>
                    </div>
            </div>
            </section>
    </header>

    <footer class="text-white bg-black border-t-2 border-gray-200">
        <div class="flex flex-col lg:flex-row items-center justify-between py-4 px-4 lg:px-12 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl uppercase logo">Bxcars</h1>
            </div>
            <div class="flex justify-between gap-2 lg:gap-4">
                <a href="{{ url('/about') }}" class="text-gray-300 transition-colors hover:text-white">À propos</a>
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

</body>

</html>