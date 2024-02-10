<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ Auth::user()->name }} | BX Cars</title>
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
                    <a href="{{ url('/membres') }}" class="py-2 text-gray-400 hover:text-yellow-500">Membres</a>
                    <a href="{{ url('/cars/create') }}" class="py-2 text-gray-400 hover:text-yellow-500">MyCARS</a>
                    <a href="{{ url('/user/create') }}" class="py-2 text-gray-400 hover:text-yellow-500">MyADMIN</a>
                    <a href="{{ url('/profile') }}" class="py-2 text-yellow-500 border-b-2 border-gray-100">Mon
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
                    <li class="mx-4"><a href="{{ url('/user/create') }}"
                            class="text-gray-400 hover:text-yellow-500">MyADMIN</a></li>
                </ul>

                <div class="sm:fixed sm:top-0 sm:right-0 p-4 text-right z-10">
                    @auth
                    <span class="text-yellow-500" style="cursor: pointer;"
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

    <main class="max-w-4xl mx-auto p-5 bg-yellow-500 rounded-lg mt-40">
        <!-- Profile Information Section -->
        <section class="bg-black p-6 rounded-lg mb-6">
            <header class="mb-4">
                <h2 class="text-xl font-semibold text-yellow-500">
                    {{ __('Information de profil') }}
                </h2>
                <p class="mt-1 text-sm text-yellow-500">
                    {{ __("Mettez à jour votre nom d'utilisateur ainsi que votre email.") }}
                </p>
            </header>

            <!-- Profile Update Form -->
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-sm font-medium text-yellow-500">{{ __('Nom') }}</label>
                    <input type="text" id="name" name="name" required autofocus autocomplete="name"
                        class="mt-1 block w-full p-2 bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        value="{{ old('name', $user->name) }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-yellow-500">{{ __('Email') }}</label>
                    <input type="email" id="email" name="email" required autocomplete="username"
                        class="mt-1 block w-full p-2 bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        value="{{ old('email', $user->email) }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-400">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-gray-300 hover:text-white">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-500">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="flex items-center justify-start gap-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{
                        __('Modifier') }}</button>

                    @if (session('status') === 'profile-updated')
                    <p class="text-sm text-green-500">{{ __('Modifié.') }}</p>
                    @endif
                </div>
            </form>
        </section>

        <!-- Update Password Section -->
        <section class="bg-black p-6 rounded-lg">
            <header class="mb-4">
                <h2 class="text-xl font-semibold text-yellow-500">
                    {{ __('Mot de passe') }}
                </h2>
                <p class="mt-1 text-sm text-yellow-500">
                    {{ __('Mettez à jour votre mot de passe.') }}
                </p>
            </header>

            <!-- Password Update Form -->
            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-yellow-500">{{ __('Mot de passe
                        actuel') }}</label>
                    <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                        class="mt-1 block w-full p-2 bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-yellow-500">{{ __('Nouveau mot de
                        passe')
                        }}</label>
                    <input type="password" id="password" name="password" autocomplete="new-password"
                        class="mt-1 block w-full p-2 bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-yellow-500">{{
                        __('Confirmer
                        nouveau mot de passe') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        autocomplete="new-password"
                        class="mt-1 block w-full p-2 bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-start gap-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{
                        __('Modifier') }}</button>

                    @if (session('status') === 'password-updated')
                    <p class="text-sm text-green-500">{{ __('Modifié.') }}</p>
                    @endif
                </div>
            </form>
        </section>
    </main>
</body>