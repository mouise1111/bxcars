<!-- resources/views/cars/create.blade.php -->
<div class="container">
    @yield('content')
</div>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyADMIN - BX Cars</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/createcar.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IM+Fell+Double+Pica+SC&family=Inter&family=Koulen&family=League+Gothic&family=Lobster&family=Playfair+Display+SC&family=Saira+Condensed:wght@600&family=Saira+Stencil+One&family=Waterfall&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<header>
    <nav class="p-2 bg-black shadow md:flex md:items-center md:justify-between fixed w-full top-0 z-50"
        style="background-color: black;">
        <div class="flex items-center justify-between">
            <img class="h-10 inline" src="{{ asset('bxlogo.jpg') }}" alt="BXC Logo">
            <span class="text-3xl cursor-pointer mx-10 mt-2 md:hidden block" onclick="toggleMenu()">
                <ion-icon name="menu" id="menuIcon"></ion-icon>
            </span>

            <!--Navigation list -->
            <ul class="md:flex md:items-center md:static absolute bg-black w-full left-0 md:py-0 py-4 md:pl-0 pl-7 top-[60px] hidden"
                style="background-color: black;">
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/') }}" class="text x1 hover:text-yellow-500 duration-500">Accueil</a>
                </li>
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/dashboard') }}" class="text x1 hover:text-yellow-500 duration-500"
                        style="background-color: black;">Réservations</a>
                </li>
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/membres') }}" class="text x1 hover:text-yellow-500 duration-500"
                        style="background-color: black;">Membres</a>
                </li>
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/cars/create') }}" class="text x1 hover:text-yellow-500 duration-500"
                        style="background-color: black;">MyCARS</a>
                </li>
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/user/create') }}" class="text x1 text-yellow-500"
                        style="background-color: black;">MyADMIN</a>
                </li>
            </ul>
            <div class="sm:fixed sm:top-0 sm:right-0 p-4 text-right z-10">
                @if (Route::has('login'))
                @auth

                <span class="text-white pr-4 hover:text-yellow-500" style="cursor: pointer;"
                    onclick="window.location.href='{{ url('profile') }}'">{{ Auth::user()->name }}</span>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img class="h-7 inline cursor-pointer" src="{{ asset('logout.png') }}" alt="Déconnexion">
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth
                @endif
            </div>
    </nav>
</header>


<main class="relative min-h-screen bg-black"
    style="background-image: url('{{ asset('wallpapertanger5.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <div class="flex items-center justify-center">
        <h1 class="text-8xl font-semibold text-center text-white mt-40">MyADMIN</h1>
        <h2 class="text-4xl font-semibold text-center text-yellow-500 mt-40 mb-20">Gestion d'utilisateurs</h1>
    </div>



    <div class="cars-container mt-4 px-80 ">
        <div class="flex items-center mb-4">
            <h1 class="text-2xl font-semibold text-white mr-5">Ajouter un administrateur</h1>
        </div>
        <p class="text-white mb-5 ">Attention : Veillez à ne pas laisser le tableau sans administrateur.
            L'authentification d'email est désactivé.
        </p>
        <div class="mt-8 flex justify-between bg-gray-800">
            <div class="w-1/2 pr-4">
                <form method="POST" action="{{ route('user.store') }}" class="space-y-4 ml-5 mr-5">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-white">Nom :</label>
                        <input type="text" name="name" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-white">Email :</label>
                        <input type="email" name="email" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-white">Mot de passe :</label>
                        <input type="password" name="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-700">Créer
                        l'administrateur</button>
                </form>
            </div>

            <div class="w-1/2 pl-4 bg-yellow-500">
                <h2 class="text-lg font-semibold mb-4 mt-4">Administrateurs actuels</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Nom
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="cars-container mt-4 px-80 ">
            <div class="flex items-center mb-4">
                <h1 class="text-2xl font-semibold text-white mr-5">Code QR : www.bxcars.be</h1>
            </div>
            <p class="text-white mb-5 ">Attention : Veillez à ne pas laisser le tableau sans administrateur.
                L'authentification d'email est désactivé.
            </p>
            <div class="mt-8 flex justify-between">
                <div class="w-1/4 pr-4">
                </div>

                {{-- Afficher le code QR --}}
                <img src="{{ asset('frame.png') }}" alt="Code QR">

                {{-- Lien pour télécharger le code QR --}}
                <a href="{{ asset('frame.png') }}" download="MonCodeQR.jpg">Télécharger le Code
                    QR</a>
            </div>
        </div>