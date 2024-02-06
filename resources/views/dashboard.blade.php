<!-- resources/views/cars/create.blade.php -->
<div class="container">
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
                        <a href="{{ url('/dashboard') }}" class="text x1 text-yellow-500"
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
        {{-- resources/views/admin/reservations.blade.php --}}

        <div class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-2xl font-semibold text-gray-900">Réservations en attente</h1>
            <div class="mt-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nom
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Véhicule
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Numéro de téléphone
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Email
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Lieu de prise
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date de début
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date de fin
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Total DH
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($reservations->where('status', 'pending') as $reservation)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $reservation->first_name }} {{ $reservation->last_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $reservation->car->model_name ?? 'N/A' }}<br>{{
                                                $reservation->car->total_km ?? 'N/A' }} KM
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $reservation->phone }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $reservation->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ ucfirst($reservation->pickup_location) }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($reservation->start_date)->translatedFormat('j
                                                F Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($reservation->end_date)->translatedFormat('j
                                                F Y') }}

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ number_format($reservation->total_cost, 0, '.','') }} DH
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form method="POST"
                                                    action="{{ route('admin.reservations.accept', $reservation->id) }}"
                                                    class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="text-white w-32 bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                        Accepter</button>
                                                </form>
                                                <form action="{{ route('reservations.reject', $reservation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir rejeter la réservation de {{ $reservation->first_name }} {{ $reservation->last_name }} pour la {{ $reservation->car->model_name ?? 'N/A' }} ?');"
                                                        class="text-white w-32 bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-500 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                        Rejeter
                                                    </button>
                                                    @if(session('success'))
                                                    <div
                                                        class="fixed top-0 left-0 right-0 bg-green-500 text-white text-center py-2 px-4 z-50 success-message">
                                                        {{ session('success') }}
                                                    </div>
                                                    @endif
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

        <div class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-2xl font-semibold text-gray-900">Réservations confirmées</h1>
            <div class="mt-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nom</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Véhicule</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Montant</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date de début
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date de fin
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($reservations->where('status', 'accepted') as $reservation)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $reservation->first_name }} {{ $reservation->last_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $reservation->car->model_name ?? 'N/A' }}<br>{{
                                                $reservation->car->total_km ?? 'N/A' }} KM
                                                <form
                                                    action="{{ route('admin.cars.toggle_availability', $reservation->car->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mt-4">
                                                        <label class="inline-flex items-center">
                                                            <input type="radio" name="disponible" value="1" {{
                                                                $reservation->car->disponible ? 'checked' : '' }}>
                                                            <span class="ml-2">Disponible</span>
                                                        </label>
                                                        <label class="inline-flex items-center">
                                                            <input type="radio" name="disponible" value="0" {{
                                                                !$reservation->car->disponible ? 'checked' : '' }}>
                                                            <span class="ml-2">Indisponible</span>
                                                        </label>
                                                    </div>
                                                    <button type="submit"
                                                        class="mt-2 px-4 py-2 text-sm text-white bg-blue-500 rounded">Mettre
                                                        à jour</button>
                                                </form>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ number_format($reservation->total_cost, 0, '.','') }} DH
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($reservation->start_date)->translatedFormat('j
                                                F Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($reservation->end_date)->translatedFormat('j F
                                                Y') }}
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
        <script src="{{ asset('js/dashboard.js') }}"></script>
</body>