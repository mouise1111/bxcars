<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Réservation | BX Cars</title>
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
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="{{ asset('css/createreservation.css') }}">
    @vite('resources/css/app.css')
</head>

<body>
    <header class="flex flex-col min-h-screen">
        <section class="relative h-screen text-white bg-black mb-60 -top-10"
            style="background-image: url('{{ asset('car-hero.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div x-data="{ open: false }">
                <nav class="flex justify-between items-center py-8 px-4">
                    <button @click="open = !open" class="space-y-2 focus:outline-none">
                        <div class="w-8 h-0.5 bg-white"></div>
                        <div class="w-8 h-0.5 bg-white"></div>
                        <div class="w-8 h-0.5 bg-white"></div>
                    </button>
                    <!-- Logo -->
                    <a href="/" class="text-3xl uppercase logo text-white mr-10">bxcars</a>
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
                        <a href="#" class="py-2 text-yellow-500 border-b-2 border-gray-100 ml-5">Réservation<br>
                            {{
                            $car->model_name }}</a>
                        <a href="{{ url('/services') }}" class="py-2 text-white hover:text-yellow-500">Services</a>
                        <a href="{{ url('/about') }}" class="py-2 text-white hover:text-yellow-500">À
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

            @if(isset($car->model_name))
            <div class="text-center pt-10">
                <h2 class="text-2xl text-white mb-4">Véhicule sélectionné : {{ $car->model_name }}</h2>
                @if(isset($car->price_per_day_long_term))
                <p class="text-xl text-white mb-4">Prix par jour : {{ $car->price_per_day_long_term }} DH (+3J)</p>
                @endif
            </div>
            @endif
            @if(isset($car->photo))
            <div class="w-32 h-32 mx-auto mt-4 mb-8">
                <img src="{{ Storage::url($car->photo) }}" alt="Photo de {{ $car->model_name }}"
                    class="rounded-full object-cover w-full h-full">
            </div>
            @endif


            @if(session('success'))
            <div id="successMessage" class="fixed top-0 left-0 right-0 bg-green-500 text-white text-center py-2 px-4">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function () {
                    document.getElementById('successMessage').style.display = 'none';
                }, 3000);
            </script>
    </header>

    <main>
        <section>
            <!-- Form Succeeded -->
            <div class="z-10 flex justify-center items-start mb-0 duration-500">
                <div
                    class="flex flex-row gap-8 px-12 py-6 text-black shadow-lg bg-white/50 rounded-3xl hover:bg-yellow-400 transition-colors duration-300">
                    <div class="contact-container text-center">
                        <h2 class="text-3xl">Merci pour votre réservation !</h2>
                        <p>Votre réservation est désormais en attente de l'acceptation d'un travailleur de l'agence.
                            En cas d'acceptation, vous recevrez une confirmation dans les plus brefs délais via
                            votre boite mail.</p>
                        <img src="{{ asset('loading.gif') }}" alt="Loading" class="mx-auto w-20 h-20 mt-5">
                        <p class="mt-5">Si vous avez des questions ou si vous avez besoin d'informations
                            supplémentaires,
                            n'hésitez pas à nous contacter.</p>
                        <div>
                            <p>Téléphone : +32 491 76 89 74</p>
                            <p>Email : info@bxcars.be</p>
                            <hr class="mt-5">
                            <div class="flex items-center justify-center mt-5">
                                <a href="{{ url('/') }}"
                                    class="bg-yellow-500 text-2xl text-white px-10 py-3 rounded transition duration-500 hover:bg-black mr-1.5 inline-block">
                                    RETOUR
                                </a>
                                <a href="{{ url('/about') }}"
                                    class="bg-yellow-500 text-2xl text-white px-5 py-3 rounded transition duration-500 hover:bg-black ml-1.5 inline-block">
                                    À PROPOS DE NOUS
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @if($futureUnavailableDates->isNotEmpty())
            <div class="flex justify-center mt-8">
                <div class="px-4 lg:max-w-4xl mx-auto">
                    <div class="overflow-x-auto rounded-lg shadow-md">
                        <table class=" table-auto text-center mx-auto">
                            <thead>
                                <tr class="bg-red-500 text-white">
                                    <th colspan="2" class="px-4">Indisponibilité du véhicule</th>
                                </tr>
                                <tr class="bg-gray-800 text-white">
                                    <th class="px-4">Date de Début</th>
                                    <th class="px-4">Date de Fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($futureUnavailableDates as $date)
                                @php
                                $startDate = \Carbon\Carbon::parse($date['start']);
                                $endDate = \Carbon\Carbon::parse($date['end']);
                                $format = 'j F Y';
                                @endphp
                                <tr class="bg-gray-500 border-b">
                                    <td class="px-4 py-2 border-r">{{ $startDate->translatedFormat($format) }}</td>
                                    <td class="px-4 py-2">
                                        @if($startDate->format('Y-m-d') !== $endDate->format('Y-m-d'))
                                        {{ $endDate->translatedFormat($format) }}
                                        @else
                                        {{ $startDate->translatedFormat($format) }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif


            <!-- Reservation Form -->
            <div class="z-10 flex justify-center items-start mb-0 duration-500 mt-5">
                <div
                    class="flex flex-row gap-8 px-12 py-6 text-black shadow-lg bg-black/50 rounded-3xl hover:bg-yellow-400 transition-colors duration-300">
                    <form action="{{ route('reservations.store') }}" method="POST" class="reservation-form">
                        <h1 class="form-title text-yellow-500">RÉSERVATION</h1>
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $carId }}">
                        <div class="flex flex-wrap justify-between">
                            <div class="input-group w-full lg:w-1/2 mt-7">
                                <label for="nom" class="block text-sm font-medium text-yellow-500">Nom et prénom</label>
                                <input type="text" name="first_name" required placeholder="Nom">
                                <input type="text" name="last_name" required placeholder="Prénom">
                                <label for="numero" class="block text-sm font-medium text-yellow-500">Numéro de
                                    téléphone</label>
                                <input type="tel" name="phone" required placeholder="Numéro de téléphone">
                                <label for="email" class="block text-sm font-medium text-yellow-500">Email</label>
                                <input type="email" name="email" required placeholder="Adresse email">
                            </div>
                            <div class="input-group w-full lg:w-1/2">
                                <label for="pickup_location"
                                    class="block text-sm font-medium text-yellow-500 mt-10">Lieu
                                    de
                                    prise</label>
                                <select id="pickup_location" class="text-gray-500" name="pickup_location" required>
                                    <option class="text-yellow-500" value="airport">Aéroport</option>
                                    <option class="text-yellow-500" value="agency">Agence</option>
                                    <option class="text-yellow-500" value="other_city">Autre ville</option>
                                </select>

                                <label for="start_date" class="block text-sm font-medium text-yellow-500">Date de
                                    début</label>
                                <input id="start_date" class="text-gray-500" type="date" name="start_date" required>

                                <label for="end_date" class="block text-sm font-medium text-yellow-500">Date de
                                    fin</label>
                                <input id="end_date" class="text-gray-500" type="date" name="end_date" required>
                            </div>
                        </div>

                        <div class="flex flex-col items-center mt-4">
                            <label for="payment_method"
                                class="mb-2 text-sm font-medium text-yellow-500">Paiement</label>
                            <select id="payment_method" name="payment_method" disabled
                                class="text-gray-500 cursor-not-allowed bg-gray-100"
                                title="Le paiement sur place est actuellement sélectionné et ne peut être modifié.">
                                <option value="on_site">Sur place</option>
                            </select>
                        </div>

                        <p class="mt-5 pl-5 pr-5">* Confiance garantie : Paiement uniquement sur place</p>
                        <p class=" pl-5 pr-5">* Service offert : Lieu de prise de voiture</p>
                        <div class="flex justify-center mb-10">
                            <button type="submit"
                                class="bg-yellow-500 text-white px-10 py-3 rounded transition duration-500 hover:bg-black">Demander
                                une réservation</button>
                        </div>

                        @if(session('error'))
                        <div class="fixed top-0 left-0 right-0 bg-red-500 text-white text-center py-2 px-4">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="fixed top-0 left-0 right-0 bg-red-500 text-white text-center py-2 px-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
            @endif
            @if(session('error'))
            <div class="fixed top-0 left-0 right-0 bg-red-500 text-white text-center py-2 px-4">
                {{ session('error') }}
            </div>
            @endif
            @if($errors->any())
            <div class="fixed top-0 left-0 right-0 bg-red-500 text-white text-center py-2 px-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </section>

        <section class="mt-80">

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
    <script>   tsource / lexend - tera";
    </script>
</body>

</html>