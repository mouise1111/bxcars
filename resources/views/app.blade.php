<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>

<body>
    <section class="h-screen bg-black text-white relative bg-[url('/car-hero.png')] bg-cover bg-center bg-no-repeat">
        <nav class="flex flex-row justify-between lg:px-20 py-8">
            <div class="space-y-2">
                <div class="w-8 h-0.5 bg-white" />
                <div class="w-8 h-0.5 bg-white" />
                <div class="w-8 h-0.5 bg-white" />
            </div>
            <a href="/" class="text-white uppercase">bxcars</a>
            <button
                class=" transition-colors hover:bg-gray-500  hover:text-black border-2 border-white rounded-3xl px-4 py-2">
                <a href="login" class="text-white p-2">Login / Register</a>
            </button>
        </nav>
        <h1 class="text-5xl font-bold text-center lg:px-32">
            Discover the world on wheels with out car rental service
        </h1>
        <!-- make this background 90% + see figma for more effects on this -->
        <div class="bg-white/70 rounded-3xl backdrop-blur-3xl text-black py-4" id="selection-back" />
        <div class="shadow-lg flex flex-row bg-white/50 rounded-3xl gap-8 px-12 text-black py-4 z-10" id="selection">
            <div class="flex flex-col">
                <div>
                    <h3>Pick-up location</h3>
                    <input placeholder="Search a location"
                        class="rounded-lg p-2 border-2 border-gray-300 bg-white text-black" />
                </div>
            </div>
            <div class="flex flex-col">
                <div>
                    <h3>Pick-up date</h3>
                    <input placeholder="Search a location"
                        class="rounded-lg p-2 border-2 border-gray-300 bg-white text-black" />
                </div>
            </div>
            <div class="flex flex-col">
                <h3>Drop-off location</h3>
                <input placeholder="Search a location"
                    class="rounded-lg p-2 border-2 border-gray-300 bg-white text-black" />
            </div>
            <div class="flex flex-col">
                <div>
                    <h3>Drop-off date</h3>
                    <input placeholder="Search a location"
                        class="rounded-lg p-2 border-2 border-gray-300 bg-white text-black" />
                </div>
            </div>
            <div class="min-w-fit flex flex-col justify-end lg:mr-12">
                <a href="/">
                    <button class="bg-black p-4 text-white rounded-3xl transition-colors p-2 hover:bg-gray-500">
                        <h4 class="w-full px-4">Find a Vehicle</h4>
                    </button>
                </a>
            </div>
        </div>
    </section>
    <section class="bg-gray-100 py-32 text-black">
        <h1 class="text-center text-5xl font-semibold">Our impressive Collection of Cars</h1>
        <h3 class="text-center text-lg mt-4 lg:px-56">
            Ranging from elegant sedands to powerfull sport cars, all are carefully selected to provide our
            costumers with the ultimate driving experience.
        </h3>
        <div class="flex flex-row gap-4 justify-center py-12">
            <div>
                <button class="bg-black text-white px-4 py-2 border-2 border-gray- rounded-3xl">
                    <h5>Popular</h5>
                </button>
            </div>
            <div>
                <button class="text-black px-4 py-2 border-2 border-gray rounded-3xl bg-white">
                    <h5>Luxury</h5>
                </button>
            </div>
            <div>
                <button class="text-black px-4 py-2 border-2 border-gray rounded-3xl bg-white">
                    <h5>Vintage</h5>
                </button>
            </div>
            <div>
                <button class="text-black px-4 py-2 border-2 border-gray rounded-3xl bg-white">
                    <h5>Family</h5>
                </button>
            </div>
            <div>
                <button class="text-black px-4 py-2 border-2 border-gray rounded-3xl bg-white">
                    <h5>Off-Road</h5>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-3 grid-rows-2 gap-4 lg:px-20">
            <div class="transition-all hover:border-black border-2 border-gray bg-white flex flex-col p-2 rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold p">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-center">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="text-gray-800 font-medium"> /day</span>
                    </div>
                    <div
                        class="flex flex-row my-4 justify-between px-8 py-2 rounded-xl bg-gray-100 justify-center content-center items-center">
                        <div class="flex-col flex">
                            <img src="/speedometer.png" class="icons self-center" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/manual-gearbox.png" class="icons self-center" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/users.png" class="icons self-center" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/gas-station.png" class="icons self-center" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <btn
                        class="rounded-3xl px-4 py-2 border-2 border-black font-medium block text-center transition-colors hover:bg-black hover:text-white">
                        Rent now</btn>
                </div>
            </div>
            <div class="transition-all hover:border-black border-2 border-gray bg-white flex flex-col p-2 rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-center">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="text-gray-800 font-medium"> /day</span>
                    </div>
                    <div
                        class="flex flex-row my-4 justify-between px-8 py-2 rounded-xl bg-gray-100 justify-center content-center items-center">
                        <div class="flex-col flex">
                            <img src="/speedometer.png" class="icons self-center" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/manual-gearbox.png" class="icons self-center" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/users.png" class="icons self-center" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/gas-station.png" class="icons self-center" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <btn
                        class="rounded-3xl px-4 py-2 border-2 border-black font-medium block text-center transition-colors hover:bg-black hover:text-white">
                        Rent now</btn>
                </div>
            </div>
            <div class="transition-all hover:border-black border-2 border-gray bg-white flex flex-col p-2 rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-center">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="text-gray-800 font-medium"> /day</span>
                    </div>
                    <div
                        class="flex flex-row my-4 justify-between px-8 py-2 rounded-xl bg-gray-100 justify-center content-center items-center">
                        <div class="flex-col flex">
                            <img src="/speedometer.png" class="icons self-center" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/manual-gearbox.png" class="icons self-center" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/users.png" class="icons self-center" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/gas-station.png" class="icons self-center" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <btn
                        class="rounded-3xl px-4 py-2 border-2 border-black font-medium block text-center transition-colors hover:bg-black hover:text-white">
                        Rent now</btn>
                </div>
            </div>
            <div class="transition-all hover:border-black border-2 border-gray bg-white flex flex-col p-2 rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-center">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="text-gray-800 font-medium"> /day</span>
                    </div>
                    <div
                        class="flex flex-row my-4 justify-between px-8 py-2 rounded-xl bg-gray-100 justify-center content-center items-center">
                        <div class="flex-col flex">
                            <img src="/speedometer.png" class="icons self-center" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/manual-gearbox.png" class="icons self-center" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/users.png" class="icons self-center" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/gas-station.png" class="icons self-center" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <btn
                        class="rounded-3xl px-4 py-2 border-2 border-black font-medium block text-center transition-colors hover:bg-black hover:text-white">
                        Rent now</btn>
                </div>
            </div>
            <div class="transition-all hover:border-black border-2 border-gray bg-white flex flex-col p-2 rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-center">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="text-gray-800 font-medium"> /day</span>
                    </div>
                    <div
                        class="flex flex-row my-4 justify-between px-8 py-2 rounded-xl bg-gray-100 justify-center content-center items-center">
                        <div class="flex-col flex">
                            <img src="/speedometer.png" class="icons self-center" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/manual-gearbox.png" class="icons self-center" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/users.png" class="icons self-center" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/gas-station.png" class="icons self-center" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <btn
                        class="rounded-3xl px-4 py-2 border-2 border-black font-medium block text-center transition-colors hover:bg-black hover:text-white">
                        Rent now</btn>
                </div>
            </div>
            <div class="transition-all hover:border-black border-2 border-gray bg-white flex flex-col p-2 rounded-3xl">
                <img src="/audio-car.png" alt="audi car" />
                <div class="p-2">
                    <h4 class="text-lg font-semibold">Audi A8 L 2022</h4>
                    <div class="flex flex-row items-center">
                        <h5 class="text-4xl font-bold">78.90</h5>
                        <span class="text-gray-800 font-medium"> /day</span>
                    </div>
                    <div
                        class="flex flex-row my-4 justify-between px-8 py-2 rounded-xl bg-gray-100 justify-center content-center items-center">
                        <div class="flex-col flex">
                            <img src="/speedometer.png" class="icons self-center" alt="milage icon" />
                            <span>4,000</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/manual-gearbox.png" class="icons self-center" alt="manual gearbox icon" />
                            <span>Auto</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/users.png" class="icons self-center" alt="people icon" />
                            <span>4 People</span>
                        </div>
                        <div class="flex-col flex">
                            <img src="/gas-station.png" class="icons self-center" alt="electric icon" />
                            <span>Electric</span>
                        </div>
                    </div>
                    <btn
                        class="rounded-3xl px-4 py-2 border-2 border-black font-medium block text-center transition-colors hover:bg-black hover:text-white">
                        Rent now</btn>
                </div>
            </div>

        </div>
    </section>

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
            height: 111.2px;
        }

        .icons {
            width: 20px;
        }
    </style>


</body>

</html>
