<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Réservation - BX Cars</title>

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
    <link rel="stylesheet" href="{{ asset('css/createreservation.css') }}">
    @vite('resources/css/app.css')
</head>

<body>
    <header class="flex flex-col min-h-screen">
        <section class="relative h-screen text-white bg-black mb-60"
            style="background-image: url('{{ asset('car-hero.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <nav class="flex flex-row justify-between py-8 lg:px-20">
                <div class="space-y-2">
                    <div class="w-8 h-0.5 bg-white"></div>
                    <div class="w-8 h-0.5 bg-white"></div>
                    <div class="w-8 h-0.5 bg-white"></div>
                </div>
                <a href="/" class="text-3xl text-white uppercase logo ml-20">bxcars</a>
            </nav>

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
            <div class="fixed top-0 left-0 right-0 bg-green-500 text-white text-center py-2 px-4">
                {{ session('success') }}
            </div>
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


            <!-- Reservation Form -->
            <div class="z-10 flex justify-center items-start mb-0 duration-500">
                <div
                    class="flex flex-row gap-8 px-12 py-6 text-black shadow-lg bg-white/50 rounded-3xl hover:bg-yellow-400 transition-colors duration-300">
                    <form action="{{ route('reservations.store') }}" method="POST" class="reservation-form">
                        <h1 class="form-title">RÉSERVATION</h1>
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $carId }}">
                        <div class="flex flex-wrap justify-between">
                            <div class="input-group w-full lg:w-1/2 mt-7">
                                <input type="text" name="first_name" required placeholder="Nom">
                                <input type="text" name="last_name" required placeholder="Prénom">
                                <input type="tel" name="phone" required placeholder="Numéro de téléphone">
                                <input type="email" name="email" required placeholder="Adresse email">
                            </div>
                            <div class="input-group w-full lg:w-1/2">
                                <label for="pickup_location" class="block text-sm font-medium text-gray-700">Lieu de
                                    prise</label>
                                <select id="pickup_location" class="text-gray-500" name="pickup_location" required>
                                    <option class="text-gray-500" value="airport">Aéroport</option>
                                    <option class="text-gray-500" value="agency">Agence</option>
                                    <option class="text-gray-500" value="other_city">Autre ville</option>
                                </select>

                                <label for="start_date" class="block text-sm font-medium text-gray-700">Date de
                                    début</label>
                                <input id="start_date" class="text-gray-500" type="date" name="start_date" required>

                                <label for="end_date" class="block text-sm font-medium text-gray-700">Date de
                                    fin</label>
                                <input id="end_date" class="text-gray-500" type="date" name="end_date" required>
                            </div>
                        </div>

                        <div class="flex flex-col items-center mt-4">
                            <label for="payment_method" class="mb-2 text-sm font-medium text-gray-700">Paiement</label>
                            <select id="payment_method" name="payment_method" disabled
                                class="text-gray-500 cursor-not-allowed bg-gray-100"
                                title="Le paiement sur place est actuellement sélectionné et ne peut être modifié.">
                                <option value="on_site">Sur place</option>
                            </select>
                        </div>

                        <p class="mt-5">* Confiance garantie : Paiement uniquement sur place</p>
                        <p>* Service offert : Lieu de prise de voiture</p>
                        <div class="flex justify-center mt-4">
                            <button type="submit"
                                class="mt-2 bg-yellow-500 text-white px-10 py-3 rounded transition duration-500 hover:bg-black">Réserver</button>
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
    </header>


    <footer
        class="mt-0 flex flex-col items-center justify-between py-4 text-white bg-black border-t-2 border-gray-200 lg:px-12 lg:flex-row">
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