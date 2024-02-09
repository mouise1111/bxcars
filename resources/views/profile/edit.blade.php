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
    <title>{{ Auth::user()->name }} - BX Cars</title>

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
                    <a href="{{ url('/services') }}" class="text x1 hover:text-yellow-500 duration-500"
                        style="background-color: black;">Services</a>
                </li>
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/services') }}" class="text x1 hover:text-yellow-500 duration-500"
                        style="background-color: black;">À propos</a>
                </li>
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/contact') }}" class="text x1 hover:text-yellow-500 duration-500"
                        style="background-color: black;">Contact</a>
                </li>
                |
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/dashboard') }}" class="text x1 text-gray-400 hover:text-yellow-500 duration-500"
                        style="background-color: black;">Réservations</a>
                </li>
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/membres') }}" class="text x1 text-gray-400 hover:text-yellow-500 duration-500"
                        style="background-color: black;">Membres</a>
                </li>
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/cars/create') }}" class="text x1 text-gray-400 hover:text-yellow-500 duration-500"
                        style="background-color: black;">MyCARS</a>
                </li>
                <li class="mx-4 my-0 md:my-0 bg-black">
                    <a href="{{ url('/user/create') }}" class="text x1 text-gray-400 hover:text-yellow-500 duration-500"
                        style="background-color: black;">MyADMIN</a>
                </li>
            </ul>
            <div class="sm:fixed sm:top-0 sm:right-0 p-4 text-right z-10">
                @if (Route::has('login'))
                @auth

                <span class=" pr-4 text x1 text-yellow-500" style="cursor: pointer;"
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

<body
    style="background-image: url('{{ asset('wallpapertanger2.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
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