{{-- @dd($user->school) --}}
<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-20 flex h-screen w-72 flex-col overflow-y-hidden bg-dark duration-300 ease-linear -translate-x-full dark:bg-neutral-900 lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">
    {{-- SIDEBAR HEADER --}}
    <div :class="sidebarToggle ? 'justify-between' : 'justify-center'"
        class="flex items-center justify-center px-6 py-3 lg:py-4">
        <a wire:navigate href="{{ route('app.' . session('role') . '.dashboard') }}" wire:navigate>
            <x-filament::avatar :src="Storage::url($user->school->logo)" :alt="$user->school->name" :circular="false"
                size="lg" />
        </a>

        <button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
            @svg('c-arrow-left-circle', 'w-6 h-6 text-secondary')
        </button>
    </div>
    {{-- SIDEBAR HEADER --}}

    <div class="scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        {{-- Sidebar Menu --}}
        <nav class="mt-4 p-4 lg:mt-8">
            @can('view-admin')
            {{-- Essentials  --}}
            <div>
                <h3 class="mb-2 ml-4 text-sm font-medium text-neutral-500">ESSENTIALS</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    {{-- Dashboard --}}
                    <li>
                        <a class="{{ request()->routeIs('app.' . session('role') . '.dashboard') ? 'bg-primary' : 'hover:bg-primary' }} relative flex items-center gap-2.5 rounded px-4 py-2 font-medium text-secondary duration-300 ease-in-out dark:hover:bg-body-dark"
                            href="{{ route('app.' . session('role') . '.dashboard') }}" wire:navigate>
                            @svg('c-home', 'w-6 h-6')
                            <span>Dashboard</span>
                        </a>
                    </li>
                    {{-- Dashboard --}}
                    {{-- Academics --}}
                    <li class="flex flex-row-reverse items-center">
                        <a class="{{ request()->routeIs('app.' . session('role') . '.academics') || request()->segment(2) == 'academics'  ? 'bg-primary' : 'hover:bg-primary' }} relative flex items-center gap-2.5 rounded px-4 py-2 font-medium text-secondary duration-300 ease-in-out dark:hover:bg-body-dark flex-1"
                            href="{{ route('app.' . session('role') . '.academics') }}" wire:navigate>
                            @svg('c-academic-cap', 'w-6 h-6')
                            <span>Academics</span>
                        </a>
                        <x-filament::dropdown placement="bottom-end">
                            <x-slot name="trigger">
                                <x-filament::icon-button icon="c-ellipsis-vertical" tooltip="More options" size="lg" />
                            </x-slot>
                            <x-filament::dropdown.list>
                                <x-filament::dropdown.list.item wire:click="grades" icon="c-rectangle-stack"
                                    icon-color="primary">
                                    Grades
                                </x-filament::dropdown.list.item>

                                <x-filament::dropdown.list.item wire:click="subjects" icon="c-rectangle-stack"
                                    icon-color="primary">
                                    Subjects
                                </x-filament::dropdown.list.item>

                                <x-filament::dropdown.list.item icon="c-rectangle-stack" icon-color="primary">
                                    Results
                                </x-filament::dropdown.list.item>
                            </x-filament::dropdown.list>
                        </x-filament::dropdown>
                    </li>
                    {{-- Academics --}}
                    {{-- Finances --}}
                    <li>
                        <a class="{{ request()->routeIs('app.' . session('role') . '.finances') ? 'bg-primary' : 'hover:bg-primary' }} relative flex items-center gap-2.5 rounded px-4 py-2 font-medium text-secondary duration-300 ease-in-out dark:hover:bg-body-dark"
                            href="{{ route('app.' . session('role') . '.finances') }}" wire:navigate>
                            @svg('c-currency-dollar', 'w-6 h-6')
                            <span>Finances</span>
                        </a>
                    </li>
                    {{-- Finances --}}
                </ul>
            </div>

            {{-- Personnel  --}}
            <div>
                <h3 class="mb-2 ml-4 text-sm font-medium text-neutral-500">PERSONNEL</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    {{-- Students --}}
                    <li>
                        <a class="{{ request()->routeIs('app.' . session('role') . '.students') ? 'bg-primary' : 'hover:bg-primary' }} relative flex items-center gap-2.5 rounded px-4 py-2 font-medium text-secondary duration-300 ease-in-out dark:hover:bg-body-dark"
                            href="{{ route('app.' . session('role') . '.students') }}" wire:navigate>
                            @svg('c-user-group', 'w-6 h-6')
                            <span>Students</span>
                        </a>
                    </li>
                    {{-- Students --}}
                    {{-- Guardians --}}
                    <li>
                        <a class="{{ request()->routeIs('app.' . session('role') . '.guardians') ? 'bg-primary' : 'hover:bg-primary' }} relative flex items-center gap-2.5 rounded px-4 py-2 font-medium text-secondary duration-300 ease-in-out dark:hover:bg-body-dark"
                            href="{{ route('app.' . session('role') . '.guardians') }}" wire:navigate>
                            @svg('c-user-group', 'w-6 h-6')
                            <span>Guardians</span>
                        </a>
                    </li>
                    {{-- Guardians --}}
                    {{-- Staff --}}
                    <li>
                        <a class="{{ request()->routeIs('app.' . session('role') . '.staff') ? 'bg-primary' : 'hover:bg-primary' }} relative flex items-center gap-2.5 rounded px-4 py-2 font-medium text-secondary duration-300 ease-in-out dark:hover:bg-body-dark"
                            href="{{ route('app.' . session('role') . '.staff') }}" wire:navigate>
                            @svg('c-users', 'w-6 h-6')
                            <span>Staff</span>
                        </a>
                    </li>
                    {{-- Staff --}}
                </ul>
            </div>
            @endcan

            {{-- Account --}}
            <div>
                <h3 class="mb-2 ml-4 text-sm font-medium text-neutral-500">ACCOUNT</h3>
                <ul class="flex flex-col gap-1.5">
                    {{-- Come back here and make changes to the student profile so you can uncomment this --}}
                    @can('view-admin')
                    {{-- Profile --}}
                    <li>
                        <a class="{{ request()->routeIs('app.' . session('role') . '.profile') ? 'bg-primary' : 'hover:bg-primary' }} relative flex items-center gap-2.5 rounded px-4 py-2 font-medium text-secondary duration-300 ease-in-out dark:hover:bg-body-dark"
                            href="{{ route('app.' . session('role') . '.profile') }}" wire:navigate>
                            @svg('c-user', 'w-6 h-6')
                            <span>Profile</span>
                        </a>
                    </li>
                    {{-- Profile --}}

                    {{-- Settings --}}
                    <li>
                        <a class="{{ request()->routeIs('app.' . session('role') . '.settings') ? 'bg-primary' : 'hover:bg-primary' }} relative flex items-center gap-2.5 rounded px-4 py-2 font-medium text-secondary duration-300 ease-in-out dark:hover:bg-body-dark"
                            href="{{ route('app.' . session('role') . '.settings') }}" wire:navigate>
                            @svg('c-cog', 'w-6 h-6')
                            <span>Settings</span>
                        </a>
                    </li>
                    {{-- Settings --}}
                    @endcan

                    {{-- Logout --}}
                    <li>
                        <livewire:auth.logout class="text-secondary dark:hover:bg-body-dark" />
                    </li>
                    {{-- Logout --}}
                </ul>
            </div>
        </nav>
        {{-- Sidebar Menu --}}

        @can('view-admin')
        {{-- Promo Box --}}
        <div class="mx-auto my-4 w-4/5 py-4 px-8 text-center ring-4 ring-primary rounded">
            <h1 class="text-base font-bold uppercase">
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-500 from-sky-600 dark:to-emerald-600 dark:from-green-400 font-black">{{ __(config('app.name')) }}&trade;</span>
                <span class="text-light">Ads</span>
            </h1>
            <p class="mb-4 px-2 text-sm font-medium text-secondary">Advertise your school for success&excl;</p>
            <button class="bg-primary py-2 w-full rounded-md font-extrabold text-sm text-light">START NOW</button>
        </div>
        {{-- Promo Box --}}
        @endcan
        <div>
            <span class="absolute left-0 top-0 -z-10">
                <svg width="106" height="144" viewBox="0 0 106 144" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.1" x="-67" y="47.127" width="113.378" height="131.304"
                        transform="rotate(-42.8643 -67 47.127)" fill="url(#paint0_linear_1416_214)" />
                    <defs>
                        <linearGradient id="paint0_linear_1416_214" x1="-10.3111" y1="47.127" x2="-10.3111" y2="178.431"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F6F7F8" />
                            <stop offset="1" stop-color="#4AAD52" stop-opacity="1" />
                        </linearGradient>
                    </defs>
                </svg>
            </span>
            <span class="absolute right-0 top-0 -z-10">
                <svg width="130" height="97" viewBox="0 0 130 97" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.1" x="0.86792" y="-6.67725" width="155.563" height="140.614"
                        transform="rotate(-42.8643 0.86792 -6.67725)" fill="url(#paint0_linear_1416_215)" />
                    <defs>
                        <linearGradient id="paint0_linear_1416_215" x1="78.6495" y1="-6.67725" x2="78.6495" y2="133.937"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F6F7F8" />
                            <stop offset="1" stop-color="#4AAD52" stop-opacity="1" />
                        </linearGradient>
                    </defs>
                </svg>
            </span>
            <span class="absolute bottom-0 right-0 -z-10">
                <svg width="175" height="104" viewBox="0 0 175 104" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.1" x="175.011" y="108.611" width="101.246" height="148.179"
                        transform="rotate(137.136 175.011 108.611)" fill="url(#paint0_linear_1416_216)" />
                    <defs>
                        <linearGradient id="paint0_linear_1416_216" x1="225.634" y1="108.611" x2="225.634" y2="256.79"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F6F7F8" />
                            <stop offset="0" stop-color="#4AAD52" stop-opacity="1" />
                        </linearGradient>
                    </defs>
                </svg>
            </span>
        </div>
    </div>
</aside>