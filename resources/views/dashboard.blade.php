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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
                    <a href="{{ url('/dashboard') }}"
                        class="py-2 text-yellow-500 border-b-2 border-gray-100">Réservations</a>
                    <a href="{{ url('/membres') }}" class="py-2 text-gray-400 hover:text-yellow-500">Membres</a>
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
                    <li class="mx-4"><a href="{{ url('/dashboard') }}" class="text-yellow-500">Réservations</a></li>
                    <li class="mx-4"><a href="{{ url('/membres') }}"
                            class="text-gray-400 hover:text-yellow-500">Membres</a></li>
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

    <main class="relative min-h-screen"
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
            <div class="shadow-md overflow-hidden border border-gray-200 sm:rounded-lg overflow-x-auto">
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
            <div class="shadow-md overflow-hidden border border-gray-200 sm:rounded-lg overflow-x-auto">
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
                                Email
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
                        @if(\Carbon\Carbon::parse($reservation->end_date)->addDay()->isFuture())
                        <tr>
                            <td class=" bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->first_name }} {{ $reservation->last_name }}
                            </td>
                            <td
                                class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white flex flex-col items-center justify-center">
                                <div>{{ $reservation->car->model_name ?? 'N/A' }}<br>{{ $reservation->car->total_km
                                    ??
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
                                                !$reservation->car->disponible ? 'checked' : '' }}
                                            id="indisponible">
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
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->email }}
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
                        @endif
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

        <div class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-3xl font-semibold text-white mb-4">Réservations archivées</h1>
            <p class="text-white mb-6">Les réservations dont leur date prend fin sont archivées ci-dessous.</p>
            <div class="shadow-md overflow-hidden border border-gray-200 sm:rounded-lg overflow-x-auto">
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
                                Email
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
                        @if(\Carbon\Carbon::parse($reservation->end_date)->addDay()->isPast())
                        <tr>
                            <td class=" bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->first_name }} {{ $reservation->last_name }}
                            </td>
                            <td
                                class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white flex flex-col items-center justify-center">
                                <div>{{ $reservation->car->model_name ?? 'N/A' }}<br>{{ $reservation->car->total_km
                                    ??
                                    'N/A' }} KM</div>

                            </td>

                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->phone }}
                            </td>
                            <td class="bg-gray-800 px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $reservation->email }}
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
                                    <p class="px-4 py-2 text-sm text-yellow-500 rounded">
                                        Archivé
                                        </button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                @if($reservations->where('status', 'accepted')->isEmpty())
                <div class="text-center py-8">
                    <p class="text-lg text-yellow-500">Il n'y a pour l'instant aucune réservation archivée.</p>
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