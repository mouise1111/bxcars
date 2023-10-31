<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body>
    <section class="relative h-screen text-white bg-black"
        style="background-image: url('{{ asset('car-hero.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

        {{-- <img src="/car-hero.png" alt="black car front view"> --}}
        <nav class="flex flex-row justify-between py-8 lg:px-20">
            <div class="space-y-2">
                <div class="w-8 h-0.5 bg-white"></div>
                <div class="w-8 h-0.5 bg-white"></div>
                <div class="w-8 h-0.5 bg-white"></div>
            </div>
            <a href="/" class="text-3xl text-white uppercase logo">bxcars</a>
            <button
                class="px-4 py-2 transition-colors border-2 border-white hover:bg-gray-500 hover:text-black rounded-3xl">
                <a href="login" class="p-2 text-white">Login / Register</a>
            </button>
        </nav>
        <h1 class="text-5xl font-bold text-center lg:px-32">
            Discover the world on wheels with out car rental service
        </h1>
        <!-- make this background 90% + see figma for more effects on this -->
        <div class="py-4 text-black bg-white/70 rounded-3xl backdrop-blur-3xl" id="selection-back"></div>
        <div class="z-10 flex flex-row gap-8 px-12 py-6 text-black shadow-lg bg-white/50 rounded-3xl" id="selection">
            <div class="flex flex-col">
                <div>
                    <h3 class="font-medium">Pick-up location</h3>
                    <input placeholder="Search a location"
                        class="p-2 text-black bg-white border-2 border-gray-300 rounded-lg" />
                </div>
            </div>
            <div class="flex flex-col">
                <div>
                    <h3 class="font-medium">Pick-up date</h3>
                    <input placeholder="Search a location"
                        class="p-2 text-black bg-white border-2 border-gray-300 rounded-lg" />
                </div>
            </div>
            <div class="flex flex-col">
                <h3 class="font-medium">Drop-off location</h3>
                <input placeholder="Search a location"
                    class="p-2 text-black bg-white border-2 border-gray-300 rounded-lg" />
            </div>
            <div class="flex flex-col">
                <div>
                    <h3 class="font-medium">Drop-off date</h3>
                    <input placeholder="Search a location"
                        class="p-2 text-black bg-white border-2 border-gray-300 rounded-lg" />
                </div>
            </div>
            <div class="flex flex-col justify-end min-w-fit lg:mr-12">
                <a href="/">
                    <button class="text-white transition-colors bg-black rounded-3xl hover:bg-gray-500">
                        <h4 class="w-full px-8 py-4">Find a Vehicle</h4>
                    </button>
                </a>
            </div>
        </div>
    </section>
    <section class="py-32 text-black bg-gray-100">
        <h1 class="text-5xl font-semibold text-center">Our impressive Collection of Cars</h1>
        <h3 class="mt-4 text-lg text-center lg:px-56">
            Ranging from elegant sedands to powerfull sport cars, all are carefully selected to provide our
            costumers with the ultimate driving experience.
        </h3>
        <div class="flex flex-row justify-center gap-4 py-12">
            <div>
                <button class="px-4 py-2 text-white bg-black border-2 border-gray- rounded-3xl">
                    <h5>Popular</h5>
                </button>
            </div>
            <div>
                <button class="px-4 py-2 text-black bg-white border-2 border-gray rounded-3xl">
                    <h5>Luxury</h5>
                </button>
            </div>
            <div>
                <button class="px-4 py-2 text-black bg-white border-2 border-gray rounded-3xl">
                    <h5>Vintage</h5>
                </button>
            </div>
            <div>
                <button class="px-4 py-2 text-black bg-white border-2 border-gray rounded-3xl">
                    <h5>Family</h5>
                </button>
            </div>
            <div>
                <button class="px-4 py-2 text-black bg-white border-2 border-gray rounded-3xl">
                    <h5>Off-Road</h5>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-3 grid-rows-2 gap-4 lg:px-20">
            <div class="flex flex-col p-2 transition-all bg-white border-2 hover:border-black border-gray rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold p">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-end">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="font-medium text-gray-800"> /day</span>
                    </div>
                    <div
                        class="flex flex-row items-center content-center justify-between px-8 py-2 my-4 bg-gray-100 rounded-xl">
                        <div class="flex flex-col">
                            <img src="/speedometer.png" class="self-center icons" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/manual-gearbox.png" class="self-center icons" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/users.png" class="self-center icons" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/gas-station.png" class="self-center icons" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <button
                        class="block w-full px-4 py-2 font-medium text-center transition-colors border-2 border-black rounded-3xl hover:bg-black hover:text-white">
                        Rent now</button>
                </div>
            </div>
            <div class="flex flex-col p-2 transition-all bg-white border-2 hover:border-black border-gray rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-end">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="font-medium text-gray-800"> /day</span>
                    </div>
                    <div
                        class="flex flex-row items-center content-center justify-between px-8 py-2 my-4 bg-gray-100 rounded-xl">
                        <div class="flex flex-col">
                            <img src="/speedometer.png" class="self-center icons" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/manual-gearbox.png" class="self-center icons" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/users.png" class="self-center icons" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/gas-station.png" class="self-center icons" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <button
                        class="block w-full px-4 py-2 font-medium text-center transition-colors border-2 border-black rounded-3xl hover:bg-black hover:text-white">
                        Rent now</button>
                </div>
            </div>
            <div class="flex flex-col p-2 transition-all bg-white border-2 hover:border-black border-gray rounded-3xl">
                <img src="{{ asset('audio-car.png') }}" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-end">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="font-medium text-gray-800"> /day</span>
                    </div>
                    <div
                        class="flex flex-row items-center content-center justify-between px-8 py-2 my-4 bg-gray-100 rounded-xl">
                        <div class="flex flex-col">
                            <img src="/speedometer.png" class="self-center icons" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/manual-gearbox.png" class="self-center icons" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/users.png" class="self-center icons" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/gas-station.png" class="self-center icons" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <button
                        class="block w-full px-4 py-2 font-medium text-center transition-colors border-2 border-black rounded-3xl hover:bg-black hover:text-white">
                        Rent now</button>
                </div>
            </div>
            <div class="flex flex-col p-2 transition-all bg-white border-2 hover:border-black border-gray rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-end">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="font-medium text-gray-800"> /day</span>
                    </div>
                    <div
                        class="flex flex-row items-center content-center justify-between px-8 py-2 my-4 bg-gray-100 rounded-xl">
                        <div class="flex flex-col">
                            <img src="/speedometer.png" class="self-center icons" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/manual-gearbox.png" class="self-center icons" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/users.png" class="self-center icons" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/gas-station.png" class="self-center icons" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <button
                        class="block w-full px-4 py-2 font-medium text-center transition-colors border-2 border-black rounded-3xl hover:bg-black hover:text-white">
                        Rent now</button>
                </div>
            </div>
            <div class="flex flex-col p-2 transition-all bg-white border-2 hover:border-black border-gray rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-end">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="font-medium text-gray-800"> /day</span>
                    </div>
                    <div
                        class="flex flex-row items-center content-center justify-between px-8 py-2 my-4 bg-gray-100 rounded-xl">
                        <div class="flex flex-col">
                            <img src="/speedometer.png" class="self-center icons" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/manual-gearbox.png" class="self-center icons" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/users.png" class="self-center icons" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/gas-station.png" class="self-center icons" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <button
                        class="block w-full px-4 py-2 font-medium text-center transition-colors border-2 border-black rounded-3xl hover:bg-black hover:text-white">
                        Rent now</button>
                </div>
            </div>
            <div class="flex flex-col p-2 transition-all bg-white border-2 hover:border-black border-gray rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-end">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="font-medium text-gray-800"> /day</span>
                    </div>
                    <div
                        class="flex flex-row items-center content-center justify-between px-8 py-2 my-4 bg-gray-100 rounded-xl">
                        <div class="flex flex-col">
                            <img src="/speedometer.png" class="self-center icons" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/manual-gearbox.png" class="self-center icons" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/users.png" class="self-center icons" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/gas-station.png" class="self-center icons" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <button
                        class="block w-full px-4 py-2 font-medium text-center transition-colors border-2 border-black rounded-3xl hover:bg-black hover:text-white">
                        Rent now</button>
                </div>
            </div>

        </div>
        <div class="flex justify-center lg:py-12">

            <a href="/cars">
                <button
                    class="text-white transition-colors bg-black border-2 rounded-3xl hover:bg-gray-500 border-inherit hover:border-black">
                    <h4 class="w-full px-8 py-4">See all cars</h4>
                </button>
            </a>
        </div>
    </section>

    <section class="px-32 py-32">
        <h1 class="text-5xl font-semibold text-center">How it works</h1>
        <h3 class="mt-4 text-lg text-center lg:px-56">
            Renting a luxury car has never been easier. Our streamlined process makes it simple for you to book and
            confirm your vehicle of choice online
        </h3>

        <div class="flex flex-row mt-16">
            <div class="relative flex flex-col gap-4">
                <div class="flex flex-row items-center gap-4 p-8 mt-16 bg-white border-2 border-gray rounded-3xl ">
                    <div class="flex items-center h-full px-4 bg-gray-200 rounded-xl">
                        <img src="/search.png" alt="mangnifier icon for search" class="icons-2">
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <h3 class="text-xl font-semibold">Browse and select</h3>
                        <p>Choose from our wide range of premium cars, select the pickup and return dates and
                            locations
                            that suit you best.</p>
                    </div>
                </div>
                <div class="flex flex-row items-center gap-4 p-8 bg-white border-2 border-gray rounded-3xl ">
                    <div class="flex items-center h-full px-4 bg-gray-200 rounded-xl">
                        <img src="/calendar.png" alt="calendar icon" class="icons-2 ">
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-xl font-semibold">Book and confirm</h3>
                        <p>Book your desired car with just a few clicks and receive an instant confirmation via
                            email or
                            SMS.</p>
                    </div>
                </div>
                <div class="z-10 flex flex-row items-center gap-4 p-8 mb-16 bg-white border-2 border-gray rounded-3xl">
                    <div class="flex items-center h-full px-4 bg-gray-200 rounded-xl">
                        <img src="/face-happy.png" alt="smiley icon" class="icons-2 ">
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-xl font-semibold">Enjoy your ride</h3>
                        <p>Pick up your car at the designated location and enjoy your premium driving experience
                            with
                            our top-quality service.</p>
                    </div>
                </div>

                <div class="absolute right-0 w-40 h-full bg-gray-100 -z-10 rounded-l-3xl"></div>
            </div>

            <div class="flex items-center p-8 bg-gray-100 rounded-r-full">
                <img src="/jeep.png" alt="jeep car">
            </div>
        </div>

    </section>

    <section class="px-32 py-32 text-black bg-gray-100">
        <h2 class="mb-16 text-4xl font-bold">What Our Customer Say</h2>
        <p class="text-2xl font-semibold"><span>“</span>I was really impressed with the level of service I received
            from this car
            rental company. The process was
            smooth and easy, and the car I rented was in excellent condition. The staff was friendly and helpful, and I
            felt well taken care of throughout my rental period. I would definitely recommend this company to anyone
            looking for a premium car rental experience.<span>“</span>
        </p>
        <div class="flex flex-row justify-between mt-8">
            <div class="flex flex-row gap-4">
                <div class="w-20 h-20 bg-gray-500 rounded-full">
                    {{-- <img src="" alt="profile picture of the car renter"> --}}
                </div>
                <div class="flex flex-col justify-between py-3">
                    <h4 class="font-bold">Lokman Hossain</h4>
                    <h6 class="text-gray-800">From <span class="font-semibold">Texas</span></h6>
                </div>
            </div>
            <div class="flex flex-row gap-2 m-4 mt-4 ml-auto lg:mt-auto">
                <div
                    class="flex items-center justify-center w-10 h-10 text-white transition-all bg-black rounded-full shadow-md hover:bg-gray-500 hover:scale-105">
                    <img src="/left-arrow.png" class="w-1/2 h-1/2" alt="" />
                </div>
                <div
                    class="flex items-center justify-center w-10 h-10 text-white transition-all bg-black rounded-full shadow-md hover:bg-gray-500 hover:scale-105">
                    <img src="/right-arrow.png" class="w-1/2 h-1/2" alt="" />
                </div>
            </div>
        </div>
    </section>

    <footer
        class="flex flex-col items-center justify-between py-4 text-white bg-black border-t-2 border-gray-200 lg:px-12 lg:flex-row">
        <div>
            <h1 class="text-3xl uppercase logo">Bxcars</h1>
        </div>
        <div class="flex justify-between gap-4 ">
            <a href="/about" class="text-gray-300 transition-colors hover:text-white">About</a>
            <a href="/contact" class="text-gray-300 transition-colors hover:text-white">Contact</a>
        </div>

        <div class="flex flex-row gap-4">
            <div
                class="flex items-center justify-center w-8 h-8 transition-transform bg-gray-300 rounded-full hover:bg-gray-200 hover:scale-110">
                <img src="/instagram.svg" alt="instagram icon">
            </div>
            <div
                class="flex items-center justify-center w-8 h-8 transition-transform bg-gray-300 rounded-full hover:bg-gray-200 hover:scale-110">

                <img src="{{ asset('facebook.svg') }}" alt="">
            </div>
            <img src="" alt="">
        </div>
    </footer>
</body>

</html>
<script>
    import "@fontsource/lexend-tera";
</script>
<style>
    #selection {
        position: absolute;
        bottom: -125px;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #selection-back {
        position: absolute;
        bottom: -125px;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 1334.89px;
        height: 129.57px;
    }

    .icons {
        width: 20px;
    }

    .icons-2 {
        width: 28px;
    }

    .logo {
        font-family: "Lexend Tera", sans-serif;

    }

    @font-face {
        font-family: "Lexend Tera";
        font-style: normal;
        font-weight: 400;
        font-display: block;
    }
</style>
