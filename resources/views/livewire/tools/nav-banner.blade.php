<section x-data="{ open: false }">
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
        class="sticky top-0 z-50 flex items-center justify-between bg-light bg-opacity-75 py-4 px-8 xl:px-20 xl:py-2 backdrop-blur-lg dark:bg-dark dark:bg-opacity-75">
        <a wire:navigate href="{{ route('index') }}" class="flex gap-2 items-center justify-center">
            <img class="w-8 lg:w-12 block" src="{{ asset('favicon.svg') }}" alt="logo">
            <span
                class="my-au font-aladin text-dark dark:text-light text-3xl lg:text-4xl font-bold">{{ __(Str::lower(config('app.name'))) }}</span>
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
                @if (Request::routeIs('app.register'))
                <div :class="{ 'my-5 w-full px-16': open }" class="group lg:hidden">
                    <a wire:navigate @click.stop="open = false" href="{{ route('app.login') }}"
                        class="rounded-md px-4 py-2 font-medium text-dark duration-300 group-hover:bg-dark group-hover:text-light dark:text-light dark:group-hover:bg-light dark:group-hover:text-dark">
                        Sign In
                    </a>
                </div>
                @else
                <div :class="{ 'my-5 w-full px-16': open }" class="group lg:hidden">
                    <a wire:navigate @click.stop="open = false" href="{{ route('app.register') }}"
                        class="rounded-md bg-primary px-4 py-2 font-medium text-secondary shadow-card shadow-black duration-300 group-hover:shadow-body-dark dark:shadow-secondary">
                        Sign Up
                    </a>
                </div>
                @endif
            </ul>
            <ul>
                <li class="flex items-center justify-between gap-4 xl:gap-8">
                    <livewire:tools.darkmode-toggler />
                    <div class="hidden lg:flex items-center justify-between gap-4">
                        @if (Request::routeIs('app.register'))
                        <div class="group">
                            <a wire:navigate href="{{ route('app.login') }}"
                                class="rounded-md px-4 py-2 font-medium text-dark duration-300 group-hover:bg-dark group-hover:text-light dark:text-light dark:group-hover:bg-light dark:group-hover:text-dark">
                                Sign In
                            </a>
                        </div>
                        @else
                        <div class="group">
                            <a wire:navigate href="{{ route('app.register') }}"
                                class="rounded-md bg-primary px-4 py-2 font-medium text-secondary shadow-card shadow-black duration-300 group-hover:shadow-body-dark dark:shadow-secondary">
                                Sign Up
                            </a>
                        </div>
                        @endif
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
</section>