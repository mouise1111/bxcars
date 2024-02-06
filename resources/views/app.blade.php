<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Accueil - BX Cars</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6vP0kZfSfQLz2Whle6PvjeK9fuT+9HbR4uPm3IjB4z1EW2koqT92yWfJYF8Dg3j" crossorigin="anonymous">
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="relative h-screen bg-black"
        style="background-image: url('{{ asset('car-hero.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div x-data="{ open: false }">
            <nav class="flex justify-between items-center py-8 px-4">
                <button @click="open = !open" class="space-y-2 focus:outline-none">
                    <!-- Icône du menu (hamburger) -->
                    <div class="w-8 h-0.5 bg-white"></div>
                    <div class="w-8 h-0.5 bg-white"></div>
                    <div class="w-8 h-0.5 bg-white"></div>
                </button>
                <!-- Logo -->
                <a href="/" class="text-3xl uppercase logo text-white">bxcars</a>
                <div>
                    @if(Route::has('login'))
                    @auth
                    <span class="text-white pr-4 hover:text-yellow-500"
                        onclick="window.location.href='{{ url('profile') }}'">{{ Auth::user()->name }}</span>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img class="h-7 inline cursor-pointer" src="{{ asset('logout.png') }}" alt="Déconnexion">
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-white pr-4 hover:text-yellow-500">Connexion</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-white hover:text-yellow-500">Inscription</a>
                    @endif
                    @endauth
                    @endif
                </div>
            </nav>


            <div class="absolute top-0 left-0 w-60 h-screen bg-black transform transition-transform duration-200"
                :class="{'-translate-x-full': !open, 'translate-x-0': open}">
                <button @click="open = false" class="text-white p-4">
                    Fermer
                </button>
                <div class="flex flex-col p-4">
                    <a href="#" class="py-2 text-white hover:text-yellow-500">Accueil</a>
                    <a href="{{ url('/services') }}" class="py-2 text-white hover:text-yellow-500">Services</a>
                    <a href="{{ url('/about') }}" class="py-2 text-white hover:text-yellow-500">À propos</a>
                    <a href="{{ url('/contact') }}" class="py-2 text-white hover:text-yellow-500">Contact</a>
                </div>
            </div>

        </div>
        <h1 class="text-5xl mt-20 font-bold text-white text-center lg:px-32">
            Votre clé pour explorer le Maroc, confort et liberté garantis
        </h1>
    </div>



    </div>
    </section>
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
                class="bg-yellow-500 text-2xl text-white px-6 py-3 rounded transition duration-500 hover:bg-black">Gestion
                de véhicules</a>
        </div>
        @endauth
        @endif


        <div class="grid grid-cols-3 grid-rows-2 gap-4 lg:px-20 mt-20">
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
                    @if(!$car->disponible)
                    <p
                        class="block w-full px-4 py-2 text-center text-white bg-red-600 border-2 border-red-600 rounded-3xl">
                        Indisponible</p>
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

        </div>
        <div class="flex justify-center lg:py-12">
            <button id="voirPlusBtn"
                class="text-white transition-colors bg-black border-2 rounded-3xl hover:bg-gray-500 border-inherit hover:border-black">
                <h4 class="w-full px-8 py-4">Voir plus</h4>
            </button>
        </div>
    </section>

    <section class="px-32 py-32">
        <h1 class="text-5xl font-semibold text-center">Comment ça marche</h1>
        <h3 class="mt-4 text-lg text-center lg:px-56">
            Louer une voiture au Maroc n'a jamais été aussi simple. Notre processus optimisé rend la réservation et la
            confirmation de votre véhicule de choix en ligne facile et rapide.
        </h3>

        <div class="flex flex-row mt-16">
            <div class="relative flex flex-col gap-4">
                <div class="flex flex-row items-center gap-4 p-8 mt-16 bg-white border-2 border-gray rounded-3xl ">
                    <div class="flex items-center h-full px-4 bg-gray-200 rounded-xl">
                        <img src="/search.png" alt="mangnifier icon for search" class="icons-2">
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <h3 class="text-xl font-semibold">Parcourez et sélectionnez</h3>
                        <p>Choisissez parmi notre gamme de voitures, sélectionnez les dates et les lieux de prise en
                            charge qui vous conviennent le mieux.</p>
                    </div>
                </div>
                <div class="flex flex-row items-center gap-4 p-8 bg-white border-2 border-gray rounded-3xl ">
                    <div class="flex items-center h-full px-4 bg-gray-200 rounded-xl">
                        <img src="/calendar.png" alt="calendar icon" class="icons-2 ">
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-xl font-semibold">
                            Réservez et confirmez</h3>
                        <p>Réservez la voiture de votre choix en seulement quelques clics et recevez une confirmation
                            instantanée par e-mail ou SMS.</p>
                    </div>
                </div>
                <div class="z-10 flex flex-row items-center gap-4 p-8 mb-16 bg-white border-2 border-gray rounded-3xl">
                    <div class="flex items-center h-full px-4 bg-gray-200 rounded-xl">
                        <img src="/face-happy.png" alt="smiley icon" class="icons-2 ">
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-xl font-semibold">Profitez de votre trajet</h3>
                        <p>Récupérez votre voiture à l'emplacement désigné et profitez de votre expérience de conduite
                            haut de gamme avec notre service de qualité supérieure.</p>
                    </div>
                </div>

                <div class="absolute right-0 w-40 h-full bg-gray-100 -z-10 rounded-l-3xl"></div>
            </div>

            <div class="flex items-center p-8 bg-gray-100 rounded-r-full">
                <img src="/jeep.png" alt="jeep car">
            </div>
        </div>

    </section>

    <section class="px-32 py-32 text-black bg-gray-100">
        <h2 class="mb-16 text-4xl font-bold">What Our Customer Say</h2>
        <p class="text-2xl font-semibold"><span>“</span>I was really impressed with the level of service I received
            from this car
            rental company. The process was
            smooth and easy, and the car I rented was in excellent condition. The staff was friendly and helpful, and I
            felt well taken care of throughout my rental period. I would definitely recommend this company to anyone
            looking for a premium car rental experience.<span>“</span>
        </p>
        <div class="flex flex-row justify-between mt-8">
            <div class="flex flex-row gap-4">
                <div class="w-20 h-20 bg-gray-500 rounded-full">
                    {{-- <img src="" alt="profile picture of the car renter"> --}}
                </div>
                <div class="flex flex-col justify-between py-3">
                    <h4 class="font-bold">Lokman Hossain</h4>
                    <h6 class="text-gray-800">From <span class="font-semibold">Texas</span></h6>
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

    <footer
        class="flex flex-col items-center justify-between py-4 text-white bg-black border-t-2 border-gray-200 lg:px-12 lg:flex-row">
        <div>
            <h1 class="text-3xl uppercase logo">Bxcars</h1>
        </div>
        <div class="flex justify-between gap-4 ">
            <a href="{{ url('/about') }}" class="text-gray-300 transition-colors hover:text-white">About</a>
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
        document.addEventListener('DOMContentLoaded', function () {
            var btnVoirPlus = document.getElementById('voirPlusBtn');
            if (btnVoirPlus) {
                btnVoirPlus.addEventListener('click', function (e) {
                    e.preventDefault();
                    alert("L'agence ne possède actuellement que " + {{ $totalCars }} + " véhicules.");
            });
        }
    });
    </script>



</body>

</html>