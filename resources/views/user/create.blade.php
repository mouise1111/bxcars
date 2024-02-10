<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyADMIN | BX Cars</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('bxlogo-modified.png') }}">.
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/createcar.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="//unpkg.com/alpinejs" defer></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IM+Fell+Double+Pica+SC&family=Inter&family=Koulen&family=League+Gothic&family=Lobster&family=Playfair+Display+SC&family=Saira+Condensed:wght@600&family=Saira+Stencil+One&family=Waterfall&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="bg-black md:bg-transparent">
    <header>
        <!-- NAVBAR FOR MD -->
        <div x-data="{ open: false }" class="md:hidden md:bg-transparent">
            <div class="flex items-center justify-between px-4 py-8">
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
            </div>

            <!-- Sidebar mobile -->
            <div class="absolute top-0 left-0 w-64 h-screen transition-transform duration-200 transform bg-black"
                style="z-index: 20;" :class="{'-translate-x-full': !open, 'translate-x-0': open}">

                <button @click="open = false" class="p-4 text-white hover:text-red-400">
                    <img src="/close-menu-icon.png" alt="closing the menu button icon" class="w-8 h-8">
                </button>
                <div class="flex flex-col p-4">
                    <!-- Liens de navigation -->
                    <a href="{{ url('/') }}" class="py-2 text-white hover:text-yellow-500">Accueil</a>
                    <a href="{{ url('/services') }}" class="py-2 text-white hover:text-yellow-500">Services</a>
                    <a href="{{ url('/about') }}" class="py-2 text-white hover:text-yellow-500">À propos</a>
                    <a href="{{ url('/contact') }}" class="py-2 text-white hover:text-yellow-500">Contact</a>
                    @if(Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}" class="py-2 text-gray-400 hover:text-yellow-500">Réservations</a>
                    <a href="{{ url('/membres') }}" class="py-2 text-gray-400 hover:text-yellow-500">Membres</a>
                    <a href="{{ url('/cars/create') }}" class="py-2 text-gray-400 hover:text-yellow-500">MyCARS</a>
                    <a href="{{ url('/user/create') }}"
                        class="py-2 text-yellow-500 border-b-2 border-gray-100">MyADMIN</a>
                    <a href="{{ url('/profile') }}" class="py-2 text-gray-400 hover:text-yellow-500">Mon
                        compte</a>
                    <a href="#" class="py-2 text-gray-400 hover:text-yellow-500"
                        onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                        <img class="inline cursor-pointer h-3" src="{{ asset('logout.png') }}" alt="Déconnexion">
                        Déconnexion
                    </a>
                    @endauth
                    @endif
                </div>
            </div>
        </div>
        <!-- NAVBAR FOR DESKTOP -->
        <div class="hidden md:block">
            <nav class="bg-black shadow fixed w-full top-0 z-50 p-2 md:flex md:items-center md:justify-between"
                style="background-color: black;">
                <div class="flex items-center justify-between">
                    <img class="h-10" src="{{ asset('bxlogo.jpg') }}" alt="BXC Logo">
                    <span class="text-3xl cursor-pointer mx-10 mt-2 md:hidden block" onclick="toggleMenu()">
                        <ion-icon name="menu" id="menuIcon"></ion-icon>
                    </span>
                </div>

                <!--Navigation list -->
                <ul class="absolute bg-black w-full left-0 top-[60px] md:static md:flex md:items-center md:py-0 py-4 pl-7 md:pl-0 hidden"
                    id="navbar">
                    <li class="mx-4"><a href="{{ url('/') }}" class="text-white hover:text-yellow-500">Accueil</a></li>
                    <li class="mx-4"><a href="{{ url('/services') }}"
                            class="text-white hover:text-yellow-500">Services</a></li>
                    <li class="mx-4"><a href="{{ url('/about') }}" class="text-white hover:text-yellow-500">À propos</a>
                    </li>
                    <li class="mx-4"><a href="{{ url('/contact') }}"
                            class="text-white hover:text-yellow-500">Contact</a></li>
                    <li class="mx-4"><a href="{{ url('/dashboard') }}"
                            class="text-gray-400 hover:text-yellow-500">Réservations</a></li>
                    <li class="mx-4"><a href="{{ url('/membres') }}"
                            class="text-gray-400 hover:text-yellow-500">Membres</a></li>
                    <li class="mx-4"><a href="{{ url('/cars/create') }}"
                            class="text-gray-400 hover:text-yellow-500">MyCARS</a></li>
                    <li class="mx-4"><a href="{{ url('/user/create') }}" class="text-yellow-500">MyADMIN</a></li>
                </ul>

                <div class="sm:fixed sm:top-0 sm:right-0 p-4 text-right z-10">
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
                </div>
            </nav>
        </div>
    </header>

    <!-- Fais que ce code ne s'affiche que sur mobile -->
    <main class="relative min-h-screen bg-black flex items-center justify-center lg:hidden"
        style="background-image: url('{{ asset('wallpapertanger5.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-6xl md:text-7xl lg:text-8xl font-semibold text-white text-center">MyADMIN</h1>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-semibold text-yellow-500 text-center mt-4 mb-10">Gestion
                d'utilisateurs</h2>
            <div class="bg-black bg-opacity-75 shadow-lg rounded px-10 py-8 mt-10 text-center" style="max-width: 90%;">
                <p class="text-xl font-medium text-white">Pour accéder à cette page, veuillez utiliser un ordinateur.
                </p>
            </div>
        </div>
    </main>

    <!-- Celle ci doit s'afficher que sur desktop -->
    <main class="hidden lg:block relative min-h-screen bg-black"
        style="background-image: url('{{ asset('wallpapertanger5.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="flex items-center justify-center">
            <h1 class="text-8xl font-semibold text-center text-white mt-30">MyADMIN</h1>
            <h2 class="text-4xl font-semibold text-center text-yellow-500 mt-40 mb-10">Gestion d'utilisateurs</h2>
        </div>


        <div class="cars-container px-80 hidden md:block">
            <div class="flex items-center mb-4">
                <h1 class="text-2xl font-semibold text-white mr-5">Ajouter un administrateur</h1>
            </div>
            <p class="text-white mb-5 ">Attention : Veillez à ne pas laisser le tableau sans administrateur.
                L'authentification d'email est désactivé.
            </p>
            <div class="mt-8 flex justify-between bg-gray-800 shadow border-white border-2 rounded-lg mb-20 mt-10">
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
                        <button type="submit"
                            class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-700">Créer
                            l'administrateur</button>
                    </form>
                    @if(session('success'))
                    <div id="successMessage" class="bg-green-500 text-white text-center p-5 rounded mb-2">
                        {{ session('success') }}
                    </div>

                    <script>
                        setTimeout(function () {
                            document.getElementById('successMessage').style.display = 'none';
                        }, 2000);
                    </script>
                    @endif
                </div>

                <div class="w-1/2 bg-yellow-500 mx-auto">
                    <h2 class="text-lg font-semibold mb-4 mt-4 text-center">Administrateurs actuels</h2>
                    <div class="flex justify-center ml-20 mr-20 shadow border-white border-2 rounded-lg mb-10">
                        <table class="min-w-full ">
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
                                                class="flex justify-center items-center bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-300"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="cars-container px-80 rounded-lg shadow border-white border-2 rounded-lg mb-20 mt-10">

                <div class="flex items-center">
                    <h1 class="text-2xl font-semibold text-white mr-5">Code QR</h1>
                    <a href="{{ asset('frame.png') }}" download="BXCarsQR.jpg"
                        class="bg-yellow-500 text-1xl text-white px-5 py-2 rounded transition duration-500 hover:bg-black mt-2">Enregistrer
                        sous JPG</a>
                </div>
                <p class="text-white">Ce code QR qui redirige vers le site www.bxcars.be vous permettra de
                    l'afficher
                    dans des projets extérieurs.
                </p>

                <div class="mt-8 mb-4">
                    <div class="w-1/4 pr-4">
                    </div>

                    {{-- Afficher le code QR --}}
                    <img src="{{ asset('frame.png') }}" alt="Code QR" style="width: 200px;">
                </div>
            </div>
    </main>
</body>