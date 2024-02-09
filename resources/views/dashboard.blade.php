<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Réservations | BX Cars</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('bxlogo-modified.png') }}">.

    <link href="/bxlogo-modified.png" sizes="32x32" rel="stylesheet" />

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

<body class="bg-black">
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
                        <a href="{{ url('/services') }}" class="text x1 hover:text-yellow-500 duration-500"
                            style="background-color: black;">Services</a>
                    </li>
                    <li class="mx-4 my-0 md:my-0 bg-black">
                        <a href="{{ url('/about') }}" class="text x1 hover:text-yellow-500 duration-500"
                            style="background-color: black;">À propos</a>
                    </li>
                    <li class="mx-4 my-0 md:my-0 bg-black">
                        <a href="{{ url('/contact') }}" class="text x1 hover:text-yellow-500 duration-500"
                            style="background-color: black;">Contact</a>
                    </li>
                    |
                    <li class="mx-4 my-0 md:my-0 bg-black">
                        <a href="{{ url('/dashboard') }}" class="text x1 text-yellow-500"
                            style="background-color: black;">Réservations</a>
                    </li>
                    <li class="mx-4 my-0 md:my-0 bg-black">
                        <a href="{{ url('/membres') }}" class="text x1 text-gray-400 hover:text-yellow-500 duration-500"
                            style="background-color: black;">Membres</a>
                    </li>
                    <li class="mx-4 my-0 md:my-0 bg-black">
                        <a href="{{ url('/cars/create') }}"
                            class="text x1 text-gray-400 hover:text-yellow-500 duration-500"
                            style="background-color: black;">MyCARS</a>
                    </li>
                    <li class="mx-4 my-0 md:my-0 bg-black">
                        <a href="{{ url('/user/create') }}"
                            class="text x1 text-gray-400 hover:text-yellow-500 duration-500"
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
        style="background-image: url('{{ asset('wallpapertanger.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
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

        <div class="mt-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-3xl font-semibold text-white mb-4">Réservations en attente</h1>
            <p class="text-white mb-6">Les acceptations de demandes en attente envoient un message automatique et
                génèrent un document PDF pour le client. Elles bloquent également les dates sélectionnées.</p>
            <div class="shadow-md overflow-hidden border border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Nom
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Véhicule
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Numéro de téléphone
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Lieu de prise
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Date de début
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Date de fin
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Total DH
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class=" divide-y divide-gray-200">
                        @foreach($reservations->where('status', 'pending') as $reservation)
                        <tr>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->first_name }} {{ $reservation->last_name }}
                            </td>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->car->model_name ?? 'N/A' }}<br>{{
                                $reservation->car->total_km ?? 'N/A' }} KM
                            </td>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->phone }}
                            </td>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->email }}
                            </td>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ ucfirst($reservation->pickup_location) }}
                            </td>

                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm text-yellow-500">
                                {{ \Carbon\Carbon::parse($reservation->start_date)->translatedFormat('j
                                F Y') }}
                            </td>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm text-yellow-500">
                                {{ \Carbon\Carbon::parse($reservation->end_date)->translatedFormat('j
                                F Y') }}

                            </td>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ number_format($reservation->total_cost, 0, '.','') }} DH
                            </td>
                            <td class="pt-8 bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form method="POST" action="{{ route('admin.reservations.accept', $reservation->id) }}"
                                    class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class=" text-white w-32 bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        Accepter</button>
                                </form>
                                <form method="POST" action="{{ route('reservations.reject', $reservation->id) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande de réservation ?');"
                                        class="text-white w-32 bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-500 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Rejeter
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($reservations->where('status', 'pending')->isEmpty())
                <div class="text-center py-8">
                    <p class="text-lg text-yellow-500">Il n'y a pour l'instant aucune réservation en attente.</p>
                </div>
                @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <!-- Table headers -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($reservations->where('status', 'pending') as $reservation)
                        <tr>
                            <!-- Reservation data -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

            </div>
        </div>


        <div class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-3xl font-semibold text-white mb-4">Réservations confirmées</h1>
            <p class="text-white mb-6">Les annulations envoient un message automatique au client, le notifiant de
                l'annulation de sa
                réservation.</p>
            <div class="shadow-md overflow-hidden border border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider ">
                                Nom</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Véhicule</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Numéro de téléphone
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Montant</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Date de début
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Date de fin
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-yellow-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class=" divide-y divide-gray-200">
                        @foreach($reservations->where('status', 'accepted') as $reservation)
                        <tr>
                            <td class=" bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->first_name }} {{ $reservation->last_name }}
                            </td>
                            <td
                                class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white flex flex-col items-center justify-center">
                                <div>{{ $reservation->car->model_name ?? 'N/A' }}<br>{{ $reservation->car->total_km ??
                                    'N/A' }} KM</div>
                                <form action="{{ route('admin.cars.toggle_availability', $reservation->car->id) }}"
                                    method="POST" class="w-full mt-4">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex flex-col items-center justify-center">
                                        <div class=" flex items-center mb-2">
                                            <input type="radio" name="disponible" value="1" {{
                                                $reservation->car->disponible ? 'checked' : '' }} id="disponible">
                                            <label for="disponible" class="ml-2 text-green-500">Disponible</label>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <input type="radio" name="disponible" value="0" {{
                                                !$reservation->car->disponible ? 'checked' : '' }} id="indisponible">
                                            <label for="indisponible" class="ml-2 text-red-500">Indisponible</label>
                                        </div>
                                        <button type="submit"
                                            class="px-4 py-2 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">Mettre
                                            à jour</button>
                                    </div>
                                </form>
                            </td>

                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->phone }}
                            </td>
                            </td>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ number_format($reservation->total_cost, 0, '.','') }} DH
                            </td>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm text-yellow-500">
                                {{ \Carbon\Carbon::parse($reservation->start_date)->translatedFormat('j
                                F Y') }}
                            </td>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm text-yellow-500">
                                {{ \Carbon\Carbon::parse($reservation->end_date)->translatedFormat('j F
                                Y') }}
                            </td>

                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-sm text-white bg-red-500 rounded"
                                        onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                                        Annuler
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($reservations->where('status', 'accepted')->isEmpty())
                <div class="text-center py-8">
                    <p class="text-lg text-yellow-500">Il n'y a pour l'instant aucune réservation confirmée.</p>
                </div>
                @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <!-- Table headers -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($reservations->where('status', 'accepted') as $reservation)
                        <tr>
                            <!-- Reservation data -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

        <script src="{{ asset('js/dashboard.js') }}"></script>
</body>