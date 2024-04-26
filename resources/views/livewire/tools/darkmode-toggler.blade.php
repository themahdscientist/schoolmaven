<label :class="$store.darkMode.on ? 'bg-primary' : 'bg-secondary'"
    class="relative m-0 block h-6 w-12 md:h-8 md:w-14 cursor-pointer rounded-full">
    <input type="checkbox" :value="$store.darkMode.on" @change="$store.darkMode.toggle()" class="sr-only" />
    <span :class="$store.darkMode.on && 'right-1 translate-x-full'"
        class="absolute left-1 top-1/2 flex h-5 w-5 md:h-6 md:w-6 -translate-y-1/2 translate-x-0 items-center justify-center rounded-full bg-dark duration-75 ease-linear dark:bg-light">
        <span class="flex items-center dark:hidden">
            @svg('s-sun', 'h-4 w-4 md:h-5 md:w-5 text-light')
        </span>
        <span class="hidden dark:flex dark:items-center">
            @svg('s-moon', 'h-4 w-4 md:h-5 md:w-5 text-dark')
        </span>
    </span>
</label>