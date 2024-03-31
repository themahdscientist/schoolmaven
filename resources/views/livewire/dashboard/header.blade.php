<header class="sticky top-0 z-10 flex w-full bg-light dark:bg-dark">
    <div
        class="flex flex-grow items-center justify-between p-4 shadow shadow-secondary dark:shadow-neutral-600 md:px-6 2xl:px-12">
        <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
            {{-- Hamburger Toggle BTN --}}
            <button class="z-20 block rounded-sm bg-light p-0.5 shadow-sm dark:text-light dark:bg-dark lg:hidden"
                @click.stop="sidebarToggle = !sidebarToggle">
                @svg('m-bars-3', 'w-6 h-6 cursor-pointer')
            </button>
            {{-- Hamburger Toggle BTN --}}
            <a class="block flex-shrink-0 lg:hidden" href="{{ route('app.' . session('role') . '.dashboard') }}">
                <img class="w-10 rounded" src="{{ Storage::url($user->school->logo) }}" alt="Logo" />
            </a>
        </div>
        <div class="hidden md:block">
            <form action="">
                <div class="relative flex items-center justify-center">
                    <label for="search" class="sr-only">Search</label>
                    <input name="search" id="search" type="text" placeholder="Search"
                        class="rounded-lg border border-transparent bg-neutral-300 text-body-dark dark:text-secondary dark:bg-body-dark py-2 pl-10 caret-primary focus:outline-none focus:border-primary" />
                    @svg('m-magnifying-glass', 'w-6 h-6 absolute left-2 block text-primary')
                </div>
            </form>
        </div>
        {{-- Dark Mode Toggler --}}
        <ul class="flex items-center">
            <li>
                <livewire:tools.darkmode-toggler />
            </li>
        </ul>
        {{-- Dark Mode Toggler --}}

        {{-- User Area --}}
        <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
            <button class="flex items-center gap-4" @click.prevent="dropdownOpen = ! dropdownOpen">
                <span class="hidden text-right lg:block">
                    <span class="block text-sm font-bold text-dark dark:text-secondary">{{ $user->username }}</span>
                    <span
                        class="block text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ $user->email }}</span>
                </span>

                <img class="w-12 rounded-full" src="{{ Storage::url($user->avatar) }}" alt="avatar" />

                @svg('m-chevron-up', 'w-6 h-6 hidden transition dark:text-primary md:block', [':class' => "dropdownOpen
                ? 'rotate-180' : ''"])
            </button>

            {{-- Dropdown Start --}}
            <div x-show="dropdownOpen" x-transition:enter.duration.300ms x-transition:leave.duration.150ms
                class="absolute right-0 mt-4 flex w-60 flex-col rounded border border-secondary bg-light shadow dark:border-neutral-600 dark:bg-dark dark:text-secondary">
                <ul class="flex flex-col gap-y-2 border-b border-neutral-300 p-2 pb-4 dark:border-neutral-600">
                    <li>
                        <a href=""
                            class="flex items-center gap-3.5 rounded px-4 py-2 text-sm font-medium duration-300 ease-in-out hover:bg-primary hover:text-light dark:hover:bg-primary dark:hover:text-light lg:text-base">
                            @svg('m-user-circle', 'w-6 h-6')
                            <span>My Profile</span>
                        </a>
                    </li>
                    @can('view-admin')
                    <li>
                        <a href=""
                            class="flex items-center gap-3.5 rounded px-4 py-2 text-sm font-medium duration-300 ease-in-out hover:bg-primary hover:text-light dark:hover:bg-primary dark:hover:text-light lg:text-base">
                            @svg('m-newspaper', 'w-6 h-6')
                            <span>Advertise</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a href=""
                            class="flex items-center gap-3.5 rounded px-4 py-2 text-sm font-medium duration-300 ease-in-out hover:bg-primary hover:text-light dark:hover:bg-primary dark:hover:text-light lg:text-base">
                            @svg('m-cog', 'w-6 h-6')
                            <span>Account Settings</span>
                        </a>
                    </li>
                </ul>
                <div class="p-2">
                    <livewire:auth.logout
                        class="text-sm hover:text-light dark:hover:bg-danger dark:hover:text-light lg:text-base" />
                </div>
            </div>
            {{-- Dropdown End --}}
        </div>
        {{-- User Area --}}
    </div>
</header>