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
    <title>MyCARS - BX Cars</title>

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
                    <a href="{{ url('/cars/create') }}" class="text x1 text-yellow-500"
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

    <div class="flex items-center justify-center mt-20">
        <button class="mt-2 bg-yellow-500 text-2xl text-white px-10 py-3 rounded transition duration-500 hover:bg-black"
            id="openAddModal">Ajouter un véhicule</button>
    </div>
    <div id="myModal" class="modal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
                <h3 class="text-2xl font-bold text-center">Ajout de véhicule</h3>
                <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <div class="mt-4">
                        <label class="block" for="model_name">Nom de modèle</label>
                        <input type="text" name="model_name"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            required autofocus>
                    </div>

                    <div class="mt-4">
                        <label class="block" for="price_per_day_short_term">Prix par jour (Moins ou égal à 3
                            jours)</label>
                        <input type="number" step="0.01" name="price_per_day_short_term"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="block" for="price_per_day_long_term">Prix par jour (Plus de 3 jours)</label>
                        <input type="number" step="0.01" name="price_per_day_long_term"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="block" for="price_caution">Prix de caution</label>
                        <input type="number" step="0.01" name="price_caution"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="block" for="total_km">Total KM</label>
                        <input type="number" name="total_km"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="block" for="transmission">Transmission</label>
                        <select name="transmission"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <label class="block" for="seats">Nombre sièges</label>
                        <input type="number" name="seats"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="block" for="fuel_type">Type de carburant</label>
                        <select name="fuel_type"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                            <option value="Diesel">Diesel</option>
                            <option value="Petrol">Petrol</option>
                            <option value="Electric">Electric</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <label class="block" for="photo">Photo</label>
                        <input type="file" name="photo"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="block" for="disponible">Disponibilité</label>
                        <input type="hidden" name="disponible" value="0">
                        <input type="checkbox" name="disponible" value="1"
                            class="w-4 h-4 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            checked> Oui
                    </div>
                    <div class="flex items-baseline justify-between">
                        <button type="submit"
                            class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Ajouter</button>
                        <button type="button" id="closeModal"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800">Fermer</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="cars-container mt-4 px-80">
        @if(isset($cars))
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-2 text-center">Modèle</th>
                    <th class="px-6 py-2 text-center">Prix/jour (3J)</th>
                    <th class="px-6 py-2 text-center">Prix/jour (+3J)</th>
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
                <tr class="bg-white border-b">
                    <td class="px-6 py-2 text-center">{{ $car->model_name }}</td>
                    <td class="px-6 py-2 text-center">{{ $car->price_per_day_short_term }} DH</td>
                    <td class="px-6 py-2 text-center">{{ $car->price_per_day_long_term }} DH</td>
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
})" class="text-blue-500 hover:text-blue-700">Modifier</button>
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Aucun véhicule disponible.</p>
        @endif
    </div>

    <!-- Modal -->
    <div id="openEditModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Modifier Véhicule</h3>
                <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" id="carId" name="id">

                    <label for="modelName">Nom du Modèle:</label>
                    <input type="text" id="modelName" name="model_name" class="mt-2 border p-2 w-full" required>

                    <label for="pricePerDay">Prix par Jour (-=3J):</label>
                    <input type="number" id="pricePerDayShortTerm" name="price_per_day_short_term"
                        class="mt-2 border p-2 w-full" step="0.01" required>

                    <label for="pricePerDay">Prix par Jour (+3J):</label>
                    <input type="number" id="pricePerDayLongTerm" name="price_per_day_long_term"
                        class="mt-2 border p-2 w-full" step="0.01" required>

                    <label for="priceCaution">Prix de Caution:</label>
                    <input type="number" id="priceCaution" name="price_caution" class="mt-2 border p-2 w-full"
                        step="0.01" required>

                    <label for="totalKm">Total KM:</label>
                    <input type="number" id="totalKm" name="total_km" class="mt-2 border p-2 w-full" required>

                    <label for="transmission">Transmission:</label>
                    <select id="transmission" name="transmission" class="mt-2 border p-2 w-full" required>
                        <option value="Manuel">Manuel</option>
                        <option value="Automatique">Automatique</option>
                    </select>


                    <label for="seats">Nombre de Places:</label>
                    <input type="number" id="seats" name="seats" class="mt-2 border p-2 w-full" required>

                    <label for="fuelType">Type de Carburant:</label>
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
        <h1 class="text-2xl font-semibold text-gray-900">Gestion de la disponibilité du véhicule</h1>
        <div class="mt-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <!-- Centre le texte des en-têtes -->
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Véhicule (Tot. KM)
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Statut
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($cars as $car)
                                    <tr>
                                        <!-- Centre le texte des cellules -->
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                            {{ $car->model_name }} ({{ $car->total_km }})
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            {{ $car->disponible ? 'Disponible' : 'En location' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                            <form method="POST"
                                                action="{{ route('admin.cars.toggle_availability', $car->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-indigo-600 hover:text-indigo-900">
                                                    {{ $car->disponible ? 'Rendre indisponible' : 'Rendre disponible' }}
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
    </div>


</main>
<script src="{{ asset('js/create.js') }}"></script>