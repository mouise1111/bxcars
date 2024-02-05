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

    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex flex-col min-h-screen">
        <header>

            <section class="relative h-screen text-white bg-black mb-60"
                style="background-image: url('{{ asset('car-hero.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

                <nav class="flex flex-row justify-between py-8 lg:px-20">
                    <div class="space-y-2">
                        <div class="w-8 h-0.5 bg-white"></div>
                        <div class="w-8 h-0.5 bg-white"></div>
                        <div class="w-8 h-0.5 bg-white"></div>
                    </div>
                    <a href="/" class="text-3xl text-white uppercase logo ml-20">bxcars</a>
                    <button
                        class="px-4 py-2 transition-colors border-2 border-white hover:bg-gray-500 hover:text-black rounded-3xl">
                        <a href="login" class="p-2 text-white">Connexion</a>
                    </button>
                </nav>

                @if(isset($car->model_name)) <!-- Correction effectuée ici -->
                <div class="text-center pt-10">
                    <h2 class="text-2xl text-white mb-4">Véhicule sélectionné : {{ $car->model_name }}</h2>
                    @if(isset($car->price_per_day))
                    <p class="text-xl text-white mb-4">Prix par jour : {{ $car->price_per_day }} DH</p>
                    @endif
                </div>
                @endif

                @if(isset($car->photo))
                <div class="w-32 h-32 mx-auto mt-4 mb-8">
                    <img src="{{ Storage::url($car->photo) }}" alt="Photo de {{ $car->model_name }}"
                        class="rounded-full object-cover w-full h-full">
                </div>
                @endif




                @if(session('reservationSuccess'))
                @if(session('success'))
                <div class="fixed top-0 left-0 right-0 bg-green-500 text-white text-center py-2 px-4">
                    {{ session('success') }}
                </div>
                @endif
                <!-- Conteneur de contact affiché après la soumission réussie -->
                <div class="contact-container">
                    <h2>Merci pour votre réservation !</h2>
                    <p>Si vous avez des questions ou si vous avez besoin d'informations supplémentaires, n'hésitez pas à
                        nous contacter.</p>
                    <div>
                        <p>Téléphone : +123456789</p>
                        <p>Email : contact@example.com</p>
                    </div>
                </div>
                @else
                <!-- Conteneur du formulaire -->
                <div class="z-10 flex justify-center items-start mb-0 duration-500">
                    <div
                        class="flex flex-row gap-8 px-12 py-6 text-black shadow-lg bg-white/50 rounded-3xl hover:bg-yellow-400 transition-colors duration-300">
                        <form action="{{ route('reservations.store') }}" method="POST" class="reservation-form">
                            <h1 class="form-title">RÉSERVATION</h1>
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $carId }}">
                            <div class="flex flex-wrap justify-between">
                                <div class="input-group w-full lg:w-1/2">
                                    <input type="text" name="first_name" required placeholder="Nom">
                                    <input type="text" name="last_name" required placeholder="Prénom">
                                    <input type="tel" name="phone" required placeholder="Numéro de téléphone">
                                    <input type="email" name="email" required placeholder="Adresse email">
                                </div>
                                <div class="input-group w-full lg:w-1/2 mt-2">
                                    <select class="text-gray-500" name="pickup_location" required>
                                        <option class="text-gray-500" value="airport">Aéroport</option>
                                        <option class="text-gray-500" value="agency">Agence</option>
                                        <option class="text-gray-500" value="other_city">Autre ville</option>
                                    </select>
                                    <input class="text-gray-500" type="date" name="start_date" required>
                                    <input class="text-gray-500" type="date" name="end_date" required>
                                </div>
                            </div>
                            <div class="flex justify-center">
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
            import "@fontsource/lexend-tera";
        </script>
        <style>
            #selection {
                position: absolute;
                background-color: black;

                transform: translate(-50%, -50%);
            }

            #selection-back {
                position: absolute;
                bottom: -125px;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 1334.89px;
                height: 129.57px;
                background-color: black;
            }

            .icons {
                width: 20px;
            }

            .icons-2 {}

            .logo {
                background-color: black;
                font-family: "Lexend Tera", sans-serif;

            }

            @font-face {
                font-family: "Lexend Tera";
                font-style: normal;
                font-weight: 400;
                font-display: block;
            }

            body {
                background-color: black;
            }

            /* Le reste du CSS reste inchangé */


            .reservation-form {
                display: flex;
                flex-direction: column;
            }

            .form-title {
                font-size: 2rem;
                font-weight: bold;
                margin-bottom: 1.5rem;
                text-align: center;
                color: #333;
            }

            .input-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                padding: 0 1rem;
                /* Ajoute un peu de padding pour l'espacement */
            }

            .input-group input,
            .input-group select {
                border: 1px solid #ccc;
                border-radius: 0.5rem;
                padding: 0.75rem;
                font-size: 1rem;
            }

            .submit-btn {
                background-color: #facc15;
                color: white;
                padding: 0.75rem;
                border-radius: 0.5rem;
                cursor: pointer;
                margin-top: 1rem;
                /* Espacement avant le bouton */
            }

            @media (min-width: 1024px) {

                /* Ajustez selon votre point de rupture */
                .input-group {
                    width: 100%;
                    /* Assure que le groupe d'input prend toute la largeur dans les petits écrans */
                }
        </style>
</body>

</html>