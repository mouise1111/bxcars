<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyCARS | BX Cars</title>
    <link rel="icon" type="image/png" href="/bxlogo-modified.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/createcar.css') }}">
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IM+Fell+Double+Pica+SC&family=Inter&family=Koulen&family=League+Gothic&family=Lobster&family=Playfair+Display+SC&family=Saira+Condensed:wght@600&family=Saira+Stencil+One&family=Waterfall&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class=" md:bg-transparent">
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
                    <a href="{{ url('/cars/create') }}"
                        class="py-2 text-yellow-500 border-b-2 border-gray-100">MyCARS</a>
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
                    <li class="mx-4"><a href="{{ url('/membres') }}"
                            class="text-gray-400 hover:text-yellow-500">Membres</a></li>
                    <li class="mx-4"><a href="{{ url('/cars/create') }}" class="text-yellow-500">MyCARS</a></li>
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

    <main class="relative min-h-screen bg-black"
        style="background-image: url('{{ asset('wallpapertanger5.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        @if(session('success'))
        <div id="successMessage"
            class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-center p-5 rounded-md z-50">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function () {
                document.getElementById('successMessage').style.display = 'none';
            }, 8000); // Le message disparaîtra après 8 secondes
        </script>
        @endif

        <<div class="flex flex-col items-center justify-center mt-20 md:mt-40">
            <h1 class="text-4xl md:text-6xl lg:text-8xl font-semibold text-center text-white">MyCARS</h1>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-semibold text-center text-yellow-500 mt-5 md:mt-20">Gestion
                de
                véhicules</h2>
            </div>


            <div id="myModal" class="modal">
                <div class="flex items-center justify-center min-h-screen ">
                    <div class="px-8 py-6 mt-4 text-left bg-gray-800 shadow-lg border-white border-2 rounded-lg ">
                        <h3 class="text-2xl font-bold text-center text-yellow-500">AJOUT DE VÉHICULE</h3>
                        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data"
                            class="mt-4">
                            @csrf
                            <div class="mt-4">
                                <label class="block text-white" for="model_name">Nom de modèle (Modèle et année)</label>
                                <input type="text" name="model_name"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    required autofocus>
                            </div>

                            <div class="mt-4">
                                <label class="block text-white" for="price_per_day_short_term">Prix DH par jour (Moins
                                    ou
                                    égal à
                                    3
                                    jours)</label>
                                <input type="number" step="0.01" name="price_per_day_short_term"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    required>
                            </div>

                            <div class="mt-4">
                                <label class="block text-white" for="price_per_day_long_term">Prix DH par jour (Plus de
                                    3
                                    jours)</label>
                                <input type="number" step="0.01" name="price_per_day_long_term"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    required>
                            </div>

                            <div class="mt-4">
                                <label class="block text-white" for="price_caution">Prix de caution</label>
                                <input type="number" step="0.01" name="price_caution"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    required>
                            </div>

                            <div class="mt-4">
                                <label class="block text-white" for="total_km">Total KM</label>
                                <input type="number" name="total_km"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    required>
                            </div>

                            <div class="mt-4">
                                <label class="block text-white" for="transmission">Transmission</label>
                                <select name="transmission"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <option value="Manual">Manuelle</option>
                                    <option value="Automatic">Automatique</option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <label class="block text-white" for="seats">Nombre sièges</label>
                                <input type="number" name="seats"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    required>
                            </div>

                            <div class="mt-4">
                                <label class="block text-white" for="fuel_type">Type de carburant</label>
                                <select name="fuel_type"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <option value="Diesel">Diesel</option>
                                    <option value="Petrol">Essence</option>
                                    <option value="Electric">Electrique</option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <label class="block text-white" for="photo">Photo</label>
                                <input type="file" name="photo"
                                    class="text-white w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    required>
                            </div>

                            <div class="mt-4 text-white">
                                <label class="block" for="disponible">Disponibilité</label>
                                <input type="hidden" name="disponible" value="0">
                                <input type="checkbox" name="disponible" value="1"
                                    class="w-4 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    checked>
                                Oui
                            </div>
                            <div class="flex items-baseline justify-between">
                                <button type="submit"
                                    class="px-6 py-2 mt-4 text-white bg-yellow-500 rounded-lg hover:bg-yellow-900">Ajouter</button>
                                <button type="button" id="closeModal"
                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800">Fermer</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div>{{ session('success') }}</div>
            @endif


            <div class="flex items-center justify-center mt-10 p-8 shadow-md rounded">
                <form method="POST" action="{{ url('/admin/paragraph/update') }}"
                    class="w-full max-w-2xl mx-auto space-y-4 md:flex md:items-center md:space-y-0 md:space-x-4">
                    @csrf
                    <div class="flex-1">
                        <label for="content" class="block text-sm font-medium text-white">Message flash sur l'accueil
                            :</label>
                        <textarea id="content" name="content"
                            class="bg-gray-900 text-white mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            rows="4">{{ $paragraph->content ?? '' }}</textarea>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 font-medium text-white bg-yellow-500 rounded hover:bg-yellow-700 md:self-end">Enregistrer</button>
                </form>
            </div>


            <div class="cars-container mt-4 px-4 md:px-10 lg:px-20 xl:px-80">
                <div class="flex items-center mb-4">
                    <h1 class="text-2xl font-semibold text-white mr-5">Véhicules disponibles</h1>
                    <button
                        class="bg-yellow-500 text-1xl text-white px-5 py-2 rounded transition duration-500 hover:bg-black"
                        id="openAddModal">Ajouter un véhicule</button>
                </div>
                <p class="text-white mb-5">Attention : Assurez-vous de ne pas supprimer de véhicule actuellement loué
                    par un
                    client.
                </p>
                @if(isset($cars))
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full table-auto border-collapse rounded-lg shadow overflow-hidden border-white border-4">
                        <thead class="bg-gray-800 text-white rounded-lg shadow overflow-hidden border-white border-3">
                            <tr>
                                <th class="px-6 py-2 text-center">Modèle</th>
                                <th class="px-6 py-2 text-center">Prix DH/jour (3J)</th>
                                <th class="px-6 py-2 text-center">Prix DH/jour (+3J)</th>
                                <th class="px-6 py-2 text-center">Caution</th>
                                <th class="px-6 py-2 text-center">Total KM</th>
                                <th class="px-6 py-2 text-center">Transmission</th>
                                <th class="px-6 py-2 text-center">Sièges</th>
                                <th class="px-6 py-2 text-center">Carburant</th>
                                <th class="px-6 py-2 text-center">Image</th>
                                <th class="px-6 py-2 text-center">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $car)
                            <tr class="bg-yellow-500 border-b">
                                <td class="px-6 py-2 text-center">{{ $car->model_name }}</td>
                                <td class="px-6 py-2 text-center">{{ number_format($car->price_per_day_short_term, 0,
                                    '.',
                                    '')
                                    }} DH
                                </td>
                                <td class="px-6 py-2 text-center">{{ number_format($car->price_per_day_long_term, 0,
                                    '.',
                                    '') }}
                                    DH
                                </td>
                                <td class="px-6 py-2 text-center">{{ $car->price_caution }} DH</td>
                                <td class="px-6 py-2 text-center">{{ $car->total_km }} KM</td>
                                <td class="px-6 py-2 text-center">{{ $car->transmission }}</td>
                                <td class="px-6 py-2 text-center">{{ $car->seats }}</td>
                                <td class="px-6 py-2 text-center">{{ $car->fuel_type }}</td>
                                <td class="px-6 py-2 text-center">
                                    @if($car->photo)
                                    <img class="w-20 h-20 object-cover mx-auto" src="{{ Storage::url($car->photo) }}"
                                        alt="Car Image">
                                    @endif
                                </td>
                                <td class="px-6 py-2 text-center">
                                    <button onclick="openEditModal({
    id: '{{ $car->id }}',
    model_name: '{{ $car->model_name }}',
    price_per_day_short_term: '{{ $car->price_per_day_short_term }}',
    price_per_day_long_term: '{{ $car->price_per_day_long_term }}',
    price_caution: '{{ $car->price_caution }}',
    total_km: '{{ $car->total_km }}',
    transmission: '{{ $car->transmission }}',
    seats: '{{ $car->seats }}',
    fuel_type: '{{ $car->fuel_type }}',
    photo: '{{ $car->photo ? Storage::url($car->photo) : '' }}'
})" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-300">Modifier</button>
                                    <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer la {{ $car->model_name }} ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p>Aucun véhicule disponible.</p>
                @endif
            </div>


            <!-- Modal -->
            <div id="openEditModal"
                class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-gray-800">
                    <div class="mt-3 text-center">
                        <h3 class="text-lg leading-6 font-medium text-yellow-500 mb-5" id="modal-title">MODIFICATION DE
                            VÉHICULE
                        </h3>
                        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" id="carId" name="id">

                            <label for="modelName" class="text-white">Nom du Modèle:</label>
                            <input type="text" id="modelName" name="model_name" class="mt-2 border p-2 w-full" required>

                            <label for="pricePerDay" class="text-white">Prix DH par Jour (-=3J):</label>
                            <input type="number" id="pricePerDayShortTerm" name="price_per_day_short_term"
                                class="mt-2 border p-2 w-full" step="0.01" required>

                            <label for="pricePerDay" class="text-white">Prix DH par Jour (+3J):</label>
                            <input type="number" id="pricePerDayLongTerm" name="price_per_day_long_term"
                                class="mt-2 border p-2 w-full" step="0.01" required>

                            <label for="priceCaution" class="text-white">Prix de Caution:</label>
                            <input type="number" id="priceCaution" name="price_caution" class="mt-2 border p-2 w-full"
                                step="0.01" required>

                            <label for="totalKm" class="text-white">Total KM:</label>
                            <input type="number" id="totalKm" name="total_km" class="mt-2 border p-2 w-full" required>

                            <label for="transmission" class="text-white">Transmission:</label>
                            <select id="transmission" name="transmission" class="mt-2 border p-2 w-full" required>
                                <option value="Manuel">Manuel</option>
                                <option value="Automatique">Automatique</option>
                            </select>


                            <label for="seats" class="text-white">Nombre de Places:</label>
                            <input type="number" id="seats" name="seats" class="mt-2 border p-2 w-full" required>

                            <label for="fuelType" class="text-white">Type de Carburant:</label>
                            <select id="fuelType" name="fuel_type" class="mt-2 border p-2 w-full" required>
                                <option value="Diesel">Diesel</option>
                                <option value="Essence">Essence</option>
                                <option value="Electrique">Electrique</option>
                            </select>

                            <div class="mt-5" id="currentPhotoContainer"></div>


                            <select id="disponible" name="disponible" class="mt-2 border p-2 w-full" required>
                                <option value="1">Disponible</option>
                                <option value="0">Indisponible</option>
                            </select>

                            <!-- Boutons Modifier et Fermer -->
                            <div class="items-center px-4 py-3 flex justify-between">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                    Modifier
                                </button>
                                <button type="button" id="closeEditModal"
                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800">
                                    Fermer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <h1 class="text-2xl font-semibold text-white">Gestion de la disponibilité du véhicule</h1>
                <p class="text-white mb-4 mt-4">Attention : La voiture restera disponible à la location, mais sera
                    affichée
                    comme
                    indisponible aujourd'hui tant que l'action déclenchée restera activée.
                </p>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-800">
                                        <tr>
                                            <!-- Centre le texte des en-têtes -->
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                                Véhicule (Tot. KM)
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                                Statut
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-yellow-500 divide-y divide-gray-200">
                                        @foreach ($cars as $car)
                                        <tr>
                                            <!-- Centre le texte des cellules -->
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                                {{ $car->model_name }} ({{ $car->total_km }})
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-center">
                                                {{ $car->disponible ? 'Disponible' : 'En location' }}
                                            </td>
                                            <td class=" text-center">
                                                <form method="POST"
                                                    action="{{ route('admin.cars.toggle_availability', $car->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="mt-3 px-1 py-2 bg-blue-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                                        {{ $car->disponible ? 'Rendre indisponible' : 'Rendre
                                                        disponible' }}
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
                </div>
            </div>


    </main>
    <script src=" {{ asset('js/create.js') }}"></script>