<div x-data="{ open: false }" :class="{ 'overflow-y-hidden': open }" class="overflow-x-hidden h-screen dark:bg-dark">
    <header :class="{ 'hidden': open }" id="home"
        class="border-b-2 md:border-b-4 border-body-dark bg-dark bg-small-banner bg-cover bg-center">
        <h1
            class="flex md:flex-row flex-col items-center justify-center md:gap-x-5 gap-y-2 p-4 md:p-8 font-agbalumo text-light">
            <div class="flex items-center justify-center md:gap-3">
                <svg class="hidden md:inline-block h-8 w-8 text-primary" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M18.5 3.1c.3.2.5.5.5.9v16a1 1 0 0 1-1.6.8L12 17V7.1l5.4-4a1 1 0 0 1 1 0ZM22 12a4 4 0 0 1-2 3.5v-7c1.2.7 2 2 2 3.5ZM10 8H4a1 1 0 0 0-1 1v6c0 .6.4 1 1 1h6V8Zm0 9H5v3c0 .6.4 1 1 1h3c.6 0 1-.4 1-1v-3Z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-base md:text-xl text-center">
                    <span>Publish your school today with</span>
                    <span class="bg-[#0fd850] bg-clip-text block md:inline text-transparent">SkoolMaven
                        Ads!</span>
                </p>
            </div>
            <div class="group">
                <a wire:navigate href="{{ route('index') }}"
                    class="block rounded-md bg-primary px-3 py-1.5 font-k-mono text-xs md:text-base font-bold text-dark shadow-card shadow-black duration-300 group-hover:shadow-body-dark dark:shadow-secondary">Advertise
                    Now</a>
            </div>
        </h1>
    </header>
    <nav
        class="sticky top-0 z-50 flex items-center justify-between bg-light bg-opacity-75 py-4 px-8 lg:px-4 xl:px-12 xl:py-2 backdrop-blur-lg dark:bg-dark dark:bg-opacity-75">
        <a wire:navigate href="{{ route('index') }}" class="flex gap-2 items-center justify-center">
            <img class="w-8 lg:w-12 block" src="{{ asset('favicon.svg') }}" alt="logo">
            <p class="font-aladin text-dark dark:text-light font-bold flex flex-col items-center">
                <span class="text-3xl lg:text-4xl">{{ __(Str::lower(config('app.name'))) }}</span>
                <small class="lg:text-base tracking-wider">by JavaTechnovation</small>
            </p>
        </a>
        <div class="flex items-center justify-between gap-x-4 xl:gap-x-16">
            <ul x-cloak
                :class="{ 'flex absolute top-0 right-0 dark:bg-dark items-center bg-light flex-col inset-0 h-screen z-50 overflow-y-auto': open, 'hidden': !open }"
                class="font-medium lg:flex lg:flex-row lg:items-center lg:justify-between xl:gap-x-4">
                <div class="w-full flex justify-end lg:hidden">
                    <svg @click.stop="open = !open" class="cursor-pointer mt-5 mr-5 w-7 h-7 text-dark dark:text-light"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <li :class="{ 'my-5 w-full px-20': open }" class="group">
                    <a @click.stop="open = false" href="{{ route('index') }}#home"
                        class="lg:px-3 lg:py-1.5 text-dark duration-300 group-hover:text-primary dark:text-light">Home</a>
                </li>
                <li :class="{ 'my-5 w-full px-20': open }" class="group">
                    <a @click.stop="open = false" href="{{ route('index') }}#about"
                        class="lg:px-3 lg:py-1.5 text-dark duration-300 group-hover:text-primary dark:text-light">About
                        Us</a>
                </li>
                <li :class="{ 'my-5 w-full px-20': open }" class="group">
                    <a @click.stop="open = false" href="{{ route('index') }}#pricing"
                        class="lg:px-3 lg:py-1.5 text-dark duration-300 group-hover:text-primary dark:text-light">Pricing</a>
                </li>
                <li :class="{ 'my-5 w-full px-20': open }" class="group">
                    <a @click.stop="open = false" href="{{ route('index') }}#team"
                        class="lg:px-3 lg:py-1.5 text-dark duration-300 group-hover:text-primary dark:text-light">Team</a>
                </li>
                <li :class="{ 'my-5 w-full px-20': open }" class="group">
                    <a @click.stop="open = false" href="{{ route('index') }}#contact"
                        class="lg:px-3 lg:py-1.5 text-dark duration-300 group-hover:text-primary dark:text-light">Contact</a>
                </li>
                <li :class="{ 'my-5 w-full px-20': open }" class="group">
                    <a @click.stop="open = false" href=""
                        class="lg:px-3 lg:py-1.5 text-dark duration-300 group-hover:text-primary dark:text-light">Blog</a>
                </li>
                <li :class="{ 'my-5 w-full px-20': open }" class="group">
                    <a @click.stop="open = false" href="{{ route('index') }}#resources"
                        class="lg:px-3 lg:py-1.5 text-dark duration-300 group-hover:text-primary dark:text-light">Resources</a>
                </li>
                @auth
                <div :class="{ 'my-5 w-full px-16': open }" class="group lg:hidden">
                    <a wire:navigate @click.stop="open = false"
                        href="{{ route('app.' . session('role') . '.dashboard') }}"
                        class="rounded-md px-4 py-2 font-medium dark:text-dark duration-300 bg-dark text-light dark:bg-light">
                        Dashboard
                    </a>
                </div>
                @endauth
                @guest
                <div :class="{ 'my-5 w-full px-16': open }" class="group lg:hidden">
                    <a wire:navigate @click.stop="open = false" href="{{ route('app.login') }}"
                        class="rounded-md px-4 py-2 font-medium text-dark duration-300 group-hover:bg-dark group-hover:text-light dark:text-light dark:group-hover:bg-light dark:group-hover:text-dark">
                        Sign In
                    </a>
                </div>
                <div :class="{ 'my-5 w-full px-16': open }" class="group lg:hidden">
                    <a wire:navigate @click.stop="open = false" href="{{ route('app.register') }}"
                        class="rounded-md bg-primary px-4 py-2 font-medium text-secondary shadow-card shadow-black duration-300 group-hover:shadow-body-dark dark:shadow-secondary">
                        Sign Up
                    </a>
                </div>
                @endguest
            </ul>
            <ul>
                <li class="flex items-center justify-between gap-4 xl:gap-8">
                    <livewire:tools.darkmode-toggler />
                    <div class="hidden lg:flex items-center justify-between gap-4">
                        @auth
                        <div class="group">
                            <a wire:navigate href="{{ route('app.' . session('role') . '.dashboard') }}"
                                class="rounded-md px-4 py-2 font-medium dark:text-dark duration-300 bg-dark text-light dark:bg-light">
                                Dashboard
                            </a>
                        </div>
                        @endauth
                        @guest
                        <div class="group">
                            <a wire:navigate href="{{ route('app.login') }}"
                                class="rounded-md px-4 py-2 font-medium text-dark duration-300 group-hover:bg-dark group-hover:text-light dark:text-light dark:group-hover:bg-light dark:group-hover:text-dark">
                                Sign In
                            </a>
                        </div>
                        <div class="group">
                            <a wire:navigate href="{{ route('app.register') }}"
                                class="rounded-md bg-primary px-4 py-2 font-medium text-secondary shadow-card shadow-black duration-300 group-hover:shadow-body-dark dark:shadow-secondary">
                                Sign Up
                            </a>
                        </div>
                        @endguest
                    </div>
                    <svg @click.stop="open = !open" class="cursor-pointer w-7 h-7 text-dark dark:text-light lg:hidden"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857Zm10 0A1.857 1.857 0 0 0 13 14.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 19.143v-4.286A1.857 1.857 0 0 0 19.143 13h-4.286Z"
                            clip-rule="evenodd" />
                    </svg>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        {{-- Hero Section --}}
        <section class="bg-light text-dark dark:bg-dark dark:text-light">
            <div class="flex flex-col pt-14 lg:px-4 lg:pt-32">
                <section class="animated zoomIn px-10 text-center md:px-20 lg:px-40">
                    <h1
                        class="mb-4 text-3xl text-center font-bold md:font-extrabold font-aladin lg:leading-tight lg:tracking-tight md:leading-tight md:tracking-tight md:text-5xl lg:text-6xl">
                        <span
                            class="block md:hidden text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">#1</span>
                        <span
                            class="block md:hidden text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">School</span>
                        <span
                            class="block md:hidden text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">Management</span>
                        <span
                            class="block md:hidden text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">System</span>
                        <span
                            class="hidden md:inline-block text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">School
                            Management System for All Institution Types.</span>
                    </h1>
                    <p
                        class="mb-6 text-sm font-normal text-body-dark lg:text-xl max-w-[45ch] mx-auto dark:text-secondary">
                        A CSaaS built with all your service needs in mind.
                    </p>
                    <ul class="mb-6 lg:mb-14 flex items-center justify-center md:gap-x-5">
                        <li>
                            <a wire:navigate href="{{ route('index') }}"
                                class="flex items-center rounded-lg bg-primary py-2 px-4 md:p-4 font-bold md:font-medium text-light dark:bg-light dark:text-dark">Subscribe
                                Now
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M10.3 5.6A2 2 0 0 0 7 7v10a2 2 0 0 0 3.3 1.5l5.9-4.9a2 2 0 0 0 0-3l-6-5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                        <li class="hidden md:block">
                            <a wire:navigate href="{{ route('index') }}"
                                class="rounded-lg bg-secondary md:p-4 font-medium text-dark duration-300 dark:bg-primary">Advertise
                                on {{ __(config('app.name')) }}</a>
                        </li>
                    </ul>
                </section>
                <section class="hidden md:block relative z-10">
                    <div class="mt-14 flex items-center justify-center">
                        <img loading="lazy" src="{{ asset('src/images/website/hero-image.png') }}" alt="Hero Image"
                            class="w-5/6 lg:w-3/4">
                    </div>
                    <div class="absolute bottom-0 left-20 z-[-1]">
                        <svg width="134" height="106" viewBox="0 0 134 106" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="1.66667" cy="104" r="1.66667" transform="rotate(-90 1.66667 104)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="104" r="1.66667" transform="rotate(-90 16.3333 104)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="104" r="1.66667" transform="rotate(-90 31 104)" fill="#4AAD52" />
                            <circle cx="45.6667" cy="104" r="1.66667" transform="rotate(-90 45.6667 104)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="104" r="1.66667" transform="rotate(-90 60.3333 104)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="104" r="1.66667" transform="rotate(-90 88.6667 104)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="104" r="1.66667" transform="rotate(-90 117.667 104)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="104" r="1.66667" transform="rotate(-90 74.6667 104)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="104" r="1.66667" transform="rotate(-90 103 104)" fill="#4AAD52" />
                            <circle cx="132" cy="104" r="1.66667" transform="rotate(-90 132 104)" fill="#4AAD52" />
                            <circle cx="1.66667" cy="89.3333" r="1.66667" transform="rotate(-90 1.66667 89.3333)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="89.3333" r="1.66667" transform="rotate(-90 16.3333 89.3333)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="89.3333" r="1.66667" transform="rotate(-90 31 89.3333)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="89.3333" r="1.66667" transform="rotate(-90 45.6667 89.3333)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="89.3338" r="1.66667" transform="rotate(-90 60.3333 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="89.3338" r="1.66667" transform="rotate(-90 88.6667 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="89.3338" r="1.66667" transform="rotate(-90 117.667 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="89.3338" r="1.66667" transform="rotate(-90 74.6667 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="89.3338" r="1.66667" transform="rotate(-90 103 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="89.3338" r="1.66667" transform="rotate(-90 132 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="74.6673" r="1.66667" transform="rotate(-90 1.66667 74.6673)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="31.0003" r="1.66667" transform="rotate(-90 1.66667 31.0003)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="74.6668" r="1.66667" transform="rotate(-90 16.3333 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="31.0003" r="1.66667" transform="rotate(-90 16.3333 31.0003)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="74.6668" r="1.66667" transform="rotate(-90 31 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="31.0003" r="1.66667" transform="rotate(-90 31 31.0003)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="74.6668" r="1.66667" transform="rotate(-90 45.6667 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="31.0003" r="1.66667" transform="rotate(-90 45.6667 31.0003)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="74.6668" r="1.66667" transform="rotate(-90 60.3333 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="31.0001" r="1.66667" transform="rotate(-90 60.3333 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="74.6668" r="1.66667" transform="rotate(-90 88.6667 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="31.0001" r="1.66667" transform="rotate(-90 88.6667 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="74.6668" r="1.66667" transform="rotate(-90 117.667 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="31.0001" r="1.66667" transform="rotate(-90 117.667 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="74.6668" r="1.66667" transform="rotate(-90 74.6667 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="31.0001" r="1.66667" transform="rotate(-90 74.6667 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="74.6668" r="1.66667" transform="rotate(-90 103 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="31.0001" r="1.66667" transform="rotate(-90 103 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="74.6668" r="1.66667" transform="rotate(-90 132 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="31.0001" r="1.66667" transform="rotate(-90 132 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="60.0003" r="1.66667" transform="rotate(-90 1.66667 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="16.3336" r="1.66667" transform="rotate(-90 1.66667 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="60.0003" r="1.66667" transform="rotate(-90 16.3333 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="16.3336" r="1.66667" transform="rotate(-90 16.3333 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="60.0003" r="1.66667" transform="rotate(-90 31 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="16.3336" r="1.66667" transform="rotate(-90 31 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="60.0003" r="1.66667" transform="rotate(-90 45.6667 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="16.3336" r="1.66667" transform="rotate(-90 45.6667 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="60.0003" r="1.66667" transform="rotate(-90 60.3333 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="16.3336" r="1.66667" transform="rotate(-90 60.3333 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="60.0003" r="1.66667" transform="rotate(-90 88.6667 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="16.3336" r="1.66667" transform="rotate(-90 88.6667 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="60.0003" r="1.66667" transform="rotate(-90 117.667 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="16.3336" r="1.66667" transform="rotate(-90 117.667 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="60.0003" r="1.66667" transform="rotate(-90 74.6667 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="16.3336" r="1.66667" transform="rotate(-90 74.6667 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="60.0003" r="1.66667" transform="rotate(-90 103 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="16.3336" r="1.66667" transform="rotate(-90 103 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="60.0003" r="1.66667" transform="rotate(-90 132 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="16.3336" r="1.66667" transform="rotate(-90 132 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="45.3336" r="1.66667" transform="rotate(-90 1.66667 45.3336)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="1.66683" r="1.66667" transform="rotate(-90 1.66667 1.66683)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="45.3336" r="1.66667" transform="rotate(-90 16.3333 45.3336)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="1.66683" r="1.66667" transform="rotate(-90 16.3333 1.66683)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="45.3336" r="1.66667" transform="rotate(-90 31 45.3336)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="1.66683" r="1.66667" transform="rotate(-90 31 1.66683)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="45.3336" r="1.66667" transform="rotate(-90 45.6667 45.3336)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="1.66683" r="1.66667" transform="rotate(-90 45.6667 1.66683)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="45.3338" r="1.66667" transform="rotate(-90 60.3333 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="1.66707" r="1.66667" transform="rotate(-90 60.3333 1.66707)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="45.3338" r="1.66667" transform="rotate(-90 88.6667 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="1.66707" r="1.66667" transform="rotate(-90 88.6667 1.66707)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="45.3338" r="1.66667" transform="rotate(-90 117.667 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="1.66707" r="1.66667" transform="rotate(-90 117.667 1.66707)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="45.3338" r="1.66667" transform="rotate(-90 74.6667 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="1.66707" r="1.66667" transform="rotate(-90 74.6667 1.66707)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="45.3338" r="1.66667" transform="rotate(-90 103 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="1.66707" r="1.66667" transform="rotate(-90 103 1.66707)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="45.3338" r="1.66667" transform="rotate(-90 132 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="1.66707" r="1.66667" transform="rotate(-90 132 1.66707)"
                                fill="#4AAD52" />
                        </svg>
                    </div>
                    <div class="absolute right-20 top-0 z-[-1]">
                        <svg width="134" height="106" viewBox="0 0 134 106" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="1.66667" cy="104" r="1.66667" transform="rotate(-90 1.66667 104)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="104" r="1.66667" transform="rotate(-90 16.3333 104)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="104" r="1.66667" transform="rotate(-90 31 104)" fill="#4AAD52" />
                            <circle cx="45.6667" cy="104" r="1.66667" transform="rotate(-90 45.6667 104)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="104" r="1.66667" transform="rotate(-90 60.3333 104)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="104" r="1.66667" transform="rotate(-90 88.6667 104)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="104" r="1.66667" transform="rotate(-90 117.667 104)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="104" r="1.66667" transform="rotate(-90 74.6667 104)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="104" r="1.66667" transform="rotate(-90 103 104)" fill="#4AAD52" />
                            <circle cx="132" cy="104" r="1.66667" transform="rotate(-90 132 104)" fill="#4AAD52" />
                            <circle cx="1.66667" cy="89.3333" r="1.66667" transform="rotate(-90 1.66667 89.3333)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="89.3333" r="1.66667" transform="rotate(-90 16.3333 89.3333)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="89.3333" r="1.66667" transform="rotate(-90 31 89.3333)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="89.3333" r="1.66667" transform="rotate(-90 45.6667 89.3333)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="89.3338" r="1.66667" transform="rotate(-90 60.3333 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="89.3338" r="1.66667" transform="rotate(-90 88.6667 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="89.3338" r="1.66667" transform="rotate(-90 117.667 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="89.3338" r="1.66667" transform="rotate(-90 74.6667 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="89.3338" r="1.66667" transform="rotate(-90 103 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="89.3338" r="1.66667" transform="rotate(-90 132 89.3338)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="74.6673" r="1.66667" transform="rotate(-90 1.66667 74.6673)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="31.0003" r="1.66667" transform="rotate(-90 1.66667 31.0003)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="74.6668" r="1.66667" transform="rotate(-90 16.3333 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="31.0003" r="1.66667" transform="rotate(-90 16.3333 31.0003)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="74.6668" r="1.66667" transform="rotate(-90 31 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="31.0003" r="1.66667" transform="rotate(-90 31 31.0003)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="74.6668" r="1.66667" transform="rotate(-90 45.6667 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="31.0003" r="1.66667" transform="rotate(-90 45.6667 31.0003)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="74.6668" r="1.66667" transform="rotate(-90 60.3333 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="31.0001" r="1.66667" transform="rotate(-90 60.3333 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="74.6668" r="1.66667" transform="rotate(-90 88.6667 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="31.0001" r="1.66667" transform="rotate(-90 88.6667 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="74.6668" r="1.66667" transform="rotate(-90 117.667 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="31.0001" r="1.66667" transform="rotate(-90 117.667 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="74.6668" r="1.66667" transform="rotate(-90 74.6667 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="31.0001" r="1.66667" transform="rotate(-90 74.6667 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="74.6668" r="1.66667" transform="rotate(-90 103 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="31.0001" r="1.66667" transform="rotate(-90 103 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="74.6668" r="1.66667" transform="rotate(-90 132 74.6668)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="31.0001" r="1.66667" transform="rotate(-90 132 31.0001)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="60.0003" r="1.66667" transform="rotate(-90 1.66667 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="16.3336" r="1.66667" transform="rotate(-90 1.66667 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="60.0003" r="1.66667" transform="rotate(-90 16.3333 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="16.3336" r="1.66667" transform="rotate(-90 16.3333 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="60.0003" r="1.66667" transform="rotate(-90 31 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="16.3336" r="1.66667" transform="rotate(-90 31 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="60.0003" r="1.66667" transform="rotate(-90 45.6667 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="16.3336" r="1.66667" transform="rotate(-90 45.6667 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="60.0003" r="1.66667" transform="rotate(-90 60.3333 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="16.3336" r="1.66667" transform="rotate(-90 60.3333 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="60.0003" r="1.66667" transform="rotate(-90 88.6667 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="16.3336" r="1.66667" transform="rotate(-90 88.6667 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="60.0003" r="1.66667" transform="rotate(-90 117.667 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="16.3336" r="1.66667" transform="rotate(-90 117.667 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="60.0003" r="1.66667" transform="rotate(-90 74.6667 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="16.3336" r="1.66667" transform="rotate(-90 74.6667 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="60.0003" r="1.66667" transform="rotate(-90 103 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="16.3336" r="1.66667" transform="rotate(-90 103 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="60.0003" r="1.66667" transform="rotate(-90 132 60.0003)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="16.3336" r="1.66667" transform="rotate(-90 132 16.3336)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="45.3336" r="1.66667" transform="rotate(-90 1.66667 45.3336)"
                                fill="#4AAD52" />
                            <circle cx="1.66667" cy="1.66683" r="1.66667" transform="rotate(-90 1.66667 1.66683)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="45.3336" r="1.66667" transform="rotate(-90 16.3333 45.3336)"
                                fill="#4AAD52" />
                            <circle cx="16.3333" cy="1.66683" r="1.66667" transform="rotate(-90 16.3333 1.66683)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="45.3336" r="1.66667" transform="rotate(-90 31 45.3336)"
                                fill="#4AAD52" />
                            <circle cx="31" cy="1.66683" r="1.66667" transform="rotate(-90 31 1.66683)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="45.3336" r="1.66667" transform="rotate(-90 45.6667 45.3336)"
                                fill="#4AAD52" />
                            <circle cx="45.6667" cy="1.66683" r="1.66667" transform="rotate(-90 45.6667 1.66683)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="45.3338" r="1.66667" transform="rotate(-90 60.3333 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="60.3333" cy="1.66707" r="1.66667" transform="rotate(-90 60.3333 1.66707)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="45.3338" r="1.66667" transform="rotate(-90 88.6667 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="88.6667" cy="1.66707" r="1.66667" transform="rotate(-90 88.6667 1.66707)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="45.3338" r="1.66667" transform="rotate(-90 117.667 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="117.667" cy="1.66707" r="1.66667" transform="rotate(-90 117.667 1.66707)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="45.3338" r="1.66667" transform="rotate(-90 74.6667 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="74.6667" cy="1.66707" r="1.66667" transform="rotate(-90 74.6667 1.66707)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="45.3338" r="1.66667" transform="rotate(-90 103 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="103" cy="1.66707" r="1.66667" transform="rotate(-90 103 1.66707)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="45.3338" r="1.66667" transform="rotate(-90 132 45.3338)"
                                fill="#4AAD52" />
                            <circle cx="132" cy="1.66707" r="1.66667" transform="rotate(-90 132 1.66707)"
                                fill="#4AAD52" />
                        </svg>
                    </div>
                </section>
            </div>
        </section>
        {{-- Hero Section --}}
        {{-- _Features Section --}}
        <section class="bg-neutral-50 dark:bg-dark">
            <div class="py-20 px-10 md:py-32 md:px-20">
                <div class="mb-20 text-center">
                    <p class="mb-2 text-lg md:text-xl font-semibold text-primary">
                        Features
                    </p>
                    <h2 class="mb-3 text-3xl font-extrabold text-dark dark:text-light md:text-4xl">
                        Impressive components of <span class="text-primary">{{ __(config('app.name')) }}</span>
                    </h2>
                    <p
                        class="mx-auto text-lg max-w-[45ch] text-body-dark text-opacity-75 dark:text-secondary dark:text-opacity-50">
                        Whether you are an administrator, school owner, or entrepreneur looking to level up profits
                        while delivering quality education, we've got you covered.
                    </p>
                </div>
                <div class="grid-col-1 mx-auto grid max-w-[92%] gap-10 text-center lg:grid-cols-4">
                    <div class="group mb-8 md:mb-12 w-full">
                        <div
                            class="relative z-10 mx-auto mb-6 md:mb-10 flex h-14 w-14 md:h-20 md:w-20 items-center justify-center rounded-xl bg-primary">
                            <span
                                class="absolute left-0 top-0 -z-10 h-14 w-14 md:h-20 md:w-20 rotate-45 rounded-xl bg-primary bg-opacity-25 duration-300 group-hover:rotate-90"></span>
                            <svg class="h-8 w-8 text-dark dark:text-light" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 7h-.7a3.4 3.4 0 0 0-.7-4c-.6-.6-1.5-1-2.4-1-1.8 0-3.3 1.2-4.4 2.5C10.4 2.8 9 2 7.5 2a3.5 3.5 0 0 0-3.1 5H4a2 2 0 0 0-2 2v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9a2 2 0 0 0-2-2ZM10 7H7.6a1.5 1.5 0 0 1 0-3c.9 0 2 .8 3 2.1l-.4.9Zm6.2 0h-3.8c1-1.4 2.4-3 3.8-3a1.5 1.5 0 0 1 0 3ZM13 14h-2v8h2v-8Zm-4 0H4v6a2 2 0 0 0 2 2h3v-8Zm6 0v8h3a2 2 0 0 0 2-2v-6h-5Z" />
                            </svg>
                        </div>
                        <h4 class="mb-3 text-xl font-bold text-dark dark:text-light">
                            Free and Open-Source
                        </h4>
                        <p class="mb-6 text-body-dark text-opacity-75 dark:text-secondary dark:text-opacity-50">
                            Lorem Ipsum is simply dummy text of the printing and industry.
                        </p>
                        <a wire:navigate href="{{ route('index') }}"
                            class="font-medium text-dark duration-300 hover:text-primary dark:text-light dark:hover:text-primary">
                            Learn More
                        </a>
                    </div>
                    <div class="group mb-8 md:mb-12 w-full">
                        <div
                            class="relative z-10 mx-auto mb-6 md:mb-10 flex h-14 w-14 md:h-20 md:w-20 items-center justify-center rounded-xl bg-primary">
                            <span
                                class="absolute left-0 top-0 -z-10 h-14 w-14 md:h-20 md:w-20 rotate-45 rounded-xl bg-primary bg-opacity-25 duration-300 group-hover:rotate-90"></span>
                            <svg class="h-8 w-8 text-dark dark:text-light" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 7h-.7a3.4 3.4 0 0 0-.7-4c-.6-.6-1.5-1-2.4-1-1.8 0-3.3 1.2-4.4 2.5C10.4 2.8 9 2 7.5 2a3.5 3.5 0 0 0-3.1 5H4a2 2 0 0 0-2 2v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9a2 2 0 0 0-2-2ZM10 7H7.6a1.5 1.5 0 0 1 0-3c.9 0 2 .8 3 2.1l-.4.9Zm6.2 0h-3.8c1-1.4 2.4-3 3.8-3a1.5 1.5 0 0 1 0 3ZM13 14h-2v8h2v-8Zm-4 0H4v6a2 2 0 0 0 2 2h3v-8Zm6 0v8h3a2 2 0 0 0 2-2v-6h-5Z" />
                            </svg>
                        </div>
                        <h4 class="mb-3 text-xl font-bold text-dark dark:text-light">
                            Free and Open-Source
                        </h4>
                        <p class="mb-6 text-body-dark text-opacity-75 dark:text-secondary dark:text-opacity-50">
                            Lorem Ipsum is simply dummy text of the printing and industry.
                        </p>
                        <a wire:navigate href="{{ route('index') }}"
                            class="font-medium text-dark duration-300 hover:text-primary dark:text-light dark:hover:text-primary">
                            Learn More
                        </a>
                    </div>
                    <div class="group mb-8 md:mb-12 w-full">
                        <div
                            class="relative z-10 mx-auto mb-6 md:mb-10 flex h-14 w-14 md:h-20 md:w-20 items-center justify-center rounded-xl bg-primary">
                            <span
                                class="absolute left-0 top-0 -z-10 h-14 w-14 md:h-20 md:w-20 rotate-45 rounded-xl bg-primary bg-opacity-25 duration-300 group-hover:rotate-90"></span>
                            <svg class="h-8 w-8 text-dark dark:text-light" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 7h-.7a3.4 3.4 0 0 0-.7-4c-.6-.6-1.5-1-2.4-1-1.8 0-3.3 1.2-4.4 2.5C10.4 2.8 9 2 7.5 2a3.5 3.5 0 0 0-3.1 5H4a2 2 0 0 0-2 2v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9a2 2 0 0 0-2-2ZM10 7H7.6a1.5 1.5 0 0 1 0-3c.9 0 2 .8 3 2.1l-.4.9Zm6.2 0h-3.8c1-1.4 2.4-3 3.8-3a1.5 1.5 0 0 1 0 3ZM13 14h-2v8h2v-8Zm-4 0H4v6a2 2 0 0 0 2 2h3v-8Zm6 0v8h3a2 2 0 0 0 2-2v-6h-5Z" />
                            </svg>
                        </div>
                        <h4 class="mb-3 text-xl font-bold text-dark dark:text-light">
                            Free and Open-Source
                        </h4>
                        <p class="mb-6 text-body-dark text-opacity-75 dark:text-secondary dark:text-opacity-50">
                            Lorem Ipsum is simply dummy text of the printing and industry.
                        </p>
                        <a wire:navigate href="{{ route('index') }}"
                            class="font-medium text-dark duration-300 hover:text-primary dark:text-light dark:hover:text-primary">
                            Learn More
                        </a>
                    </div>
                    <div class="group mb-8 md:mb-12 w-full">
                        <div
                            class="relative z-10 mx-auto mb-6 md:mb-10 flex h-14 w-14 md:h-20 md:w-20 items-center justify-center rounded-xl bg-primary">
                            <span
                                class="absolute left-0 top-0 -z-10 h-14 w-14 md:h-20 md:w-20 rotate-45 rounded-xl bg-primary bg-opacity-25 duration-300 group-hover:rotate-90"></span>
                            <svg class="h-8 w-8 text-dark dark:text-light" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 7h-.7a3.4 3.4 0 0 0-.7-4c-.6-.6-1.5-1-2.4-1-1.8 0-3.3 1.2-4.4 2.5C10.4 2.8 9 2 7.5 2a3.5 3.5 0 0 0-3.1 5H4a2 2 0 0 0-2 2v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9a2 2 0 0 0-2-2ZM10 7H7.6a1.5 1.5 0 0 1 0-3c.9 0 2 .8 3 2.1l-.4.9Zm6.2 0h-3.8c1-1.4 2.4-3 3.8-3a1.5 1.5 0 0 1 0 3ZM13 14h-2v8h2v-8Zm-4 0H4v6a2 2 0 0 0 2 2h3v-8Zm6 0v8h3a2 2 0 0 0 2-2v-6h-5Z" />
                            </svg>
                        </div>
                        <h4 class="mb-3 text-xl font-bold text-dark dark:text-light">
                            Free and Open-Source
                        </h4>
                        <p class="mb-6 text-body-dark text-opacity-75 dark:text-secondary dark:text-opacity-50">
                            Lorem Ipsum is simply dummy text of the printing and industry.
                        </p>
                        <a wire:navigate href="{{ route('index') }}"
                            class="font-medium text-dark duration-300 hover:text-primary dark:text-light dark:hover:text-primary">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </section>
        {{-- _Features Section --}}
        {{-- About Section --}}
        <section id="about" class="bg-secondary dark:bg-body-dark dark:text-light">
            <div class="flex py-20 pt-32 px-10 lg:flex-row flex-col items-center lg:gap-0 gap-y-20 lg:p-0 lg:py-40">
                <div class="mx-auto max-w-[45ch] text-center lg:text-start">
                    <h2
                        class="mb-5 md:text-4xl p-5 lg:p-0 font-extrabold md:leading-tight text-dark dark:text-light text-3xl leading-snug">
                        <span
                            class="block text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">Next-gen
                            Application</span>
                        <span>to Build Sustainable Revenue Faster.</span>
                    </h2>
                    <p
                        class="mb-5 text-lg leading-relaxed text-dark text-opacity-75 dark:text-secondary dark:text-opacity-75">
                        {{ __(config('app.name')) }} is a leader in educational tech. We pioneered the merging of web
                        technologies into school management helping thousands of
                        administrators and school owners focus on pressing matters, leaving the heavy-lifting to us.
                    </p>
                    <p
                        class="mb-5 text-lg leading-relaxed text-dark text-opacity-75 dark:text-secondary dark:text-opacity-75">
                        At {{ __(config('app.name')) }}, we deliver quality professional services for your educational
                        institutions. We don't just simplify your everyday tasks, we help you track profits!
                    </p>
                    <div class="group inline-block">
                        <a wire:navigate href="{{ route('index') }}"
                            class="rounded-md bg-primary px-4 py-2 text-dark font-bold shadow-card-2 shadow-dark duration-300 group-hover:shadow-body-dark dark:shadow-light">
                            Know More
                        </a>
                    </div>
                </div>
                <div
                    class="relative z-10 mx-auto flex items-center justify-center overflow-hidden bg-primary py-10 w-4/5 md:w-1/5 h-full">
                    <div class="font-aladin">
                        <p class="mb-2 text-5xl font-bold">15+</p>
                        <p class="text-xl">Years of</p>
                        <p class="text-xl">Industry Experience</p>
                    </div>
                    <div>
                        <span class="absolute left-0 top-0 -z-10">
                            <svg width="106" height="144" viewBox="0 0 106 144" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.1" x="-67" y="47.127" width="113.378" height="131.304"
                                    transform="rotate(-42.8643 -67 47.127)" fill="url(#paint0_linear_1416_214)" />
                                <defs>
                                    <linearGradient id="paint0_linear_1416_214" x1="-10.3111" y1="47.127" x2="-10.3111"
                                        y2="178.431" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                        <span class="absolute right-0 top-0 -z-10">
                            <svg width="130" height="97" viewBox="0 0 130 97" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.1" x="0.86792" y="-6.67725" width="155.563" height="140.614"
                                    transform="rotate(-42.8643 0.86792 -6.67725)" fill="url(#paint0_linear_1416_215)" />
                                <defs>
                                    <linearGradient id="paint0_linear_1416_215" x1="78.6495" y1="-6.67725" x2="78.6495"
                                        y2="133.937" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                        <span class="absolute bottom-0 right-0 -z-10">
                            <svg width="175" height="104" viewBox="0 0 175 104" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.1" x="175.011" y="108.611" width="101.246" height="148.179"
                                    transform="rotate(137.136 175.011 108.611)" fill="url(#paint0_linear_1416_216)" />
                                <defs>
                                    <linearGradient id="paint0_linear_1416_216" x1="225.634" y1="108.611" x2="225.634"
                                        y2="256.79" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </section>
        {{-- About Section --}}
        {{-- CTA Section --}}
        <section class="bg-big-banner bg-cover bg-center text-center text-light">
            <div class="px-10 md:px-14 md:py-40 py-32">
                <h3 class="mb-5 text-3xl md:text-5xl">
                    <p class="mb-2 font-bold md:text-2xl text-xl leading-tight">Are you ready?</p>
                    <span class="font-extrabold leading-snug">Get started now!</span>
                </h3>
                <p class="mx-auto mb-10 max-w-[45ch] text-lg leading-normal text-white">
                    Join thousands of satisfied clients who use <span
                        class="font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">{{ __(Str::lower(config('app.name'))) }}</span>
                    to greatly simplify their
                    school operations.
                </p>
                <div class="group inline-block">
                    <a href="{{ route('index') }}#pricing"
                        class="rounded-md text-lg bg-primary px-4 py-2 font-bold text-dark shadow-card-2 shadow-dark duration-300 group-hover:shadow-body-dark dark:shadow-light">
                        Start today!</span>
                    </a>
                </div>
            </div>
        </section>
        {{-- CTA Section --}}
        {{-- Pricing Section --}}
        <section id="pricing" class="relative z-20 bg-secondary dark:bg-dark">
            <div class="px-10 py-32 md:px-20">
                <div class="mb-14 text-center lg:mb-28">
                    <p class="mb-2 text-lg md:text-xl font-semibold text-primary">
                        Pricing Table
                    </p>
                    <h2 class="mb-3 text-3xl font-extrabold text-dark dark:text-light md:text-4xl">
                        Subscriber Plans
                    </h2>
                    <p
                        class="mx-auto text-lg max-w-[45ch] text-body-dark text-opacity-75 dark:text-secondary dark:text-opacity-50">
                        No matter the school size or administrative work, we&apos;ve got the plan for you. The <span
                            class="font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">Buyer's
                            Top Pick</span> is the most subscribed and recommended option to purchase.
                    </p>
                </div>
                <div class="flex flex-col md:flex-row items-center justify-evenly gap-10 lg:gap-0">
                    <div
                        class="relative z-10 rounded-xl border border-body-dark bg-light p-10 text-dark dark:bg-body-dark scale-95 lg:scale-100 dark:text-secondary lg:p-12">
                        <p class="mb-2 text-lg font-bold">
                            Starter
                        </p>
                        <h2 class="mb-8 font-k-mono tracking-tighter">
                            <span class="text-xl font-bold text-primary lg:text-2xl">$</span>
                            <span class="text-2xl font-bold lg:text-3xl">25<sup class="text-lg">99</sup></span>
                            <span class="text-body-dark dark:text-light dark:text-opacity-60">
                                per month
                            </span>
                        </h2>
                        <div class="mb-8">
                            <div class="relative mb-4">
                                <h5
                                    class="mx-auto w-[55%] bg-light px-1 text-center font-agbalumo font-medium dark:bg-body-dark">
                                    FEATURES
                                </h5>
                                <span class="absolute top-1/2 -z-10 h-0.5 w-full bg-primary"></span>
                            </div>
                            <div class="flex flex-col gap-y-3 md:gap-y-4">
                                <p>
                                    Administrator&apos;s console
                                </p>
                                <p>
                                    Dashboard metrics
                                </p>
                                <p>
                                    Customer support
                                </p>
                                <p>
                                    Free updates
                                </p>
                            </div>
                        </div>
                        <div class="group">
                            <a wire:navigate href="{{ route('index') }}"
                                class="flex items-center justify-center rounded-md bg-primary px-4 py-2 font-medium text-light duration-300 group-hover:shadow-card-2 group-hover:shadow-dark dark:group-hover:shadow-light">
                                Subscribe
                            </a>
                        </div>
                    </div>
                    <div
                        class="relative z-10 scale-105 rounded-xl border border-body-dark bg-light p-10 text-dark dark:bg-body-dark dark:text-secondary lg:scale-110 lg:p-12">
                        <div>
                            <span class="absolute left-0 top-0 -z-10">
                                <svg width="106" height="144" viewBox="0 0 106 144" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.1" x="-67" y="47.127" width="113.378" height="131.304"
                                        transform="rotate(-42.8643 -67 47.127)" fill="url(#paint0_linear_1416_214)" />
                                    <defs>
                                        <linearGradient id="paint0_linear_1416_214" x1="-10.3111" y1="47.127"
                                            x2="-10.3111" y2="178.431" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="white" />
                                            <stop offset="1" stop-color="white" stop-opacity="1" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </span>
                            <span class="absolute right-0 top-0 -z-10">
                                <svg width="130" height="97" viewBox="0 0 130 97" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.1" x="0.86792" y="-6.67725" width="155.563" height="140.614"
                                        transform="rotate(-42.8643 0.86792 -6.67725)"
                                        fill="url(#paint0_linear_1416_215)" />
                                    <defs>
                                        <linearGradient id="paint0_linear_1416_215" x1="78.6495" y1="-6.67725"
                                            x2="78.6495" y2="133.937" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="white" />
                                            <stop offset="1" stop-color="white" stop-opacity="1" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </span>
                            <span class="absolute bottom-0 right-0 -z-10">
                                <svg width="175" height="104" viewBox="0 0 175 104" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.1" x="175.011" y="108.611" width="101.246" height="148.179"
                                        transform="rotate(137.136 175.011 108.611)"
                                        fill="url(#paint0_linear_1416_216)" />
                                    <defs>
                                        <linearGradient id="paint0_linear_1416_216" x1="225.634" y1="108.611"
                                            x2="225.634" y2="256.79" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="white" />
                                            <stop offset="1" stop-color="white" stop-opacity="1" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </span>
                        </div>
                        <p
                            class="absolute right-0 top-0 rounded-tr-xl bg-primary px-4 py-2 font-k-mono text-xs font-bold text-secondary">
                            Buyer&apos;s Top Pick
                        </p>
                        <p class="mb-2 text-lg font-bold">
                            Business
                        </p>
                        <h2 class="mb-8 font-k-mono tracking-tighter">
                            <span class="text-xl font-bold text-primary lg:text-2xl">$</span>
                            <span class="text-2xl font-bold lg:text-3xl">25<sup class="text-lg">99</sup></span>
                            <span class="text-body-dark dark:text-light dark:text-opacity-60">
                                per month
                            </span>
                        </h2>
                        <div class="mb-8">
                            <div class="relative mb-4">
                                <h5
                                    class="mx-auto w-[55%] bg-light px-1 text-center font-agbalumo font-medium dark:bg-body-dark">
                                    FEATURES
                                </h5>
                                <span class="absolute top-1/2 -z-10 h-0.5 w-full bg-primary"></span>
                            </div>
                            <div class="flex flex-col gap-y-3 md:gap-y-4">
                                <p
                                    class="font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">
                                    Starter tier bundle
                                </p>
                                <p>
                                    Staff and student&apos;s console
                                </p>
                                <p>
                                    Boosted adverts
                                </p>
                                <p>
                                    Polished settings
                                </p>
                            </div>
                        </div>
                        <div class="group">
                            <a wire:navigate href="{{ route('index') }}"
                                class="flex items-center justify-center rounded-md bg-primary px-4 py-2 font-medium text-light duration-300 group-hover:shadow-card-2 group-hover:shadow-dark dark:group-hover:shadow-light">
                                Subscribe
                            </a>
                        </div>
                    </div>
                    <div
                        class="relative scale-100 lg:scale-105 z-10 rounded-xl border border-body-dark bg-light p-10 text-dark dark:bg-body-dark dark:text-secondary lg:p-12">
                        <p class="mb-2 text-lg font-bold">
                            Enterprise
                        </p>
                        <h2 class="mb-8 font-k-mono tracking-tighter">
                            <span class="text-xl font-bold text-primary lg:text-2xl">$</span>
                            <span class="text-2xl font-bold lg:text-3xl">25<sup class="text-lg">99</sup></span>
                            <span class="text-body-dark dark:text-light dark:text-opacity-60">
                                per month
                            </span>
                        </h2>
                        <div class="mb-8">
                            <div class="relative mb-4">
                                <h5
                                    class="mx-auto w-[55%] bg-light px-1 text-center font-agbalumo font-medium dark:bg-body-dark">
                                    FEATURES
                                </h5>
                                <span class="absolute top-1/2 -z-10 h-0.5 w-full bg-primary"></span>
                            </div>
                            <div class="flex flex-col gap-y-3 md:gap-y-4">
                                <p
                                    class="font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">
                                    Business tier bundle
                                </p>
                                <p>
                                    Guardian&apos;s console
                                </p>
                                <p>
                                    AI improved adverts
                                </p>
                                <p>
                                    Premium customer support
                                </p>
                            </div>
                        </div>
                        <div class="group">
                            <a wire:navigate href="{{ route('index') }}"
                                class="flex items-center justify-center rounded-md bg-primary px-4 py-2 font-medium text-light duration-300 group-hover:shadow-card-2 group-hover:shadow-dark dark:group-hover:shadow-light">
                                Subscribe
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Pricing Section --}}
        {{-- Testimonials Section --}}
        <section class="bg-big-banner bg-cover bg-center text-center text-light">
            <div class="px-10 py-32">
                <div class="text-center mb-20">
                    <p class="mb-2 text-lg md:text-xl font-semibold text-primary">
                        Testimonials
                    </p>
                    <h2 class="mb-3 text-3xl font-extrabold text-light md:text-4xl">
                        What Our Clients Say
                    </h2>
                    <p class="mx-auto max-w-[45ch] text-lg text-opacity-75 text-light dark:text-opacity-50">
                        It&apos;s only a matter of minutes before your testimonials join the crew. Have a look.
                    </p>
                </div>
                <div>-- Testimonials go in here... --</div>
            </div>
        </section>
        {{-- Testimonials Section --}}
        {{-- FAQ Section --}}
        <section class="bg-secondary dark:bg-dark">
            <div class="py-20 px-10 md:py-32 md:px-20">
                <div class="mb-20 text-center">
                    <p class="mb-2 text-lg md:text-xl font-semibold text-primary">
                        FAQ
                    </p>
                    <h2 class="mb-3 text-3xl font-extrabold text-dark dark:text-light md:text-4xl">
                        Inquiries?
                    </h2>
                    <p
                        class="mx-auto text-lg max-w-[45ch] text-body-dark text-opacity-75 dark:text-secondary dark:text-opacity-50">
                        If you&apos;ve got any questions about {{ __(config('app.name')) }}&trade; and/or it&apos;s
                        services,
                        below are Frequently Asked Questions that might help.
                    </p>
                </div>
                <div data-accordion="collapse">
                    {{-- Accordion 1 --}}
                    <h6 id="accordion-open-heading-1">
                        <button type="button"
                            class="flex duration-300 items-center justify-between w-full p-5 font-medium rtl:text-right text-dark border border-b-0 border-body-dark focus:ring-1 focus:ring-dark dark:focus:ring-gray-800 dark:border-secondary dark:text-light hover:bg-secondary dark:hover:bg-body-dark gap-3"
                            data-accordion-target="#accordion-open-body-1" aria-expanded="true"
                            aria-controls="accordion-open-body-1">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 me-2 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                What is {{ __(config('app.name')) }}&trade;?
                            </span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h6>
                    <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                        <div class="p-5 border border-b-0 border-body-dark dark:border-secondary dark:bg-dark">
                            <p class="mb-2 text-dark dark:text-light">{{ __(config('app.name')) }}&trade;, a Cloud
                                Software as a
                                Service (CSaaS), is a school management
                                software boasting a dynamic AI-driven student information system built on top of the
                                internet.
                            </p>
                        </div>
                    </div>
                    {{-- Accordion 1 --}}
                    {{-- Accordion 2 --}}
                    <h6 id="accordion-open-heading-2">
                        <button type="button"
                            class="flex duration-300 items-center justify-between w-full p-5 font-medium rtl:text-right text-dark border border-b-0 border-body-dark focus:ring-1 focus:ring-dark dark:focus:ring-gray-800 dark:border-secondary dark:text-light hover:bg-secondary dark:hover:bg-body-dark gap-3"
                            data-accordion-target="#accordion-open-body-2" aria-expanded="true"
                            aria-controls="accordion-open-body-2">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 me-2 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Is {{ __(config('app.name')) }}&trade; free?
                            </span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h6>
                    <div id="accordion-open-body-2" class="hidden" aria-labelledby="accordion-open-heading-2">
                        <div class="p-5 border border-b-0 border-body-dark dark:border-secondary dark:bg-dark">
                            <p class="mb-2 text-dark dark:text-light">No. Services we offer to clients like you come at
                                a cost.
                                If {{ __(config('app.name')) }}&trade; was free, we absolutely won&apos;t be able to
                                deliver
                                quality services.</p>
                            <p class="text-dark dark:text-light">Our pricing plans are always pocket-friendly so as to
                                accommodate every level in the business world.</p>
                        </div>
                    </div>
                    {{-- Accordion 2 --}}
                    {{-- Accordion 3 --}}
                    <h6 id="accordion-open-heading-3">
                        <button type="button"
                            class="flex duration-300 items-center justify-between w-full p-5 font-medium rtl:text-right text-dark border border-b-[0.5px] border-body-dark focus:ring-1 focus:ring-dark dark:focus:ring-gray-800 dark:border-secondary dark:text-light hover:bg-secondary dark:hover:bg-body-dark gap-3"
                            data-accordion-target="#accordion-open-body-3" aria-expanded="true"
                            aria-controls="accordion-open-body-3">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 me-2 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Why am I grossing 10x better than before?
                            </span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h6>
                    <div id="accordion-open-body-3" class="hidden" aria-labelledby="accordion-open-heading-3">
                        <div class="p-5 border border-b-1 border-body-dark dark:border-secondary dark:bg-dark">
                            <p class="mb-2 text-dark dark:text-light">{{ __(config('app.name')) }}&trade; was built with
                                client&apos;s happiness in mind. We help you stay focused on things that matter the
                                most,
                                leaving the heavy-lifting to us.</p>
                            <p class="text-dark dark:text-light">It&apos;s called the
                                {{ __(config('app.name')) }}&trade;
                                Effect&trade;
                            </p>
                        </div>
                    </div>
                    {{-- Accordion 3 --}}
                </div>
        </section>
        {{-- FAQ Section --}}
        {{-- Team Section --}}
        <section id="team" class="bg-light dark:bg-dark">
            <div class="py-20 px-10 md:py-32 md:px-20">
                <div class="mb-20 text-center">
                    <p class="mb-2 text-lg md:text-xl font-semibold text-primary">
                        Team
                    </p>
                    <h2 class="mb-3 text-3xl font-extrabold text-dark dark:text-light md:text-4xl">
                        The Indomitable Union
                    </h2>
                    <p
                        class="mx-auto text-lg max-w-[45ch] text-body-dark text-opacity-75 dark:text-secondary dark:text-opacity-50">
                        These are the individuals who devoted precious time, energy, and material resource to make
                        <span
                            class="font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400">{{ __(config('app.name')) }}&trade;</span>
                        an industry success.
                    </p>
                </div>
                <div class="flex items-center justify-center flex-wrap mx-auto w-full">
                    <div class="w-full p-4 md:w-1/2 lg:w-1/4">
                        <div class="group mb-8 rounded-xl bg-secondary lg:p-6 px-5 py-10 dark:bg-body-dark">
                            <div class="relative z-10 mx-auto mb-5 h-28 w-28">
                                <img loading="lazy" src="{{ asset('src/images/website/team/team-04.png') }}"
                                    alt="team image" class="h-28 w-28 rounded-full" />
                                <span
                                    class="absolute bottom-0 left-0 -z-10 h-10 w-10 rounded-full bg-primary opacity-0 transition-all group-hover:opacity-100"></span>
                                <span
                                    class="absolute right-0 top-0 -z-10 opacity-0 transition-all group-hover:opacity-100">
                                    <svg width="55" height="53" viewBox="0 0 55 53" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 3.1009C13.3681 3.1009 14.0622 2.40674 14.0622 1.55045C14.0622 0.69416 13.3681 0 12.5118 0C11.6555 0 10.9613 0.69416 10.9613 1.55045C10.9613 2.40674 11.6555 3.1009 12.5118 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 3.1009C23.3601 3.1009 24.0543 2.40674 24.0543 1.55045C24.0543 0.69416 23.3601 0 22.5038 0C21.6475 0 20.9534 0.69416 20.9534 1.55045C20.9534 2.40674 21.6475 3.1009 22.5038 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 3.1009C33.3521 3.1009 34.0463 2.40674 34.0463 1.55045C34.0463 0.69416 33.3521 0 32.4958 0C31.6395 0 30.9454 0.69416 30.9454 1.55045C30.9454 2.40674 31.6395 3.1009 32.4958 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 3.1009C43.3438 3.1009 44.038 2.40674 44.038 1.55045C44.038 0.69416 43.3438 0 42.4875 0C41.6312 0 40.9371 0.69416 40.9371 1.55045C40.9371 2.40674 41.6312 3.1009 42.4875 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 3.1009C53.3358 3.1009 54.03 2.40674 54.03 1.55045C54.03 0.69416 53.3358 0 52.4795 0C51.6233 0 50.9291 0.69416 50.9291 1.55045C50.9291 2.40674 51.6233 3.1009 52.4795 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 13.0804C3.37674 13.0804 4.0709 12.3862 4.0709 11.5299C4.0709 10.6737 3.37674 9.97949 2.52045 9.97949C1.66416 9.97949 0.970001 10.6737 0.970001 11.5299C0.970001 12.3862 1.66416 13.0804 2.52045 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 13.0804C13.3681 13.0804 14.0622 12.3862 14.0622 11.5299C14.0622 10.6737 13.3681 9.97949 12.5118 9.97949C11.6555 9.97949 10.9613 10.6737 10.9613 11.5299C10.9613 12.3862 11.6555 13.0804 12.5118 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 13.0804C23.3601 13.0804 24.0543 12.3862 24.0543 11.5299C24.0543 10.6737 23.3601 9.97949 22.5038 9.97949C21.6475 9.97949 20.9534 10.6737 20.9534 11.5299C20.9534 12.3862 21.6475 13.0804 22.5038 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 13.0804C33.3521 13.0804 34.0463 12.3862 34.0463 11.5299C34.0463 10.6737 33.3521 9.97949 32.4958 9.97949C31.6395 9.97949 30.9454 10.6737 30.9454 11.5299C30.9454 12.3862 31.6395 13.0804 32.4958 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 13.0804C43.3438 13.0804 44.038 12.3862 44.038 11.5299C44.038 10.6737 43.3438 9.97949 42.4875 9.97949C41.6312 9.97949 40.9371 10.6737 40.9371 11.5299C40.9371 12.3862 41.6312 13.0804 42.4875 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 13.0804C53.3358 13.0804 54.03 12.3862 54.03 11.5299C54.03 10.6737 53.3358 9.97949 52.4795 9.97949C51.6233 9.97949 50.9291 10.6737 50.9291 11.5299C50.9291 12.3862 51.6233 13.0804 52.4795 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 23.0604C3.37674 23.0604 4.0709 22.3662 4.0709 21.5099C4.0709 20.6536 3.37674 19.9595 2.52045 19.9595C1.66416 19.9595 0.970001 20.6536 0.970001 21.5099C0.970001 22.3662 1.66416 23.0604 2.52045 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 23.0604C13.3681 23.0604 14.0622 22.3662 14.0622 21.5099C14.0622 20.6536 13.3681 19.9595 12.5118 19.9595C11.6555 19.9595 10.9613 20.6536 10.9613 21.5099C10.9613 22.3662 11.6555 23.0604 12.5118 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 23.0604C23.3601 23.0604 24.0543 22.3662 24.0543 21.5099C24.0543 20.6536 23.3601 19.9595 22.5038 19.9595C21.6475 19.9595 20.9534 20.6536 20.9534 21.5099C20.9534 22.3662 21.6475 23.0604 22.5038 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 23.0604C33.3521 23.0604 34.0463 22.3662 34.0463 21.5099C34.0463 20.6536 33.3521 19.9595 32.4958 19.9595C31.6395 19.9595 30.9454 20.6536 30.9454 21.5099C30.9454 22.3662 31.6395 23.0604 32.4958 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 23.0604C43.3438 23.0604 44.038 22.3662 44.038 21.5099C44.038 20.6536 43.3438 19.9595 42.4875 19.9595C41.6312 19.9595 40.9371 20.6536 40.9371 21.5099C40.9371 22.3662 41.6312 23.0604 42.4875 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 23.0604C53.3358 23.0604 54.03 22.3662 54.03 21.5099C54.03 20.6536 53.3358 19.9595 52.4795 19.9595C51.6233 19.9595 50.9291 20.6536 50.9291 21.5099C50.9291 22.3662 51.6233 23.0604 52.4795 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 33.0404C3.37674 33.0404 4.0709 32.3462 4.0709 31.4899C4.0709 30.6336 3.37674 29.9395 2.52045 29.9395C1.66416 29.9395 0.970001 30.6336 0.970001 31.4899C0.970001 32.3462 1.66416 33.0404 2.52045 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 33.0404C13.3681 33.0404 14.0622 32.3462 14.0622 31.4899C14.0622 30.6336 13.3681 29.9395 12.5118 29.9395C11.6555 29.9395 10.9613 30.6336 10.9613 31.4899C10.9613 32.3462 11.6555 33.0404 12.5118 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 33.0404C23.3601 33.0404 24.0543 32.3462 24.0543 31.4899C24.0543 30.6336 23.3601 29.9395 22.5038 29.9395C21.6475 29.9395 20.9534 30.6336 20.9534 31.4899C20.9534 32.3462 21.6475 33.0404 22.5038 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 33.0404C33.3521 33.0404 34.0463 32.3462 34.0463 31.4899C34.0463 30.6336 33.3521 29.9395 32.4958 29.9395C31.6395 29.9395 30.9454 30.6336 30.9454 31.4899C30.9454 32.3462 31.6395 33.0404 32.4958 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 33.0404C43.3438 33.0404 44.038 32.3462 44.038 31.4899C44.038 30.6336 43.3438 29.9395 42.4875 29.9395C41.6312 29.9395 40.9371 30.6336 40.9371 31.4899C40.9371 32.3462 41.6312 33.0404 42.4875 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 33.0404C53.3358 33.0404 54.03 32.3462 54.03 31.4899C54.03 30.6336 53.3358 29.9395 52.4795 29.9395C51.6233 29.9395 50.9291 30.6336 50.9291 31.4899C50.9291 32.3462 51.6233 33.0404 52.4795 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 43.0203C3.37674 43.0203 4.0709 42.3262 4.0709 41.4699C4.0709 40.6136 3.37674 39.9194 2.52045 39.9194C1.66416 39.9194 0.970001 40.6136 0.970001 41.4699C0.970001 42.3262 1.66416 43.0203 2.52045 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 43.0203C13.3681 43.0203 14.0622 42.3262 14.0622 41.4699C14.0622 40.6136 13.3681 39.9194 12.5118 39.9194C11.6555 39.9194 10.9613 40.6136 10.9613 41.4699C10.9613 42.3262 11.6555 43.0203 12.5118 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 43.0203C23.3601 43.0203 24.0543 42.3262 24.0543 41.4699C24.0543 40.6136 23.3601 39.9194 22.5038 39.9194C21.6475 39.9194 20.9534 40.6136 20.9534 41.4699C20.9534 42.3262 21.6475 43.0203 22.5038 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 43.0203C33.3521 43.0203 34.0463 42.3262 34.0463 41.4699C34.0463 40.6136 33.3521 39.9194 32.4958 39.9194C31.6395 39.9194 30.9454 40.6136 30.9454 41.4699C30.9454 42.3262 31.6395 43.0203 32.4958 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 43.0203C43.3438 43.0203 44.038 42.3262 44.038 41.4699C44.038 40.6136 43.3438 39.9194 42.4875 39.9194C41.6312 39.9194 40.9371 40.6136 40.9371 41.4699C40.9371 42.3262 41.6312 43.0203 42.4875 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 43.0203C53.3358 43.0203 54.03 42.3262 54.03 41.4699C54.03 40.6136 53.3358 39.9194 52.4795 39.9194C51.6233 39.9194 50.9291 40.6136 50.9291 41.4699C50.9291 42.3262 51.6233 43.0203 52.4795 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 53.0001C3.37674 53.0001 4.0709 52.3059 4.0709 51.4496C4.0709 50.5933 3.37674 49.8992 2.52045 49.8992C1.66416 49.8992 0.970001 50.5933 0.970001 51.4496C0.970001 52.3059 1.66416 53.0001 2.52045 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 53.0001C13.3681 53.0001 14.0622 52.3059 14.0622 51.4496C14.0622 50.5933 13.3681 49.8992 12.5118 49.8992C11.6555 49.8992 10.9613 50.5933 10.9613 51.4496C10.9613 52.3059 11.6555 53.0001 12.5118 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 53.0001C23.3601 53.0001 24.0543 52.3059 24.0543 51.4496C24.0543 50.5933 23.3601 49.8992 22.5038 49.8992C21.6475 49.8992 20.9534 50.5933 20.9534 51.4496C20.9534 52.3059 21.6475 53.0001 22.5038 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 53.0001C33.3521 53.0001 34.0463 52.3059 34.0463 51.4496C34.0463 50.5933 33.3521 49.8992 32.4958 49.8992C31.6395 49.8992 30.9454 50.5933 30.9454 51.4496C30.9454 52.3059 31.6395 53.0001 32.4958 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 53.0001C43.3438 53.0001 44.038 52.3059 44.038 51.4496C44.038 50.5933 43.3438 49.8992 42.4875 49.8992C41.6312 49.8992 40.9371 50.5933 40.9371 51.4496C40.9371 52.3059 41.6312 53.0001 42.4875 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 53.0001C53.3358 53.0001 54.03 52.3059 54.03 51.4496C54.03 50.5933 53.3358 49.8992 52.4795 49.8992C51.6233 49.8992 50.9291 50.5933 50.9291 51.4496C50.9291 52.3059 51.6233 53.0001 52.4795 53.0001Z"
                                            fill="#3758F9" />
                                    </svg>
                                </span>
                            </div>
                            <div class="text-center">
                                <h4 class="mb-1 text-lg font-semibold text-dark dark:text-light">
                                    The MAHD SCIENTIST
                                </h4>
                                <p class="mb-5 text-sm text-body-dark dark:text-secondary">
                                    Software Developer
                                </p>
                                <div class="flex items-center justify-center gap-5">
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M13.3315 7.25625H11.7565H11.194V6.69375V4.95V4.3875H11.7565H12.9377C13.2471 4.3875 13.5002 4.1625 13.5002 3.825V0.84375C13.5002 0.534375 13.2752 0.28125 12.9377 0.28125H10.8846C8.66272 0.28125 7.11584 1.85625 7.11584 4.19062V6.6375V7.2H6.55334H4.64084C4.24709 7.2 3.88147 7.50937 3.88147 7.95937V9.98438C3.88147 10.3781 4.19084 10.7438 4.64084 10.7438H6.49709H7.05959V11.3063V16.9594C7.05959 17.3531 7.36897 17.7188 7.81897 17.7188H10.4627C10.6315 17.7188 10.7721 17.6344 10.8846 17.5219C10.9971 17.4094 11.0815 17.2125 11.0815 17.0437V11.3344V10.7719H11.6721H12.9377C13.3033 10.7719 13.5846 10.5469 13.6408 10.2094V10.1813V10.1531L14.0346 8.2125C14.0627 8.01562 14.0346 7.79063 13.8658 7.56562C13.8096 7.425 13.5565 7.28437 13.3315 7.25625Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M16.4647 4.83752C16.565 4.72065 16.4343 4.56793 16.2859 4.62263C15.9549 4.74474 15.6523 4.82528 15.2049 4.875C15.7552 4.56855 16.0112 4.13054 16.2194 3.59407C16.2696 3.46467 16.1182 3.34725 15.9877 3.40907C15.458 3.66023 14.8864 3.84658 14.2854 3.95668C13.6913 3.3679 12.8445 3 11.9077 3C10.1089 3 8.65027 4.35658 8.65027 6.02938C8.65027 6.26686 8.67937 6.49818 8.73427 6.71966C6.14854 6.59919 3.84286 5.49307 2.24098 3.79696C2.13119 3.68071 1.93197 3.69614 1.86361 3.83792C1.68124 4.21619 1.57957 4.63582 1.57957 5.07762C1.57957 6.12843 2.15446 7.05557 3.02837 7.59885C2.63653 7.58707 2.2618 7.51073 1.91647 7.38116C1.74834 7.31808 1.5556 7.42893 1.57819 7.59847C1.75162 8.9004 2.80568 9.97447 4.16624 10.2283C3.89302 10.2978 3.60524 10.3347 3.30754 10.3347C3.23536 10.3347 3.16381 10.3324 3.0929 10.3281C2.91247 10.3169 2.76583 10.4783 2.84319 10.6328C3.35357 11.6514 4.45563 12.3625 5.73809 12.3847C4.62337 13.1974 3.21889 13.6816 1.69269 13.6816C1.50451 13.6816 1.42378 13.9235 1.59073 14.0056C2.88015 14.6394 4.34854 15 5.90878 15C11.9005 15 15.1765 10.384 15.1765 6.38067C15.1765 6.24963 15.1732 6.11858 15.1672 5.98877C15.6535 5.66205 16.0907 5.27354 16.4647 4.83752Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M9.02429 11.8066C10.5742 11.8066 11.8307 10.5501 11.8307 9.00018C11.8307 7.45022 10.5742 6.19373 9.02429 6.19373C7.47433 6.19373 6.21783 7.45022 6.21783 9.00018C6.21783 10.5501 7.47433 11.8066 9.02429 11.8066Z"
                                                fill="" />
                                            <path
                                                d="M12.0726 1.5H5.92742C3.48387 1.5 1.5 3.48387 1.5 5.92742V12.0242C1.5 14.5161 3.48387 16.5 5.92742 16.5H12.0242C14.5161 16.5 16.5 14.5161 16.5 12.0726V5.92742C16.5 3.48387 14.5161 1.5 12.0726 1.5ZM9.02419 12.6774C6.96774 12.6774 5.34677 11.0081 5.34677 9C5.34677 6.99194 6.99194 5.32258 9.02419 5.32258C11.0323 5.32258 12.6774 6.99194 12.6774 9C12.6774 11.0081 11.0565 12.6774 9.02419 12.6774ZM14.1048 5.66129C13.8629 5.92742 13.5 6.07258 13.0887 6.07258C12.7258 6.07258 12.3629 5.92742 12.0726 5.66129C11.8065 5.39516 11.6613 5.05645 11.6613 4.64516C11.6613 4.23387 11.8065 3.91935 12.0726 3.62903C12.3387 3.33871 12.6774 3.19355 13.0887 3.19355C13.4516 3.19355 13.8387 3.33871 14.1048 3.60484C14.3468 3.91935 14.5161 4.28226 14.5161 4.66935C14.4919 5.05645 14.3468 5.39516 14.1048 5.66129Z"
                                                fill="" />
                                            <path
                                                d="M13.1135 4.06433C12.799 4.06433 12.5329 4.33046 12.5329 4.64498C12.5329 4.95949 12.799 5.22562 13.1135 5.22562C13.428 5.22562 13.6942 4.95949 13.6942 4.64498C13.6942 4.33046 13.4522 4.06433 13.1135 4.06433Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full p-4 md:w-1/2 lg:w-1/4">
                        <div class="group mb-8 rounded-xl bg-secondary lg:p-6 px-5 py-10 dark:bg-body-dark">
                            <div class="relative z-10 mx-auto mb-5 h-28 w-28">
                                <img loading="lazy" src="{{ asset('src/images/website/team/team-04.png') }}"
                                    alt="team image" class="h-28 w-28 rounded-full" />
                                <span
                                    class="absolute bottom-0 left-0 -z-10 h-10 w-10 rounded-full bg-primary opacity-0 transition-all group-hover:opacity-100"></span>
                                <span
                                    class="absolute right-0 top-0 -z-10 opacity-0 transition-all group-hover:opacity-100">
                                    <svg width="55" height="53" viewBox="0 0 55 53" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 3.1009C13.3681 3.1009 14.0622 2.40674 14.0622 1.55045C14.0622 0.69416 13.3681 0 12.5118 0C11.6555 0 10.9613 0.69416 10.9613 1.55045C10.9613 2.40674 11.6555 3.1009 12.5118 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 3.1009C23.3601 3.1009 24.0543 2.40674 24.0543 1.55045C24.0543 0.69416 23.3601 0 22.5038 0C21.6475 0 20.9534 0.69416 20.9534 1.55045C20.9534 2.40674 21.6475 3.1009 22.5038 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 3.1009C33.3521 3.1009 34.0463 2.40674 34.0463 1.55045C34.0463 0.69416 33.3521 0 32.4958 0C31.6395 0 30.9454 0.69416 30.9454 1.55045C30.9454 2.40674 31.6395 3.1009 32.4958 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 3.1009C43.3438 3.1009 44.038 2.40674 44.038 1.55045C44.038 0.69416 43.3438 0 42.4875 0C41.6312 0 40.9371 0.69416 40.9371 1.55045C40.9371 2.40674 41.6312 3.1009 42.4875 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 3.1009C53.3358 3.1009 54.03 2.40674 54.03 1.55045C54.03 0.69416 53.3358 0 52.4795 0C51.6233 0 50.9291 0.69416 50.9291 1.55045C50.9291 2.40674 51.6233 3.1009 52.4795 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 13.0804C3.37674 13.0804 4.0709 12.3862 4.0709 11.5299C4.0709 10.6737 3.37674 9.97949 2.52045 9.97949C1.66416 9.97949 0.970001 10.6737 0.970001 11.5299C0.970001 12.3862 1.66416 13.0804 2.52045 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 13.0804C13.3681 13.0804 14.0622 12.3862 14.0622 11.5299C14.0622 10.6737 13.3681 9.97949 12.5118 9.97949C11.6555 9.97949 10.9613 10.6737 10.9613 11.5299C10.9613 12.3862 11.6555 13.0804 12.5118 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 13.0804C23.3601 13.0804 24.0543 12.3862 24.0543 11.5299C24.0543 10.6737 23.3601 9.97949 22.5038 9.97949C21.6475 9.97949 20.9534 10.6737 20.9534 11.5299C20.9534 12.3862 21.6475 13.0804 22.5038 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 13.0804C33.3521 13.0804 34.0463 12.3862 34.0463 11.5299C34.0463 10.6737 33.3521 9.97949 32.4958 9.97949C31.6395 9.97949 30.9454 10.6737 30.9454 11.5299C30.9454 12.3862 31.6395 13.0804 32.4958 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 13.0804C43.3438 13.0804 44.038 12.3862 44.038 11.5299C44.038 10.6737 43.3438 9.97949 42.4875 9.97949C41.6312 9.97949 40.9371 10.6737 40.9371 11.5299C40.9371 12.3862 41.6312 13.0804 42.4875 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 13.0804C53.3358 13.0804 54.03 12.3862 54.03 11.5299C54.03 10.6737 53.3358 9.97949 52.4795 9.97949C51.6233 9.97949 50.9291 10.6737 50.9291 11.5299C50.9291 12.3862 51.6233 13.0804 52.4795 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 23.0604C3.37674 23.0604 4.0709 22.3662 4.0709 21.5099C4.0709 20.6536 3.37674 19.9595 2.52045 19.9595C1.66416 19.9595 0.970001 20.6536 0.970001 21.5099C0.970001 22.3662 1.66416 23.0604 2.52045 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 23.0604C13.3681 23.0604 14.0622 22.3662 14.0622 21.5099C14.0622 20.6536 13.3681 19.9595 12.5118 19.9595C11.6555 19.9595 10.9613 20.6536 10.9613 21.5099C10.9613 22.3662 11.6555 23.0604 12.5118 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 23.0604C23.3601 23.0604 24.0543 22.3662 24.0543 21.5099C24.0543 20.6536 23.3601 19.9595 22.5038 19.9595C21.6475 19.9595 20.9534 20.6536 20.9534 21.5099C20.9534 22.3662 21.6475 23.0604 22.5038 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 23.0604C33.3521 23.0604 34.0463 22.3662 34.0463 21.5099C34.0463 20.6536 33.3521 19.9595 32.4958 19.9595C31.6395 19.9595 30.9454 20.6536 30.9454 21.5099C30.9454 22.3662 31.6395 23.0604 32.4958 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 23.0604C43.3438 23.0604 44.038 22.3662 44.038 21.5099C44.038 20.6536 43.3438 19.9595 42.4875 19.9595C41.6312 19.9595 40.9371 20.6536 40.9371 21.5099C40.9371 22.3662 41.6312 23.0604 42.4875 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 23.0604C53.3358 23.0604 54.03 22.3662 54.03 21.5099C54.03 20.6536 53.3358 19.9595 52.4795 19.9595C51.6233 19.9595 50.9291 20.6536 50.9291 21.5099C50.9291 22.3662 51.6233 23.0604 52.4795 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 33.0404C3.37674 33.0404 4.0709 32.3462 4.0709 31.4899C4.0709 30.6336 3.37674 29.9395 2.52045 29.9395C1.66416 29.9395 0.970001 30.6336 0.970001 31.4899C0.970001 32.3462 1.66416 33.0404 2.52045 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 33.0404C13.3681 33.0404 14.0622 32.3462 14.0622 31.4899C14.0622 30.6336 13.3681 29.9395 12.5118 29.9395C11.6555 29.9395 10.9613 30.6336 10.9613 31.4899C10.9613 32.3462 11.6555 33.0404 12.5118 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 33.0404C23.3601 33.0404 24.0543 32.3462 24.0543 31.4899C24.0543 30.6336 23.3601 29.9395 22.5038 29.9395C21.6475 29.9395 20.9534 30.6336 20.9534 31.4899C20.9534 32.3462 21.6475 33.0404 22.5038 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 33.0404C33.3521 33.0404 34.0463 32.3462 34.0463 31.4899C34.0463 30.6336 33.3521 29.9395 32.4958 29.9395C31.6395 29.9395 30.9454 30.6336 30.9454 31.4899C30.9454 32.3462 31.6395 33.0404 32.4958 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 33.0404C43.3438 33.0404 44.038 32.3462 44.038 31.4899C44.038 30.6336 43.3438 29.9395 42.4875 29.9395C41.6312 29.9395 40.9371 30.6336 40.9371 31.4899C40.9371 32.3462 41.6312 33.0404 42.4875 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 33.0404C53.3358 33.0404 54.03 32.3462 54.03 31.4899C54.03 30.6336 53.3358 29.9395 52.4795 29.9395C51.6233 29.9395 50.9291 30.6336 50.9291 31.4899C50.9291 32.3462 51.6233 33.0404 52.4795 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 43.0203C3.37674 43.0203 4.0709 42.3262 4.0709 41.4699C4.0709 40.6136 3.37674 39.9194 2.52045 39.9194C1.66416 39.9194 0.970001 40.6136 0.970001 41.4699C0.970001 42.3262 1.66416 43.0203 2.52045 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 43.0203C13.3681 43.0203 14.0622 42.3262 14.0622 41.4699C14.0622 40.6136 13.3681 39.9194 12.5118 39.9194C11.6555 39.9194 10.9613 40.6136 10.9613 41.4699C10.9613 42.3262 11.6555 43.0203 12.5118 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 43.0203C23.3601 43.0203 24.0543 42.3262 24.0543 41.4699C24.0543 40.6136 23.3601 39.9194 22.5038 39.9194C21.6475 39.9194 20.9534 40.6136 20.9534 41.4699C20.9534 42.3262 21.6475 43.0203 22.5038 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 43.0203C33.3521 43.0203 34.0463 42.3262 34.0463 41.4699C34.0463 40.6136 33.3521 39.9194 32.4958 39.9194C31.6395 39.9194 30.9454 40.6136 30.9454 41.4699C30.9454 42.3262 31.6395 43.0203 32.4958 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 43.0203C43.3438 43.0203 44.038 42.3262 44.038 41.4699C44.038 40.6136 43.3438 39.9194 42.4875 39.9194C41.6312 39.9194 40.9371 40.6136 40.9371 41.4699C40.9371 42.3262 41.6312 43.0203 42.4875 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 43.0203C53.3358 43.0203 54.03 42.3262 54.03 41.4699C54.03 40.6136 53.3358 39.9194 52.4795 39.9194C51.6233 39.9194 50.9291 40.6136 50.9291 41.4699C50.9291 42.3262 51.6233 43.0203 52.4795 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 53.0001C3.37674 53.0001 4.0709 52.3059 4.0709 51.4496C4.0709 50.5933 3.37674 49.8992 2.52045 49.8992C1.66416 49.8992 0.970001 50.5933 0.970001 51.4496C0.970001 52.3059 1.66416 53.0001 2.52045 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 53.0001C13.3681 53.0001 14.0622 52.3059 14.0622 51.4496C14.0622 50.5933 13.3681 49.8992 12.5118 49.8992C11.6555 49.8992 10.9613 50.5933 10.9613 51.4496C10.9613 52.3059 11.6555 53.0001 12.5118 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 53.0001C23.3601 53.0001 24.0543 52.3059 24.0543 51.4496C24.0543 50.5933 23.3601 49.8992 22.5038 49.8992C21.6475 49.8992 20.9534 50.5933 20.9534 51.4496C20.9534 52.3059 21.6475 53.0001 22.5038 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 53.0001C33.3521 53.0001 34.0463 52.3059 34.0463 51.4496C34.0463 50.5933 33.3521 49.8992 32.4958 49.8992C31.6395 49.8992 30.9454 50.5933 30.9454 51.4496C30.9454 52.3059 31.6395 53.0001 32.4958 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 53.0001C43.3438 53.0001 44.038 52.3059 44.038 51.4496C44.038 50.5933 43.3438 49.8992 42.4875 49.8992C41.6312 49.8992 40.9371 50.5933 40.9371 51.4496C40.9371 52.3059 41.6312 53.0001 42.4875 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 53.0001C53.3358 53.0001 54.03 52.3059 54.03 51.4496C54.03 50.5933 53.3358 49.8992 52.4795 49.8992C51.6233 49.8992 50.9291 50.5933 50.9291 51.4496C50.9291 52.3059 51.6233 53.0001 52.4795 53.0001Z"
                                            fill="#3758F9" />
                                    </svg>
                                </span>
                            </div>
                            <div class="text-center">
                                <h4 class="mb-1 text-lg font-semibold text-dark dark:text-light">
                                    Emmanuel Akudinobi
                                </h4>
                                <p class="mb-5 text-sm text-body-dark dark:text-secondary">
                                    Software Developer &amp; CEO
                                </p>
                                <div class="flex items-center justify-center gap-5">
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M13.3315 7.25625H11.7565H11.194V6.69375V4.95V4.3875H11.7565H12.9377C13.2471 4.3875 13.5002 4.1625 13.5002 3.825V0.84375C13.5002 0.534375 13.2752 0.28125 12.9377 0.28125H10.8846C8.66272 0.28125 7.11584 1.85625 7.11584 4.19062V6.6375V7.2H6.55334H4.64084C4.24709 7.2 3.88147 7.50937 3.88147 7.95937V9.98438C3.88147 10.3781 4.19084 10.7438 4.64084 10.7438H6.49709H7.05959V11.3063V16.9594C7.05959 17.3531 7.36897 17.7188 7.81897 17.7188H10.4627C10.6315 17.7188 10.7721 17.6344 10.8846 17.5219C10.9971 17.4094 11.0815 17.2125 11.0815 17.0437V11.3344V10.7719H11.6721H12.9377C13.3033 10.7719 13.5846 10.5469 13.6408 10.2094V10.1813V10.1531L14.0346 8.2125C14.0627 8.01562 14.0346 7.79063 13.8658 7.56562C13.8096 7.425 13.5565 7.28437 13.3315 7.25625Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M16.4647 4.83752C16.565 4.72065 16.4343 4.56793 16.2859 4.62263C15.9549 4.74474 15.6523 4.82528 15.2049 4.875C15.7552 4.56855 16.0112 4.13054 16.2194 3.59407C16.2696 3.46467 16.1182 3.34725 15.9877 3.40907C15.458 3.66023 14.8864 3.84658 14.2854 3.95668C13.6913 3.3679 12.8445 3 11.9077 3C10.1089 3 8.65027 4.35658 8.65027 6.02938C8.65027 6.26686 8.67937 6.49818 8.73427 6.71966C6.14854 6.59919 3.84286 5.49307 2.24098 3.79696C2.13119 3.68071 1.93197 3.69614 1.86361 3.83792C1.68124 4.21619 1.57957 4.63582 1.57957 5.07762C1.57957 6.12843 2.15446 7.05557 3.02837 7.59885C2.63653 7.58707 2.2618 7.51073 1.91647 7.38116C1.74834 7.31808 1.5556 7.42893 1.57819 7.59847C1.75162 8.9004 2.80568 9.97447 4.16624 10.2283C3.89302 10.2978 3.60524 10.3347 3.30754 10.3347C3.23536 10.3347 3.16381 10.3324 3.0929 10.3281C2.91247 10.3169 2.76583 10.4783 2.84319 10.6328C3.35357 11.6514 4.45563 12.3625 5.73809 12.3847C4.62337 13.1974 3.21889 13.6816 1.69269 13.6816C1.50451 13.6816 1.42378 13.9235 1.59073 14.0056C2.88015 14.6394 4.34854 15 5.90878 15C11.9005 15 15.1765 10.384 15.1765 6.38067C15.1765 6.24963 15.1732 6.11858 15.1672 5.98877C15.6535 5.66205 16.0907 5.27354 16.4647 4.83752Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M9.02429 11.8066C10.5742 11.8066 11.8307 10.5501 11.8307 9.00018C11.8307 7.45022 10.5742 6.19373 9.02429 6.19373C7.47433 6.19373 6.21783 7.45022 6.21783 9.00018C6.21783 10.5501 7.47433 11.8066 9.02429 11.8066Z"
                                                fill="" />
                                            <path
                                                d="M12.0726 1.5H5.92742C3.48387 1.5 1.5 3.48387 1.5 5.92742V12.0242C1.5 14.5161 3.48387 16.5 5.92742 16.5H12.0242C14.5161 16.5 16.5 14.5161 16.5 12.0726V5.92742C16.5 3.48387 14.5161 1.5 12.0726 1.5ZM9.02419 12.6774C6.96774 12.6774 5.34677 11.0081 5.34677 9C5.34677 6.99194 6.99194 5.32258 9.02419 5.32258C11.0323 5.32258 12.6774 6.99194 12.6774 9C12.6774 11.0081 11.0565 12.6774 9.02419 12.6774ZM14.1048 5.66129C13.8629 5.92742 13.5 6.07258 13.0887 6.07258C12.7258 6.07258 12.3629 5.92742 12.0726 5.66129C11.8065 5.39516 11.6613 5.05645 11.6613 4.64516C11.6613 4.23387 11.8065 3.91935 12.0726 3.62903C12.3387 3.33871 12.6774 3.19355 13.0887 3.19355C13.4516 3.19355 13.8387 3.33871 14.1048 3.60484C14.3468 3.91935 14.5161 4.28226 14.5161 4.66935C14.4919 5.05645 14.3468 5.39516 14.1048 5.66129Z"
                                                fill="" />
                                            <path
                                                d="M13.1135 4.06433C12.799 4.06433 12.5329 4.33046 12.5329 4.64498C12.5329 4.95949 12.799 5.22562 13.1135 5.22562C13.428 5.22562 13.6942 4.95949 13.6942 4.64498C13.6942 4.33046 13.4522 4.06433 13.1135 4.06433Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full p-4 md:w-1/2 lg:w-1/4">
                        <div class="group mb-8 rounded-xl bg-secondary lg:p-6 px-5 py-10 dark:bg-body-dark">
                            <div class="relative z-10 mx-auto mb-5 h-28 w-28">
                                <img loading="lazy" src="{{ asset('src/images/website/team/team-04.png') }}"
                                    alt="team image" class="h-28 w-28 rounded-full" />
                                <span
                                    class="absolute bottom-0 left-0 -z-10 h-10 w-10 rounded-full bg-primary opacity-0 transition-all group-hover:opacity-100"></span>
                                <span
                                    class="absolute right-0 top-0 -z-10 opacity-0 transition-all group-hover:opacity-100">
                                    <svg width="55" height="53" viewBox="0 0 55 53" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 3.1009C13.3681 3.1009 14.0622 2.40674 14.0622 1.55045C14.0622 0.69416 13.3681 0 12.5118 0C11.6555 0 10.9613 0.69416 10.9613 1.55045C10.9613 2.40674 11.6555 3.1009 12.5118 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 3.1009C23.3601 3.1009 24.0543 2.40674 24.0543 1.55045C24.0543 0.69416 23.3601 0 22.5038 0C21.6475 0 20.9534 0.69416 20.9534 1.55045C20.9534 2.40674 21.6475 3.1009 22.5038 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 3.1009C33.3521 3.1009 34.0463 2.40674 34.0463 1.55045C34.0463 0.69416 33.3521 0 32.4958 0C31.6395 0 30.9454 0.69416 30.9454 1.55045C30.9454 2.40674 31.6395 3.1009 32.4958 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 3.1009C43.3438 3.1009 44.038 2.40674 44.038 1.55045C44.038 0.69416 43.3438 0 42.4875 0C41.6312 0 40.9371 0.69416 40.9371 1.55045C40.9371 2.40674 41.6312 3.1009 42.4875 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 3.1009C53.3358 3.1009 54.03 2.40674 54.03 1.55045C54.03 0.69416 53.3358 0 52.4795 0C51.6233 0 50.9291 0.69416 50.9291 1.55045C50.9291 2.40674 51.6233 3.1009 52.4795 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 13.0804C3.37674 13.0804 4.0709 12.3862 4.0709 11.5299C4.0709 10.6737 3.37674 9.97949 2.52045 9.97949C1.66416 9.97949 0.970001 10.6737 0.970001 11.5299C0.970001 12.3862 1.66416 13.0804 2.52045 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 13.0804C13.3681 13.0804 14.0622 12.3862 14.0622 11.5299C14.0622 10.6737 13.3681 9.97949 12.5118 9.97949C11.6555 9.97949 10.9613 10.6737 10.9613 11.5299C10.9613 12.3862 11.6555 13.0804 12.5118 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 13.0804C23.3601 13.0804 24.0543 12.3862 24.0543 11.5299C24.0543 10.6737 23.3601 9.97949 22.5038 9.97949C21.6475 9.97949 20.9534 10.6737 20.9534 11.5299C20.9534 12.3862 21.6475 13.0804 22.5038 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 13.0804C33.3521 13.0804 34.0463 12.3862 34.0463 11.5299C34.0463 10.6737 33.3521 9.97949 32.4958 9.97949C31.6395 9.97949 30.9454 10.6737 30.9454 11.5299C30.9454 12.3862 31.6395 13.0804 32.4958 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 13.0804C43.3438 13.0804 44.038 12.3862 44.038 11.5299C44.038 10.6737 43.3438 9.97949 42.4875 9.97949C41.6312 9.97949 40.9371 10.6737 40.9371 11.5299C40.9371 12.3862 41.6312 13.0804 42.4875 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 13.0804C53.3358 13.0804 54.03 12.3862 54.03 11.5299C54.03 10.6737 53.3358 9.97949 52.4795 9.97949C51.6233 9.97949 50.9291 10.6737 50.9291 11.5299C50.9291 12.3862 51.6233 13.0804 52.4795 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 23.0604C3.37674 23.0604 4.0709 22.3662 4.0709 21.5099C4.0709 20.6536 3.37674 19.9595 2.52045 19.9595C1.66416 19.9595 0.970001 20.6536 0.970001 21.5099C0.970001 22.3662 1.66416 23.0604 2.52045 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 23.0604C13.3681 23.0604 14.0622 22.3662 14.0622 21.5099C14.0622 20.6536 13.3681 19.9595 12.5118 19.9595C11.6555 19.9595 10.9613 20.6536 10.9613 21.5099C10.9613 22.3662 11.6555 23.0604 12.5118 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 23.0604C23.3601 23.0604 24.0543 22.3662 24.0543 21.5099C24.0543 20.6536 23.3601 19.9595 22.5038 19.9595C21.6475 19.9595 20.9534 20.6536 20.9534 21.5099C20.9534 22.3662 21.6475 23.0604 22.5038 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 23.0604C33.3521 23.0604 34.0463 22.3662 34.0463 21.5099C34.0463 20.6536 33.3521 19.9595 32.4958 19.9595C31.6395 19.9595 30.9454 20.6536 30.9454 21.5099C30.9454 22.3662 31.6395 23.0604 32.4958 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 23.0604C43.3438 23.0604 44.038 22.3662 44.038 21.5099C44.038 20.6536 43.3438 19.9595 42.4875 19.9595C41.6312 19.9595 40.9371 20.6536 40.9371 21.5099C40.9371 22.3662 41.6312 23.0604 42.4875 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 23.0604C53.3358 23.0604 54.03 22.3662 54.03 21.5099C54.03 20.6536 53.3358 19.9595 52.4795 19.9595C51.6233 19.9595 50.9291 20.6536 50.9291 21.5099C50.9291 22.3662 51.6233 23.0604 52.4795 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 33.0404C3.37674 33.0404 4.0709 32.3462 4.0709 31.4899C4.0709 30.6336 3.37674 29.9395 2.52045 29.9395C1.66416 29.9395 0.970001 30.6336 0.970001 31.4899C0.970001 32.3462 1.66416 33.0404 2.52045 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 33.0404C13.3681 33.0404 14.0622 32.3462 14.0622 31.4899C14.0622 30.6336 13.3681 29.9395 12.5118 29.9395C11.6555 29.9395 10.9613 30.6336 10.9613 31.4899C10.9613 32.3462 11.6555 33.0404 12.5118 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 33.0404C23.3601 33.0404 24.0543 32.3462 24.0543 31.4899C24.0543 30.6336 23.3601 29.9395 22.5038 29.9395C21.6475 29.9395 20.9534 30.6336 20.9534 31.4899C20.9534 32.3462 21.6475 33.0404 22.5038 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 33.0404C33.3521 33.0404 34.0463 32.3462 34.0463 31.4899C34.0463 30.6336 33.3521 29.9395 32.4958 29.9395C31.6395 29.9395 30.9454 30.6336 30.9454 31.4899C30.9454 32.3462 31.6395 33.0404 32.4958 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 33.0404C43.3438 33.0404 44.038 32.3462 44.038 31.4899C44.038 30.6336 43.3438 29.9395 42.4875 29.9395C41.6312 29.9395 40.9371 30.6336 40.9371 31.4899C40.9371 32.3462 41.6312 33.0404 42.4875 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 33.0404C53.3358 33.0404 54.03 32.3462 54.03 31.4899C54.03 30.6336 53.3358 29.9395 52.4795 29.9395C51.6233 29.9395 50.9291 30.6336 50.9291 31.4899C50.9291 32.3462 51.6233 33.0404 52.4795 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 43.0203C3.37674 43.0203 4.0709 42.3262 4.0709 41.4699C4.0709 40.6136 3.37674 39.9194 2.52045 39.9194C1.66416 39.9194 0.970001 40.6136 0.970001 41.4699C0.970001 42.3262 1.66416 43.0203 2.52045 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 43.0203C13.3681 43.0203 14.0622 42.3262 14.0622 41.4699C14.0622 40.6136 13.3681 39.9194 12.5118 39.9194C11.6555 39.9194 10.9613 40.6136 10.9613 41.4699C10.9613 42.3262 11.6555 43.0203 12.5118 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 43.0203C23.3601 43.0203 24.0543 42.3262 24.0543 41.4699C24.0543 40.6136 23.3601 39.9194 22.5038 39.9194C21.6475 39.9194 20.9534 40.6136 20.9534 41.4699C20.9534 42.3262 21.6475 43.0203 22.5038 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 43.0203C33.3521 43.0203 34.0463 42.3262 34.0463 41.4699C34.0463 40.6136 33.3521 39.9194 32.4958 39.9194C31.6395 39.9194 30.9454 40.6136 30.9454 41.4699C30.9454 42.3262 31.6395 43.0203 32.4958 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 43.0203C43.3438 43.0203 44.038 42.3262 44.038 41.4699C44.038 40.6136 43.3438 39.9194 42.4875 39.9194C41.6312 39.9194 40.9371 40.6136 40.9371 41.4699C40.9371 42.3262 41.6312 43.0203 42.4875 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 43.0203C53.3358 43.0203 54.03 42.3262 54.03 41.4699C54.03 40.6136 53.3358 39.9194 52.4795 39.9194C51.6233 39.9194 50.9291 40.6136 50.9291 41.4699C50.9291 42.3262 51.6233 43.0203 52.4795 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 53.0001C3.37674 53.0001 4.0709 52.3059 4.0709 51.4496C4.0709 50.5933 3.37674 49.8992 2.52045 49.8992C1.66416 49.8992 0.970001 50.5933 0.970001 51.4496C0.970001 52.3059 1.66416 53.0001 2.52045 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 53.0001C13.3681 53.0001 14.0622 52.3059 14.0622 51.4496C14.0622 50.5933 13.3681 49.8992 12.5118 49.8992C11.6555 49.8992 10.9613 50.5933 10.9613 51.4496C10.9613 52.3059 11.6555 53.0001 12.5118 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 53.0001C23.3601 53.0001 24.0543 52.3059 24.0543 51.4496C24.0543 50.5933 23.3601 49.8992 22.5038 49.8992C21.6475 49.8992 20.9534 50.5933 20.9534 51.4496C20.9534 52.3059 21.6475 53.0001 22.5038 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 53.0001C33.3521 53.0001 34.0463 52.3059 34.0463 51.4496C34.0463 50.5933 33.3521 49.8992 32.4958 49.8992C31.6395 49.8992 30.9454 50.5933 30.9454 51.4496C30.9454 52.3059 31.6395 53.0001 32.4958 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 53.0001C43.3438 53.0001 44.038 52.3059 44.038 51.4496C44.038 50.5933 43.3438 49.8992 42.4875 49.8992C41.6312 49.8992 40.9371 50.5933 40.9371 51.4496C40.9371 52.3059 41.6312 53.0001 42.4875 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 53.0001C53.3358 53.0001 54.03 52.3059 54.03 51.4496C54.03 50.5933 53.3358 49.8992 52.4795 49.8992C51.6233 49.8992 50.9291 50.5933 50.9291 51.4496C50.9291 52.3059 51.6233 53.0001 52.4795 53.0001Z"
                                            fill="#3758F9" />
                                    </svg>
                                </span>
                            </div>
                            <div class="text-center">
                                <h4 class="mb-1 text-lg font-semibold text-dark dark:text-light">
                                    Nonye Ajeroh
                                </h4>
                                <p class="mb-5 text-sm text-body-dark dark:text-secondary">
                                    Marketing Expert &amp; Chief Investor
                                </p>
                                <div class="flex items-center justify-center gap-5">
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M13.3315 7.25625H11.7565H11.194V6.69375V4.95V4.3875H11.7565H12.9377C13.2471 4.3875 13.5002 4.1625 13.5002 3.825V0.84375C13.5002 0.534375 13.2752 0.28125 12.9377 0.28125H10.8846C8.66272 0.28125 7.11584 1.85625 7.11584 4.19062V6.6375V7.2H6.55334H4.64084C4.24709 7.2 3.88147 7.50937 3.88147 7.95937V9.98438C3.88147 10.3781 4.19084 10.7438 4.64084 10.7438H6.49709H7.05959V11.3063V16.9594C7.05959 17.3531 7.36897 17.7188 7.81897 17.7188H10.4627C10.6315 17.7188 10.7721 17.6344 10.8846 17.5219C10.9971 17.4094 11.0815 17.2125 11.0815 17.0437V11.3344V10.7719H11.6721H12.9377C13.3033 10.7719 13.5846 10.5469 13.6408 10.2094V10.1813V10.1531L14.0346 8.2125C14.0627 8.01562 14.0346 7.79063 13.8658 7.56562C13.8096 7.425 13.5565 7.28437 13.3315 7.25625Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M16.4647 4.83752C16.565 4.72065 16.4343 4.56793 16.2859 4.62263C15.9549 4.74474 15.6523 4.82528 15.2049 4.875C15.7552 4.56855 16.0112 4.13054 16.2194 3.59407C16.2696 3.46467 16.1182 3.34725 15.9877 3.40907C15.458 3.66023 14.8864 3.84658 14.2854 3.95668C13.6913 3.3679 12.8445 3 11.9077 3C10.1089 3 8.65027 4.35658 8.65027 6.02938C8.65027 6.26686 8.67937 6.49818 8.73427 6.71966C6.14854 6.59919 3.84286 5.49307 2.24098 3.79696C2.13119 3.68071 1.93197 3.69614 1.86361 3.83792C1.68124 4.21619 1.57957 4.63582 1.57957 5.07762C1.57957 6.12843 2.15446 7.05557 3.02837 7.59885C2.63653 7.58707 2.2618 7.51073 1.91647 7.38116C1.74834 7.31808 1.5556 7.42893 1.57819 7.59847C1.75162 8.9004 2.80568 9.97447 4.16624 10.2283C3.89302 10.2978 3.60524 10.3347 3.30754 10.3347C3.23536 10.3347 3.16381 10.3324 3.0929 10.3281C2.91247 10.3169 2.76583 10.4783 2.84319 10.6328C3.35357 11.6514 4.45563 12.3625 5.73809 12.3847C4.62337 13.1974 3.21889 13.6816 1.69269 13.6816C1.50451 13.6816 1.42378 13.9235 1.59073 14.0056C2.88015 14.6394 4.34854 15 5.90878 15C11.9005 15 15.1765 10.384 15.1765 6.38067C15.1765 6.24963 15.1732 6.11858 15.1672 5.98877C15.6535 5.66205 16.0907 5.27354 16.4647 4.83752Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M9.02429 11.8066C10.5742 11.8066 11.8307 10.5501 11.8307 9.00018C11.8307 7.45022 10.5742 6.19373 9.02429 6.19373C7.47433 6.19373 6.21783 7.45022 6.21783 9.00018C6.21783 10.5501 7.47433 11.8066 9.02429 11.8066Z"
                                                fill="" />
                                            <path
                                                d="M12.0726 1.5H5.92742C3.48387 1.5 1.5 3.48387 1.5 5.92742V12.0242C1.5 14.5161 3.48387 16.5 5.92742 16.5H12.0242C14.5161 16.5 16.5 14.5161 16.5 12.0726V5.92742C16.5 3.48387 14.5161 1.5 12.0726 1.5ZM9.02419 12.6774C6.96774 12.6774 5.34677 11.0081 5.34677 9C5.34677 6.99194 6.99194 5.32258 9.02419 5.32258C11.0323 5.32258 12.6774 6.99194 12.6774 9C12.6774 11.0081 11.0565 12.6774 9.02419 12.6774ZM14.1048 5.66129C13.8629 5.92742 13.5 6.07258 13.0887 6.07258C12.7258 6.07258 12.3629 5.92742 12.0726 5.66129C11.8065 5.39516 11.6613 5.05645 11.6613 4.64516C11.6613 4.23387 11.8065 3.91935 12.0726 3.62903C12.3387 3.33871 12.6774 3.19355 13.0887 3.19355C13.4516 3.19355 13.8387 3.33871 14.1048 3.60484C14.3468 3.91935 14.5161 4.28226 14.5161 4.66935C14.4919 5.05645 14.3468 5.39516 14.1048 5.66129Z"
                                                fill="" />
                                            <path
                                                d="M13.1135 4.06433C12.799 4.06433 12.5329 4.33046 12.5329 4.64498C12.5329 4.95949 12.799 5.22562 13.1135 5.22562C13.428 5.22562 13.6942 4.95949 13.6942 4.64498C13.6942 4.33046 13.4522 4.06433 13.1135 4.06433Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full p-4 md:w-1/2 lg:w-1/4">
                        <div class="group mb-8 rounded-xl bg-secondary lg:p-6 px-5 py-10 dark:bg-body-dark">
                            <div class="relative z-10 mx-auto mb-5 h-28 w-28">
                                <img loading="lazy" src="{{ asset('src/images/website/team/team-04.png') }}"
                                    alt="team image" class="h-28 w-28 rounded-full" />
                                <span
                                    class="absolute bottom-0 left-0 -z-10 h-10 w-10 rounded-full bg-primary opacity-0 transition-all group-hover:opacity-100"></span>
                                <span
                                    class="absolute right-0 top-0 -z-10 opacity-0 transition-all group-hover:opacity-100">
                                    <svg width="55" height="53" viewBox="0 0 55 53" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 3.1009C13.3681 3.1009 14.0622 2.40674 14.0622 1.55045C14.0622 0.69416 13.3681 0 12.5118 0C11.6555 0 10.9613 0.69416 10.9613 1.55045C10.9613 2.40674 11.6555 3.1009 12.5118 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 3.1009C23.3601 3.1009 24.0543 2.40674 24.0543 1.55045C24.0543 0.69416 23.3601 0 22.5038 0C21.6475 0 20.9534 0.69416 20.9534 1.55045C20.9534 2.40674 21.6475 3.1009 22.5038 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 3.1009C33.3521 3.1009 34.0463 2.40674 34.0463 1.55045C34.0463 0.69416 33.3521 0 32.4958 0C31.6395 0 30.9454 0.69416 30.9454 1.55045C30.9454 2.40674 31.6395 3.1009 32.4958 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 3.1009C43.3438 3.1009 44.038 2.40674 44.038 1.55045C44.038 0.69416 43.3438 0 42.4875 0C41.6312 0 40.9371 0.69416 40.9371 1.55045C40.9371 2.40674 41.6312 3.1009 42.4875 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 3.1009C53.3358 3.1009 54.03 2.40674 54.03 1.55045C54.03 0.69416 53.3358 0 52.4795 0C51.6233 0 50.9291 0.69416 50.9291 1.55045C50.9291 2.40674 51.6233 3.1009 52.4795 3.1009Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 13.0804C3.37674 13.0804 4.0709 12.3862 4.0709 11.5299C4.0709 10.6737 3.37674 9.97949 2.52045 9.97949C1.66416 9.97949 0.970001 10.6737 0.970001 11.5299C0.970001 12.3862 1.66416 13.0804 2.52045 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 13.0804C13.3681 13.0804 14.0622 12.3862 14.0622 11.5299C14.0622 10.6737 13.3681 9.97949 12.5118 9.97949C11.6555 9.97949 10.9613 10.6737 10.9613 11.5299C10.9613 12.3862 11.6555 13.0804 12.5118 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 13.0804C23.3601 13.0804 24.0543 12.3862 24.0543 11.5299C24.0543 10.6737 23.3601 9.97949 22.5038 9.97949C21.6475 9.97949 20.9534 10.6737 20.9534 11.5299C20.9534 12.3862 21.6475 13.0804 22.5038 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 13.0804C33.3521 13.0804 34.0463 12.3862 34.0463 11.5299C34.0463 10.6737 33.3521 9.97949 32.4958 9.97949C31.6395 9.97949 30.9454 10.6737 30.9454 11.5299C30.9454 12.3862 31.6395 13.0804 32.4958 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 13.0804C43.3438 13.0804 44.038 12.3862 44.038 11.5299C44.038 10.6737 43.3438 9.97949 42.4875 9.97949C41.6312 9.97949 40.9371 10.6737 40.9371 11.5299C40.9371 12.3862 41.6312 13.0804 42.4875 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 13.0804C53.3358 13.0804 54.03 12.3862 54.03 11.5299C54.03 10.6737 53.3358 9.97949 52.4795 9.97949C51.6233 9.97949 50.9291 10.6737 50.9291 11.5299C50.9291 12.3862 51.6233 13.0804 52.4795 13.0804Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 23.0604C3.37674 23.0604 4.0709 22.3662 4.0709 21.5099C4.0709 20.6536 3.37674 19.9595 2.52045 19.9595C1.66416 19.9595 0.970001 20.6536 0.970001 21.5099C0.970001 22.3662 1.66416 23.0604 2.52045 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 23.0604C13.3681 23.0604 14.0622 22.3662 14.0622 21.5099C14.0622 20.6536 13.3681 19.9595 12.5118 19.9595C11.6555 19.9595 10.9613 20.6536 10.9613 21.5099C10.9613 22.3662 11.6555 23.0604 12.5118 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 23.0604C23.3601 23.0604 24.0543 22.3662 24.0543 21.5099C24.0543 20.6536 23.3601 19.9595 22.5038 19.9595C21.6475 19.9595 20.9534 20.6536 20.9534 21.5099C20.9534 22.3662 21.6475 23.0604 22.5038 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 23.0604C33.3521 23.0604 34.0463 22.3662 34.0463 21.5099C34.0463 20.6536 33.3521 19.9595 32.4958 19.9595C31.6395 19.9595 30.9454 20.6536 30.9454 21.5099C30.9454 22.3662 31.6395 23.0604 32.4958 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 23.0604C43.3438 23.0604 44.038 22.3662 44.038 21.5099C44.038 20.6536 43.3438 19.9595 42.4875 19.9595C41.6312 19.9595 40.9371 20.6536 40.9371 21.5099C40.9371 22.3662 41.6312 23.0604 42.4875 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 23.0604C53.3358 23.0604 54.03 22.3662 54.03 21.5099C54.03 20.6536 53.3358 19.9595 52.4795 19.9595C51.6233 19.9595 50.9291 20.6536 50.9291 21.5099C50.9291 22.3662 51.6233 23.0604 52.4795 23.0604Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 33.0404C3.37674 33.0404 4.0709 32.3462 4.0709 31.4899C4.0709 30.6336 3.37674 29.9395 2.52045 29.9395C1.66416 29.9395 0.970001 30.6336 0.970001 31.4899C0.970001 32.3462 1.66416 33.0404 2.52045 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 33.0404C13.3681 33.0404 14.0622 32.3462 14.0622 31.4899C14.0622 30.6336 13.3681 29.9395 12.5118 29.9395C11.6555 29.9395 10.9613 30.6336 10.9613 31.4899C10.9613 32.3462 11.6555 33.0404 12.5118 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 33.0404C23.3601 33.0404 24.0543 32.3462 24.0543 31.4899C24.0543 30.6336 23.3601 29.9395 22.5038 29.9395C21.6475 29.9395 20.9534 30.6336 20.9534 31.4899C20.9534 32.3462 21.6475 33.0404 22.5038 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 33.0404C33.3521 33.0404 34.0463 32.3462 34.0463 31.4899C34.0463 30.6336 33.3521 29.9395 32.4958 29.9395C31.6395 29.9395 30.9454 30.6336 30.9454 31.4899C30.9454 32.3462 31.6395 33.0404 32.4958 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 33.0404C43.3438 33.0404 44.038 32.3462 44.038 31.4899C44.038 30.6336 43.3438 29.9395 42.4875 29.9395C41.6312 29.9395 40.9371 30.6336 40.9371 31.4899C40.9371 32.3462 41.6312 33.0404 42.4875 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 33.0404C53.3358 33.0404 54.03 32.3462 54.03 31.4899C54.03 30.6336 53.3358 29.9395 52.4795 29.9395C51.6233 29.9395 50.9291 30.6336 50.9291 31.4899C50.9291 32.3462 51.6233 33.0404 52.4795 33.0404Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 43.0203C3.37674 43.0203 4.0709 42.3262 4.0709 41.4699C4.0709 40.6136 3.37674 39.9194 2.52045 39.9194C1.66416 39.9194 0.970001 40.6136 0.970001 41.4699C0.970001 42.3262 1.66416 43.0203 2.52045 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 43.0203C13.3681 43.0203 14.0622 42.3262 14.0622 41.4699C14.0622 40.6136 13.3681 39.9194 12.5118 39.9194C11.6555 39.9194 10.9613 40.6136 10.9613 41.4699C10.9613 42.3262 11.6555 43.0203 12.5118 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 43.0203C23.3601 43.0203 24.0543 42.3262 24.0543 41.4699C24.0543 40.6136 23.3601 39.9194 22.5038 39.9194C21.6475 39.9194 20.9534 40.6136 20.9534 41.4699C20.9534 42.3262 21.6475 43.0203 22.5038 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 43.0203C33.3521 43.0203 34.0463 42.3262 34.0463 41.4699C34.0463 40.6136 33.3521 39.9194 32.4958 39.9194C31.6395 39.9194 30.9454 40.6136 30.9454 41.4699C30.9454 42.3262 31.6395 43.0203 32.4958 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 43.0203C43.3438 43.0203 44.038 42.3262 44.038 41.4699C44.038 40.6136 43.3438 39.9194 42.4875 39.9194C41.6312 39.9194 40.9371 40.6136 40.9371 41.4699C40.9371 42.3262 41.6312 43.0203 42.4875 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 43.0203C53.3358 43.0203 54.03 42.3262 54.03 41.4699C54.03 40.6136 53.3358 39.9194 52.4795 39.9194C51.6233 39.9194 50.9291 40.6136 50.9291 41.4699C50.9291 42.3262 51.6233 43.0203 52.4795 43.0203Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.52045 53.0001C3.37674 53.0001 4.0709 52.3059 4.0709 51.4496C4.0709 50.5933 3.37674 49.8992 2.52045 49.8992C1.66416 49.8992 0.970001 50.5933 0.970001 51.4496C0.970001 52.3059 1.66416 53.0001 2.52045 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.5118 53.0001C13.3681 53.0001 14.0622 52.3059 14.0622 51.4496C14.0622 50.5933 13.3681 49.8992 12.5118 49.8992C11.6555 49.8992 10.9613 50.5933 10.9613 51.4496C10.9613 52.3059 11.6555 53.0001 12.5118 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.5038 53.0001C23.3601 53.0001 24.0543 52.3059 24.0543 51.4496C24.0543 50.5933 23.3601 49.8992 22.5038 49.8992C21.6475 49.8992 20.9534 50.5933 20.9534 51.4496C20.9534 52.3059 21.6475 53.0001 22.5038 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.4958 53.0001C33.3521 53.0001 34.0463 52.3059 34.0463 51.4496C34.0463 50.5933 33.3521 49.8992 32.4958 49.8992C31.6395 49.8992 30.9454 50.5933 30.9454 51.4496C30.9454 52.3059 31.6395 53.0001 32.4958 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M42.4875 53.0001C43.3438 53.0001 44.038 52.3059 44.038 51.4496C44.038 50.5933 43.3438 49.8992 42.4875 49.8992C41.6312 49.8992 40.9371 50.5933 40.9371 51.4496C40.9371 52.3059 41.6312 53.0001 42.4875 53.0001Z"
                                            fill="#3758F9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M52.4795 53.0001C53.3358 53.0001 54.03 52.3059 54.03 51.4496C54.03 50.5933 53.3358 49.8992 52.4795 49.8992C51.6233 49.8992 50.9291 50.5933 50.9291 51.4496C50.9291 52.3059 51.6233 53.0001 52.4795 53.0001Z"
                                            fill="#3758F9" />
                                    </svg>
                                </span>
                            </div>
                            <div class="text-center">
                                <h4 class="mb-1 text-lg font-semibold text-dark dark:text-light">
                                    Ifeanyi Akudinobi
                                </h4>
                                <p class="mb-5 text-sm text-body-dark dark:text-secondary">
                                    Graphic Designer &amp; CTO
                                </p>
                                <div class="flex items-center justify-center gap-5">
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M13.3315 7.25625H11.7565H11.194V6.69375V4.95V4.3875H11.7565H12.9377C13.2471 4.3875 13.5002 4.1625 13.5002 3.825V0.84375C13.5002 0.534375 13.2752 0.28125 12.9377 0.28125H10.8846C8.66272 0.28125 7.11584 1.85625 7.11584 4.19062V6.6375V7.2H6.55334H4.64084C4.24709 7.2 3.88147 7.50937 3.88147 7.95937V9.98438C3.88147 10.3781 4.19084 10.7438 4.64084 10.7438H6.49709H7.05959V11.3063V16.9594C7.05959 17.3531 7.36897 17.7188 7.81897 17.7188H10.4627C10.6315 17.7188 10.7721 17.6344 10.8846 17.5219C10.9971 17.4094 11.0815 17.2125 11.0815 17.0437V11.3344V10.7719H11.6721H12.9377C13.3033 10.7719 13.5846 10.5469 13.6408 10.2094V10.1813V10.1531L14.0346 8.2125C14.0627 8.01562 14.0346 7.79063 13.8658 7.56562C13.8096 7.425 13.5565 7.28437 13.3315 7.25625Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M16.4647 4.83752C16.565 4.72065 16.4343 4.56793 16.2859 4.62263C15.9549 4.74474 15.6523 4.82528 15.2049 4.875C15.7552 4.56855 16.0112 4.13054 16.2194 3.59407C16.2696 3.46467 16.1182 3.34725 15.9877 3.40907C15.458 3.66023 14.8864 3.84658 14.2854 3.95668C13.6913 3.3679 12.8445 3 11.9077 3C10.1089 3 8.65027 4.35658 8.65027 6.02938C8.65027 6.26686 8.67937 6.49818 8.73427 6.71966C6.14854 6.59919 3.84286 5.49307 2.24098 3.79696C2.13119 3.68071 1.93197 3.69614 1.86361 3.83792C1.68124 4.21619 1.57957 4.63582 1.57957 5.07762C1.57957 6.12843 2.15446 7.05557 3.02837 7.59885C2.63653 7.58707 2.2618 7.51073 1.91647 7.38116C1.74834 7.31808 1.5556 7.42893 1.57819 7.59847C1.75162 8.9004 2.80568 9.97447 4.16624 10.2283C3.89302 10.2978 3.60524 10.3347 3.30754 10.3347C3.23536 10.3347 3.16381 10.3324 3.0929 10.3281C2.91247 10.3169 2.76583 10.4783 2.84319 10.6328C3.35357 11.6514 4.45563 12.3625 5.73809 12.3847C4.62337 13.1974 3.21889 13.6816 1.69269 13.6816C1.50451 13.6816 1.42378 13.9235 1.59073 14.0056C2.88015 14.6394 4.34854 15 5.90878 15C11.9005 15 15.1765 10.384 15.1765 6.38067C15.1765 6.24963 15.1732 6.11858 15.1672 5.98877C15.6535 5.66205 16.0907 5.27354 16.4647 4.83752Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="text-body-dark dark:text-secondary hover:text-primary dark:hover:text-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                            <path
                                                d="M9.02429 11.8066C10.5742 11.8066 11.8307 10.5501 11.8307 9.00018C11.8307 7.45022 10.5742 6.19373 9.02429 6.19373C7.47433 6.19373 6.21783 7.45022 6.21783 9.00018C6.21783 10.5501 7.47433 11.8066 9.02429 11.8066Z"
                                                fill="" />
                                            <path
                                                d="M12.0726 1.5H5.92742C3.48387 1.5 1.5 3.48387 1.5 5.92742V12.0242C1.5 14.5161 3.48387 16.5 5.92742 16.5H12.0242C14.5161 16.5 16.5 14.5161 16.5 12.0726V5.92742C16.5 3.48387 14.5161 1.5 12.0726 1.5ZM9.02419 12.6774C6.96774 12.6774 5.34677 11.0081 5.34677 9C5.34677 6.99194 6.99194 5.32258 9.02419 5.32258C11.0323 5.32258 12.6774 6.99194 12.6774 9C12.6774 11.0081 11.0565 12.6774 9.02419 12.6774ZM14.1048 5.66129C13.8629 5.92742 13.5 6.07258 13.0887 6.07258C12.7258 6.07258 12.3629 5.92742 12.0726 5.66129C11.8065 5.39516 11.6613 5.05645 11.6613 4.64516C11.6613 4.23387 11.8065 3.91935 12.0726 3.62903C12.3387 3.33871 12.6774 3.19355 13.0887 3.19355C13.4516 3.19355 13.8387 3.33871 14.1048 3.60484C14.3468 3.91935 14.5161 4.28226 14.5161 4.66935C14.4919 5.05645 14.3468 5.39516 14.1048 5.66129Z"
                                                fill="" />
                                            <path
                                                d="M13.1135 4.06433C12.799 4.06433 12.5329 4.33046 12.5329 4.64498C12.5329 4.95949 12.799 5.22562 13.1135 5.22562C13.428 5.22562 13.6942 4.95949 13.6942 4.64498C13.6942 4.33046 13.4522 4.06433 13.1135 4.06433Z"
                                                fill="" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Team Section --}}
        {{-- Contact Section --}}
        <section id="contact" class="relative z-10 bg-light dark:bg-dark">
            <div class="absolute left-0 top-0 -z-[1] h-full w-full dark:bg-dark"></div>
            <div class="absolute left-0 top-0 -z-[1] h-1/2 w-full bg-primary/60 dark:bg-primary"></div>
            <div class="overflow-hidden pt-20 pb-10 px-10 md:pt-40 md:pb-20">
                <div class="flex flex-wrap items-center">
                    <div class="w-full lg:w-7/12 xl:w-8/12">
                        <div class="mb-14 lg:mb-20">
                            <span class="mb-6 block text-lg font-bold md:text-xl text-dark dark:text-light">
                                CONTACT US
                            </span>
                            <h2
                                class="mx-auto max-w-[45ch] text-4xl font-extrabold leading-[1.14] text-dark dark:text-light">
                                Let's talk about your problem.
                            </h2>
                        </div>
                        <div class="flex flex-wrap gap-5 items-start">
                            <div class="mb-8 flex items-start">
                                <div class="mr-6 text-dark lg:text-primary">
                                    <svg width="29" height="35" viewBox="0 0 29 35" class="fill-current">
                                        <path
                                            d="M14.5 0.710938C6.89844 0.710938 0.664062 6.72656 0.664062 14.0547C0.664062 19.9062 9.03125 29.5859 12.6406 33.5234C13.1328 34.0703 13.7891 34.3437 14.5 34.3437C15.2109 34.3437 15.8672 34.0703 16.3594 33.5234C19.9688 29.6406 28.3359 19.9062 28.3359 14.0547C28.3359 6.67188 22.1016 0.710938 14.5 0.710938ZM14.9375 32.2109C14.6641 32.4844 14.2812 32.4844 14.0625 32.2109C11.3828 29.3125 2.57812 19.3594 2.57812 14.0547C2.57812 7.71094 7.9375 2.625 14.5 2.625C21.0625 2.625 26.4219 7.76562 26.4219 14.0547C26.4219 19.3594 17.6172 29.2578 14.9375 32.2109Z" />
                                        <path
                                            d="M14.5 8.58594C11.2734 8.58594 8.59375 11.2109 8.59375 14.4922C8.59375 17.7188 11.2187 20.3984 14.5 20.3984C17.7812 20.3984 20.4062 17.7734 20.4062 14.4922C20.4062 11.2109 17.7266 8.58594 14.5 8.58594ZM14.5 18.4297C12.3125 18.4297 10.5078 16.625 10.5078 14.4375C10.5078 12.25 12.3125 10.4453 14.5 10.4453C16.6875 10.4453 18.4922 12.25 18.4922 14.4375C18.4922 16.625 16.6875 18.4297 14.5 18.4297Z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="mb-4 text-xl font-bold text-dark dark:text-light">
                                        Our Location
                                    </h5>
                                    <p class="text-lg text-body-dark dark:text-secondary">
                                        No. 1 Ekwema Crescent, Ikenegbu, Owerri
                                    </p>
                                </div>
                            </div>
                            <div class="mb-8 flex items-start">
                                <div class="mr-6 text-dark lg:text-primary">
                                    <svg width="34" height="25" viewBox="0 0 34 25" class="fill-current">
                                        <path
                                            d="M30.5156 0.960938H3.17188C1.42188 0.960938 0 2.38281 0 4.13281V20.9219C0 22.6719 1.42188 24.0938 3.17188 24.0938H30.5156C32.2656 24.0938 33.6875 22.6719 33.6875 20.9219V4.13281C33.6875 2.38281 32.2656 0.960938 30.5156 0.960938ZM30.5156 2.875C30.7891 2.875 31.0078 2.92969 31.2266 3.09375L17.6094 11.3516C17.1172 11.625 16.5703 11.625 16.0781 11.3516L2.46094 3.09375C2.67969 2.98438 2.89844 2.875 3.17188 2.875H30.5156ZM30.5156 22.125H3.17188C2.51562 22.125 1.91406 21.5781 1.91406 20.8672V5.00781L15.0391 12.9922C15.5859 13.3203 16.1875 13.4844 16.7891 13.4844C17.3906 13.4844 17.9922 13.3203 18.5391 12.9922L31.6641 5.00781V20.8672C31.7734 21.5781 31.1719 22.125 30.5156 22.125Z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="mb-4 text-xl font-bold text-dark dark:text-light">
                                        How Can We Help?
                                    </h5>
                                    <p class="text-lg text-body-dark dark:text-secondary">
                                        info@skoolmaven.com
                                    </p>
                                    <p class="mt-1 text-lg text-body-dark dark:text-secondary">
                                        technovationincubation@gmail.com
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-4/5 mx-auto lg:w-5/12 xl:w-4/12">
                        <div class="font-aladin rounded-lg bg-secondary px-8 py-10 dark:bg-body-dark lg:px-10 lg:py-12">
                            <h3 class="mb-8 text-2xl font-bold text-dark dark:text-light ">
                                Send us a Message
                            </h3>
                            <form>
                                <div class="mb-5">
                                    <label for="fullName"
                                        class="mb-4 block text-sm text-body-dark dark:text-secondary">Full
                                        Name <span class="text-danger text-xl dark:text-red-500">*</span> </label>
                                    <input type="text" name="fullName" placeholder="Adam Gelius"
                                        class="w-full  border-b border-body-dark/50 bg-transparent pb-3 text-body-dark placeholder:text-body-dark/60 dark:placeholder:text-secondary/40 focus:border-primary focus:outline-none dark:border-secondary/50 dark:text-secondary" />
                                </div>
                                <div class="mb-5">
                                    <label for="email"
                                        class="mb-4 block text-sm text-body-dark dark:text-secondary">Email <span
                                            class="text-danger text-xl dark:text-red-500">*</span> </label>
                                    <input type="email" name="email" placeholder="example@yourmail.com"
                                        class="w-full  border-b border-body-dark/50 bg-transparent pb-3 text-body-dark placeholder:text-body-dark/60 dark:placeholder:text-secondary/40 focus:border-primary focus:outline-none dark:border-secondary/50 dark:text-secondary" />
                                </div>
                                <div class="mb-5">
                                    <label for="phone"
                                        class="mb-4 block text-sm text-body-dark dark:text-secondary">Phone <span
                                            class="text-danger text-xl dark:text-red-500">*</span> </label>
                                    <input type="text" name="phone" placeholder="+885 1254 5211 552"
                                        class="w-full  border-b border-body-dark/50 bg-transparent pb-3 text-body-dark placeholder:text-body-dark/60 dark:placeholder:text-secondary/40 focus:border-primary focus:outline-none dark:border-secondary/50 dark:text-secondary" />
                                </div>
                                <div class="mb-6">
                                    <label for="message"
                                        class="mb-4 block text-sm text-body-dark dark:text-secondary">Message
                                        <span class="text-danger text-xl dark:text-red-500">*</span> </label>
                                    <textarea name="message" rows="1" placeholder="type your message here"
                                        class="w-full resize-none  border-b border-body-dark/50 bg-transparent pb-3 text-body-dark placeholder:text-body-dark/60 dark:placeholder:text-secondary/40 focus:border-primary focus:outline-none dark:border-secondary/50 dark:text-secondary"></textarea>
                                </div>
                                <div class="mb-0">
                                    <button type="submit"
                                        class="inline-flex items-center justify-center rounded-md bg-primary px-5 py-2 text-lg font-medium text-light transition duration-300 ease-in-out hover:bg-body-dark">
                                        Send
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
        {{-- Contact Section --}}
        {{-- Footer Section --}}
        <footer id="resources" class="bg-big-banner bg-cover bg-center">
            <div class="w-full pt-32">
                <div class="flex md:flex-row px-5 flex-col md:justify-between md:items-start md:px-10 lg:px-14">
                    <div class="mb-6 md:mb-0">
                        <a wire:navigate href="{{ route('index') }}" class="flex gap-2 items-center justify-center">
                            <img class="w-8 lg:w-12 block" src="{{ asset('favicon.svg') }}" alt="logo">
                            <p class="font-aladin text-light font-bold flex flex-col items-center">
                                <span class="text-3xl lg:text-4xl">{{ __(Str::lower(config('app.name'))) }}</span>
                                <small class="lg:text-base tracking-wider">by JavaTechnovation</small>
                            </p>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-8 md:grid-cols-3 md:gap-6">
                        <div>
                            <h2 class="mb-6 text-sm font-semibold dark:text-light uppercase text-secondary">Resources
                            </h2>
                            <ul class="text-secondary dark:text-light space-y-4">
                                <li>
                                    <a wire:navigate href="{{ route('index') }}"
                                        class="hover:text-primary duration-300">{{ __(config('app.name')) }}</a>
                                </li>
                                <li>
                                    <a href="https://laravel.com/" target="_blank"
                                        class="hover:text-primary duration-300">Laravel</a>
                                </li>
                                <li>
                                    <a href="https://tailwindcss.com/" target="_blank"
                                        class="hover:text-primary duration-300">Tailwind
                                        CSS</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-secondary uppercase dark:text-light">Follow us
                            </h2>
                            <ul class="text-secondary dark:text-light space-y-4">
                                <li>
                                    <a href="https://github.com/themahdscientist" target="_blank"
                                        class="hover:text-primary duration-300 ">Github</a>
                                </li>
                                <li>
                                    <a href="https://youtube.com/@themahdscientist" target="_blank"
                                        class="hover:text-primary duration-300 ">YouTube</a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/T_MahdScientist" target="_blank"
                                        class="hover:text-primary duration-300 ">Twitter</a>
                                </li>
                                <li>
                                    <a href="https://instagram.com/themahdscientist" target="_blank"
                                        class="hover:text-primary duration-300 ">Instagram</a>
                                </li>
                                <li>
                                    <a href="https://facebook.com/themahdscientist" target="_blank"
                                        class="hover:text-primary duration-300 ">Facebook</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-secondary uppercase dark:text-light">Legal</h2>
                            <ul class="text-secondary dark:text-light space-y-4">
                                <li>
                                    <a wire:navigate href="#" class="hover:text-primary duration-300">Privacy Policy</a>
                                </li>
                                <li>
                                    <a wire:navigate href="#" class="hover:text-primary duration-300">Terms &amp;
                                        Conditions</a>
                                </li>
                                <li>
                                    <a wire:navigate href="#" class="hover:text-primary duration-300">Cookie Consent</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-5 border-secondary/50 mx-auto md:my-10" />
                <div class="flex flex-col md:flex-row items-center justify-between pb-5 md:pb-10 px-5">
                    <div class="text-sm text-secondary flex-col dark:text-light flex space-y-2">
                        <span>{{ __(config('app.name')) }} is a Trademark of
                            {{ __('JavaTechnovation Holdings LLC.') }}</span>
                        <span>Copyright &copy; 2024 {{ __('JavaTechnovation Holdings LLC.') }}</a> All Rights
                            Reserved.</span>
                    </div>
                    <div class="flex space-x-6 justify-center mt-5 md:mt-0">
                        <a href="#" class="text-secondary hover:text-secondary/60 duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-secondary hover:text-secondary/60 duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-secondary hover:text-secondary/60 duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-secondary hover:text-secondary/60 duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-secondary hover:text-secondary/60 duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
        {{-- Footer Section --}}
        {{-- Back to Top Section --}}
        <a href="{{ route('index')}}#home"
            class="fixed hidden bottom-16 right-8 md:bottom-4 text-dark bg-primary dark:bg-secondary dark:shadow-card-2 dark:shadow-primary shadow-card-2 shadow-body-dark rounded z-50 dark:text-primary -rotate-90">
            <svg class="h-8 w-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M10.3 5.6A2 2 0 0 0 7 7v10a2 2 0 0 0 3.3 1.5l5.9-4.9a2 2 0 0 0 0-3l-6-5Z"
                    clip-rule="evenodd" />
            </svg>
        </a>
        {{-- Back to Top Section --}}
    </main>
</div>