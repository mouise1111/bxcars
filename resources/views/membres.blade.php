<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membres | BX Cars</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('bxlogo-modified.png') }}">.
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IM+Fell+Double+Pica+SC&family=Inter&family=Koulen&family=League+Gothic&family=Lobster&family=Playfair+Display+SC&family=Saira+Condensed:wght@600&family=Saira+Stencil+One&family=Waterfall&display=swap"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>


    @vite('resources/css/app.css')
</head>

<body class=" md:bg-transparent"
    style="background-image: url('{{ asset('wallpapertanger.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
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
                    <a href="{{ url('/membres') }}" class="py-2 text-yellow-500 border-b-2 border-gray-100">Membres</a>
                    <a href="{{ url('/cars/create') }}" class="py-2 text-gray-400 hover:text-yellow-500">MyCARS</a>
                    <a href="{{ url('/user/create') }}" class="py-2 text-gray-400 hover:text-yellow-500">MyADMIN</a>
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
                    <li class="mx-4"><a href="{{ url('/membres') }}" class="text-yellow-500">Membres</a></li>
                    <li class="mx-4"><a href="{{ url('/cars/create') }}"
                            class="text-gray-400 hover:text-yellow-500">MyCARS</a></li>
                    <li class="mx-4"><a href="{{ url('/user/create') }}"
                            class="text-gray-400 hover:text-yellow-500">MyADMIN</a></li>
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


    <div class="mt-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @if(session('success'))
        <div id="successMessage"
            class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-center p-5 rounded-md z-50">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function () {
                document.getElementById('successMessage').style.display = 'none';
            }, 3000);
        </script>
        @endif
        <h1 class="text-7xl font-semibold text-white mb-4">L'équipe BX Cars</h1>
        <p class="text-white mb-6">Vous pouvez fréquemment changer le tableau. Il est automatiquement mis à jour sur
            la page "À propos". </p>
        <div class=" text-white flex flex-col lg:flex-row justify-center items-start lg:items-center py-8">
            <div class="max-w-md mx-4 mb-8 p-6 rounded-lg shadow border-white border-2 rounded-lg">
                <h2 class="text-2xl font-semibold text-center mb-6">Ajouter un nouveau membre</h2>

                {{-- Affichage des erreurs de validation --}}
                @if ($errors->any())
                <div class="border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Erreur!</strong>
                    <span class="block sm:inline">Veuillez vérifier le formulaire ci-dessous.</span>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Formulaire de création d'un membre --}}
                <form action="{{ route('membres.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf {{-- Token CSRF pour la sécurité --}}

                    <div>
                        <label for="nom" class="block text-sm font-medium text-white">Nom:</label>
                        <input type="text"
                            class="text-gray-800 form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            id="nom" name="nom" required>
                    </div>

                    <div>
                        <label for="fonction" class="block text-sm font-medium text-white">Fonction:</label>
                        <input type="text"
                            class="text-gray-800 form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            id="fonction" name="fonction" required>
                    </div>

                    <div>
                        <label for="language" class="block text-sm font-medium text-white">Langues:</label>
                        <input type="text"
                            class="text-gray-800 form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            id="language" name="language" placeholder="Exemple : Français, Anglais" required>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Ajouter
                    </button>
                </form>
            </div>
            <div class="max-w-4xl mx-auto p-4 sm:p-6 rounded-lg shadow overflow-hidden border-white border-2">
                <h3 class="text-xl sm:text-2xl font-semibold mb-4">Membres existants</h3>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-3 py-3 border-b-2 border-gray-200 text-yellow-500 bg-gray-800 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th
                                    class="px-3 py-3 border-b-2 border-gray-200 text-yellow-500 bg-gray-800 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Fonction
                                </th>
                                <th
                                    class="px-3 py-3 border-b-2 border-gray-200 text-yellow-500 bg-gray-800 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Langues
                                </th>
                                <th
                                    class="px-3 py-3 border-b-2 border-gray-200 text-yellow-500 bg-gray-800 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($membres as $membre)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm text-white bg-gray-800">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="whitespace-no-wrap">{{ $membre->nom }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm bg-gray-800">
                                    <p class="text-white whitespace-no-wrap">{{ $membre->fonction }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm bg-gray-800">
                                    <p class="text-white whitespace-no-wrap">{{ $membre->language }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm bg-gray-800">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('membres.edit', $membre->id) }}"
                                            class="mt-3 inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out h-10 align-middle">Modifier</a>
                                        <form action="{{ route('membres.destroy', $membre->id) }}" method="POST"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="mt-3 inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out h-10 align-middle">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <!-- Laisser vide car le message est affiché en dehors de la table -->
                            @endforelse
                        </tbody>
                    </table>
                    @if($membres->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-lg text-yellow-500">Il n'y a actuellement aucune personne ajoutée dans
                            l'équipe BX Cars.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </main>



</body>

</html>