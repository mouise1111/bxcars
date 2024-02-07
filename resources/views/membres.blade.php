<div class="container2">
    @yield('content')
</div>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Réservations - BX Cars</title>
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

<body class="bg-black">
    @if(session('success'))
    <div class="mt-20 top-0 left-0 right-0 bg-green-500 text-white text-center py-2" role="alert">
        <p class="font-bold">Succès</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif
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
                        <a href="{{ url('/membres') }}" class="text x1 text-yellow-500"
                            style="background-color: black;">Membres</a>
                    </li>
                    <li class="mx-4 my-0 md:my-0 bg-black">
                        <a href="{{ url('/cars/create') }}" class="text x1 hover:text-yellow-500 duration-500"
                            style="background-color: black;">MyCARS</a>
                    </li>
                </ul>
                <div class="sm:fixed sm:top-0 sm:right-0 p-4 text-right z-10">
                    @if (Route::has('login'))
                    @auth
                    <span class="text-white pr-4 hover:text-yellow-500"
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
        style="background-image: url('{{ asset('wallpapertanger2.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="pt-60 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-7xl font-semibold text-white mb-4">L'équipe BX Cars</h1>
            <p class="text-white mb-6">Vous pouvez fréquemment changer le tableau. Il est automatiquement mis à jour sur
                la page "A propos". </p>
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
                            <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                id="nom" name="nom" required>
                        </div>

                        <div>
                            <label for="fonction" class="block text-sm font-medium text-white">Fonction:</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                id="fonction" name="fonction" required>
                        </div>

                        <div>
                            <label for="language" class="block text-sm font-medium text-white">Langues:</label>
                            <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                id="language" name="language" placeholder="Exemple : Français, Anglais" required>
                        </div>

                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Ajouter
                        </button>
                    </form>
                </div>
                <div class="max-w-4xl mx-4 p-6 rounded-lg shadow overflow-hidden border-white border-2 rounded-lg">
                    <h3 class="text-2xl font-semibold mb-4">Membres existants</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal border-white border-2 rounded-lg">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 text-yellow-500 bg-gray-800 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nom
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 text-yellow-500 bg-gray-800 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Fonction
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 text-yellow-500 bg-gray-800 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Langues
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 text-yellow-500 bg-gray-800 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($membres as $membre)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm text-white bg-gray-800">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <p class=" whitespace-no-wrap ">
                                                    {{ $membre->nom }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm bg-gray-800">
                                        <p class="text-gray-900 whitespace-no-wrap text-white bg-gray-800">{{
                                            $membre->fonction }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm bg-gray-800">
                                        <p class="text-gray-900 whitespace-no-wrap text-white">{{ $membre->language }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200  text-sm bg-gray-800">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('membres.edit', $membre->id) }}"
                                                class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out h-10 align-middle">Modifier</a>
                                            <form action="{{ route('membres.destroy', $membre->id) }}" method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?');"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="mt-3 inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out h-10 align-middle">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('edit-membre', event => {
                console.log('edit-membre event caught!', event.detail);
            });
        </script>

    </main>