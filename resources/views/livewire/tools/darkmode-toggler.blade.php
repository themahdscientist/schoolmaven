<label :class="$store.darkMode.on ? 'bg-primary' : 'bg-secondary'"
    class="relative m-0 block h-6 w-12 md:h-8 md:w-14 cursor-pointer rounded-full">
    <input type="checkbox" :value="$store.darkMode.on" @change="$store.darkMode.toggle()" class="sr-only" />
    <span :class="$store.darkMode.on && 'right-1 translate-x-full'"
        class="absolute left-1 top-1/2 flex h-5 w-5 md:h-6 md:w-6 -translate-y-1/2 translate-x-0 items-center justify-center rounded-full bg-dark duration-75 ease-linear dark:bg-light">
        <span class="flex items-center dark:hidden">
            <svg class="h-4 w-4 md:h-5 md:w-5 text-light" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M13 3a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0V3ZM6.3 5A1 1 0 0 0 5 6.2l1.4 1.5a1 1 0 0 0 1.5-1.5L6.3 5Zm12.8 1.3A1 1 0 0 0 17.7 5l-1.5 1.4a1 1 0 0 0 1.5 1.5L19 6.3ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm-9 4a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H3Zm16 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2ZM7.8 17.7a1 1 0 1 0-1.5-1.5L5 17.7A1 1 0 1 0 6.3 19l1.5-1.4Zm9.9-1.5a1 1 0 0 0-1.5 1.5l1.5 1.4a1 1 0 0 0 1.4-1.4l-1.4-1.5ZM13 19a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Z"
                    clip-rule="evenodd" />
            </svg>
        </span>
        <span class="hidden dark:flex dark:items-center">
            <svg class="h-4 w-4 md:h-5 md:w-5 text-dark" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M11.7 2a10 10 0 1 0 9.8 13.3 1 1 0 0 0-1-1.3H20a8 8 0 0 1-7.6-10.6l.1-.4a1 1 0 0 0-.8-1Z"
                    clip-rule="evenodd" />
            </svg>
        </span>
    </span>
</label>