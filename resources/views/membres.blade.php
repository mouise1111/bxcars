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

<body>
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
    <main>
        <div class="min-h-screen bg-gray-100 flex flex-col lg:flex-row justify-center items-start lg:items-center py-8">
            <div class="bg-white max-w-md mx-4 mb-8 p-6 rounded-lg shadow">
                <h2 class="text-2xl font-semibold text-center mb-6">Ajouter un nouveau membre</h2>

                {{-- Affichage des erreurs de validation --}}
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
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
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom:</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            id="nom" name="nom" required>
                    </div>

                    <div>
                        <label for="fonction" class="block text-sm font-medium text-gray-700">Fonction:</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            id="fonction" name="fonction" required>
                    </div>

                    <div>
                        <label for="language" class="block text-sm font-medium text-gray-700">Langues:</label>
                        <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            id="language" name="language" placeholder="Exemple : Français, Anglais" required>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Ajouter
                    </button>
                </form>

                @if(session('success'))
                <div class="mt-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p class="font-bold">Succès</p>
                    <p>{{ session('success') }}</p>
                </div>
                @endif
            </div>
            <div class="max-w-4xl mx-4 bg-white p-6 rounded-lg shadow overflow-hidden">
                <h3 class="text-2xl font-semibold mb-4">Membres existants</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Fonction
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Langues
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($membres as $membre)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $membre->nom }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $membre->fonction }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $membre->language }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex items-center">
                                    <a href="{{ route('membres.edit', $membre->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Éditer</a>
                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('membres.destroy', $membre->id) }}" method="POST"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            SUPPRIMER
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Edit Membre -->
        <div x-data="{ open: false, membre: {} }" @edit-membre.window="membre = $event.detail; open = true;">
            <template x-if="open">
                <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Overlay -->
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
                        </div>

                        <!-- Modal content -->
                        <input type="hidden" name="_method" value="PUT">
                        <div
                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">

                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                            Modifier Membre
                                        </h3>
                                        <form x-on:submit.prevent="submitForm">
                                            @csrf
                                            @method('PUT')
                                            <div class="mt-2">
                                                <input type="hidden" name="membre_id" x-model="membre.id">
                                                <input type="text" x-model="membre.nom" name="nom"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    required>
                                                <input type="text" x-model="membre.fonction" name="fonction"
                                                    class="mt-3 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    required>
                                                <input type="text" x-model="membre.language" name="language"
                                                    class="mt-3 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    required>
                                            </div>
                                            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <button type="submit"
                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Modifier
                                                </button>
                                                <button type="button" x-on:click="open = false"
                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Annuler
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <script>
                document.addEventListener('edit-membre', event => {
                    console.log('edit-membre event caught!', event.detail);
                });
            </script>

    </main>