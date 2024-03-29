<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Accueil | BX Cars</title>
    <link rel="icon" type="image/png" href="/bxlogo-modified.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@600&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IM+Fell+Double+Pica+SC&family=Inter&family=Koulen&family=League+Gothic&family=Lobster&family=Playfair+Display+SC&family=Saira+Condensed:wght@600&family=Saira+Stencil+One&family=Waterfall&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- Scripts : Ajax / UNKG / Vite -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')

    <!--CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6vP0kZfSfQLz2Whle6PvjeK9fuT+9HbR4uPm3IjB4z1EW2koqT92yWfJYF8Dg3j" crossorigin="anonymous">


    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @vite('resources/css/app.css')
    <style>
        .custom-font {
            font-family: 'Poppins';

        }
    </style>
</head>

<body>
    <div class="relative h-screen bg-black"
        style="background-image: url('{{ asset('car-hero.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div x-data="{ open: false }">
            <nav class="flex items-center justify-between px-4 py-8">
                <button @click="open = !open" class="space-y-2 focus:outline-none">
                    <!-- Icône du menu (hamburger) pour mobile -->
                    <div class="w-8 h-0.5 bg-white"></div>
                    <div class="w-8 h-0.5 bg-white"></div>
                    <div class="w-8 h-0.5 bg-white"></div>
                </button>
                <!-- Logo -->
                <a href="/" class="text-3xl text-white uppercase logo">bxcars</a>
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

            <!-- Sidebar mobile -->
            <div class="absolute top-0 left-0 w-64 h-screen transition-transform duration-200 transform bg-black"
                :class="{'-translate-x-full': !open, 'translate-x-0': open}">
                <button @click="open = false" class="p-4 text-white hover:text-red-400">
                    <img src="/close-menu-icon.png" alt="closing the menu button icon" class="w-8 h-8">
                </button>
                <div class="flex flex-col p-4">
                    <!-- Liens de navigation -->
                    <a href="{{ url('/') }}" class="py-2 text-yellow-500 border-b-2 border-gray-100">Accueil</a>
                    <a href="{{ url('/services') }}" class="py-2 text-white hover:text-yellow-500">Services</a>
                    <a href="{{ url('/about') }}" class="py-2 text-white hover:text-yellow-500">À propos</a>
                    <a href="{{ url('/contact') }}" class="py-2 text-white hover:text-yellow-500">Contact</a>
                    @if(Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}" class="py-2 text-gray-400 hover:text-yellow-500">Réservations</a>
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

        <h1 class="mt-20 text-3xl font-bold text-center text-white lg:text-5xl lg:px-32">
            Votre clé pour explorer le Maroc, confort et liberté garantis
        </h1>
    </div>
    </div>
    </section>
    <div class="marquee">
        <div class="marquee-content">
            @php
            $paragraph = \App\Models\HomepageParagraph::latest()->first();
            @endphp

            @if($paragraph && trim($paragraph->content) !== '')
            <p>{{ $paragraph->content }}</p>
            @endif
        </div>
    </div>


    <style>
        .marquee {
            width: 100%;
            overflow: hidden;
            box-sizing: border-box;
            background-color: red;

        }

        .marquee-content {
            display: inline-block;
            white-space: nowrap;
            padding-left: 100%;
            /* Ajoute un espace avant le défilement */
            box-sizing: border-box;
            text: white;
        }

        .marquee p {
            display: inline-block;
            color: white;
            font-size: 30px;

            /* Espace entre les répétitions */
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .marquee-content {
            animation: scroll-left 20s linear infinite;
        }
    </style>
    <section class="py-32 text-black bg-gray-100">


        <h1 class="text-5xl font-semibold text-center">Notre collection de voitures</h1>
        <h3 class="mt-4 text-lg text-center lg:px-56">
            De citadines modernes à des SUV robustes, chaque véhicule est méticuleusement sélectionné pour garantir une
            expérience de conduite confortable et à la pointe de la technologie.
        </h3>


        @if(Route::has('login'))
        @auth
        <div class="flex justify-center mt-6">
            <a href="{{ url('/cars/create') }}"
                class="px-6 py-3 text-2xl text-white transition duration-500 bg-yellow-500 rounded hover:bg-black">Gestion
                de véhicules</a>
        </div>
        @endauth
        @endif


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid-rows-2 gap-4 mt-20 lg:px-20">
            @foreach ($cars as $car)
            <div class="flex flex-col p-2 transition-all bg-white border-2 hover:border-black border-gray rounded-3xl">
                <img src="{{ Storage::url($car->photo) }}" alt="Car Image">
                <div class="p-2">
                    <h4 class="text-lg font-semibold p">{{ $car->model_name }}</h4>
                    <div class="flex flex-row items-end">
                        <div class="flex flex-col mr-4">
                            <h5 class="text-4xl font-bold">
                                {{ number_format($car->price_per_day_long_term, 0, '.', '') }} DH
                                <span class="text-xl font-medium text-gray-800">/jour</span>
                            </h5>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500">
                                Trois jours et moins : {{ number_format($car->price_per_day_short_term, 0, '.', '') }}
                                DH
                            </span>
                            <span class="text-sm text-gray-500">
                                Caution: {{ number_format($car->price_caution, 0, '.', '') }} DH
                            </span>
                        </div>
                    </div>


                    <div
                        class="flex flex-row items-center content-center justify-between px-8 py-2 my-4 bg-gray-100 rounded-xl">
                        <div class="flex flex-col">
                            <img src="/speedometer.png" class="self-center icons" alt="mileage icon" />
                            <span>{{ $car->total_km }} KM</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/manual-gearbox.png" class="self-center icons" alt="transmission icon" />
                            <span>
                                @if($car->transmission === 'Manual')
                                Manuel
                                @elseif($car->transmission === 'Automatic')
                                Automatique
                                @else
                                {{ $car->transmission }}
                                @endif
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/users.png" class="self-center icons" alt="seats icon" />
                            <span>{{ $car->seats }} Sièges</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/gas-station.png" class="self-center icons" alt="fuel type icon" />
                            <span>{{ $car->fuel_type }}</span>
                        </div>
                    </div>

                    @if(!$car->isAvailableToday())
                    <a href="{{ route('reservation.create', ['car' => $car->id]) }}"
                        class="block w-full px-4 py-2 font-medium text-center text-black transition-colors border-2 border-black rounded-3xl hover:bg-green-500 hover:text-white">
                        Louer <span class="text-red-600">(Indisponible aujourd'hui)</span>
                    </a>
                    @else
                    <a href="{{ route('reservation.create', ['car' => $car->id]) }}"
                        class="block w-full px-4 py-2 font-medium text-center text-black transition-colors border-2 border-black rounded-3xl hover:bg-green-500 hover:text-white">
                        Louer
                    </a>
                    @endif

                </div>
            </div>
            @endforeach
        </div>
        </div>
        <div class="flex justify-center lg:py-12">
            <button id="voirPlusBtn"
                class="text-white transition-colors bg-black border-2 rounded-3xl hover:bg-gray-500 border-inherit hover:border-black mt-20">
                <h4 class="w-full px-8 py-4">Voir plus</h4>
            </button>
        </div>
    </section>
    <section class="px-4 py-8 sm:px-8 md:px-16 lg:px-32 lg:py-32">
        <h1 class="text-3xl font-semibold text-center md:text-4xl lg:text-5xl">Comment ça marche</h1>
        <h3 class="mt-4 text-center text-base md:text-lg lg:px-56">
            Louer une voiture au Maroc n'a jamais été aussi simple. Notre processus optimisé rend la réservation et la
            confirmation de votre véhicule de choix en ligne facile et rapide.
        </h3>

        <div class="flex flex-col lg:flex-row mt-16">
            <div class="relative flex flex-col gap-4 lg:flex-1">
                <!-- Bloc 1 -->
                <div class="flex flex-col lg:flex-row items-center gap-4 p-8 bg-white border-2 border-gray rounded-3xl">
                    <div class="flex items-center h-full px-4 bg-gray-200 rounded-xl">
                        <img src="/search.png" alt="magnifier icon for search" class="icons-2">
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <h3 class="text-xl font-semibold">Parcourez et sélectionnez</h3>
                        <p>Choisissez parmi notre gamme de voitures, sélectionnez les dates et les lieux de prise en
                            charge qui vous conviennent le mieux.</p>
                    </div>
                </div>
                <!-- Bloc 2 -->
                <div class="flex flex-col lg:flex-row items-center gap-4 p-8 bg-white border-2 border-gray rounded-3xl">
                    <div class="flex items-center h-full px-4 bg-gray-200 rounded-xl">
                        <img src="/calendar.png" alt="calendar icon" class="icons-2">
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <h3 class="text-xl font-semibold">Réservez et confirmez</h3>
                        <p>Réservez la voiture de votre choix en seulement quelques clics et recevez une confirmation
                            instantanée par e-mail ou SMS.</p>
                    </div>
                </div>
                <!-- Bloc 3 -->
                <div
                    class="flex flex-col lg:flex-row items-center gap-4 p-8 mb-16 bg-white border-2 border-gray rounded-3xl">
                    <div class="flex items-center h-full px-4 bg-gray-200 rounded-xl">
                        <img src="/face-happy.png" alt="smiley icon" class="icons-2">
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <h3 class="text-xl font-semibold">Profitez de votre trajet</h3>
                        <p>Récupérez votre voiture à l'emplacement désigné et profitez de votre expérience de conduite
                            haut de gamme avec notre service de qualité supérieure.</p>
                    </div>
                </div>

                <div class="absolute right-0 w-40 h-full bg-gray-100 -z-10 rounded-l-3xl hidden lg:block"></div>
            </div>

            <div class="flex items-center p-8 bg-gray-100 rounded-r-full hidden lg:block">
                <img src="/jeep.png" alt="jeep car" class="w-full h-auto">
            </div>
        </div>
    </section>




    <section class="px-32 py-32 text-black bg-gray-100">
        <h2 class="mb-16 text-4xl font-bold">Richard Branson a dit ...</h2>
        <p class="text-2xl font-semibold"><span>“</span>Si quelqu'un vous offre une opportunité incroyable mais que vous
            n'êtes pas sûr de pouvoir le faire, dites oui - puis apprenez comment le faire plus tard!<span>“</span>
        </p> <span>Avec BX Cars, saisissez l'opportunité de partir à l'aventure, même si c'est sur un coup
            de tête, avec la facilité et la flexibilité de la location de voiture.</span>
        <div class="flex flex-row justify-between mt-8">
            <div class="flex flex-row gap-4">
                <div class="w-20 h-20 bg-gray-500 rounded-full overflow-hidden">
                    <img src="/branson.jpg" alt="" class="object-cover w-full h-full">
                </div>
                <div class="flex flex-col justify-between py-3">
                    <h4 class="font-bold">Richard Branson</h4>
                    <h6 class="text-gray-800">Autobiographie <span class="font-semibold">Finding My Virginity</span>
                    </h6>
                </div>
            </div>
            <div class="flex flex-row gap-2 m-4 mt-4 ml-auto lg:mt-auto">
                <div
                    class="flex items-center justify-center w-10 h-10 text-white transition-all bg-black rounded-full shadow-md hover:bg-gray-500 hover:scale-105">
                    <img src="/left-arrow.png" class="w-1/2 h-1/2" alt="" />
                </div>
                <div
                    class="flex items-center justify-center w-10 h-10 text-white transition-all bg-black rounded-full shadow-md hover:bg-gray-500 hover:scale-105">
                    <img src="/right-arrow.png" class="w-1/2 h-1/2" alt="" />
                </div>
            </div>
        </div>
    </section>

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
        document.addEventListener('DOMContentLoaded', function () {
            var btnVoirPlus = document.getElementById('voirPlusBtn');
            if (btnVoirPlus) {
                btnVoirPlus.addEventListener('click', function (e) {
                    e.preventDefault();
                    alert("L'agence ne possède actuellement que " + {{ $totalCars }} + " véhicules.");
            });
        }
    });

        const quotesData = [
            {
                title: "Richard Branson a dit ...",
                quote: "Si quelqu'un vous offre une opportunité incroyable mais que vous n'êtes pas sûr de pouvoir le faire, dites oui - puis apprenez comment le faire plus tard!",
                context: "Avec BX Cars, saisissez l'opportunité de partir à l'aventure, même si c'est sur un coup de tête, avec la facilité et la flexibilité de la location de voiture.",
                imgSrc: "/branson.jpg",
                imgAlt: "Richard Branson",
                person: "Richard Branson",
                reference: "Autobiographie Finding My Virginity"
            },
            {
                title: "Elon Musk a dit ...",
                quote: "Quand quelque chose est suffisamment important, vous le faites même si les chances ne sont pas en votre faveur.",
                context: "Avec BX Cars, relevez le défi de l'inattendu et lancez-vous dans l'aventure, quelle que soit la destination. Notre service de location de voiture vous offre la liberté de poursuivre ce qui vous est important, avec la confiance et le soutien nécessaires pour explorer de nouveaux horizons.",
                imgSrc: "/elonmusk.jpg",
                imgAlt: "Elon Musk",
                person: "Elon Musk",
                reference: "Philosophie d'Elon Musk sur la prise de risques."
            }
        ];

        let currentIndex = 0;

        function updateContent(index) {
            index = Math.max(0, Math.min(index, quotesData.length - 1));
            const data = quotesData[index];
            document.querySelector("h2.mb-16").textContent = data.title;
            document.querySelector("p.text-2xl").textContent = data.quote;
            document.querySelector("section > span").textContent = data.context;
            document.querySelector("div.w-20 > img").src = data.imgSrc;
            document.querySelector("div.w-20 > img").alt = data.imgAlt;
            document.querySelector("h4.font-bold").textContent = data.person;
            document.querySelector("h6.text-gray-800").textContent = data.reference;
        }

        document.querySelector("img[src='/left-arrow.png']").closest("div").addEventListener("click", () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateContent(currentIndex);
            }
        });

        document.querySelector("img[src='/right-arrow.png']").closest("div").addEventListener("click", () => {
            if (currentIndex < quotesData.length - 1) {
                currentIndex++;
                updateContent(currentIndex);
            }
        });
    </script>
</body>

</html>