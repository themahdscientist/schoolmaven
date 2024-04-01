@assets
<style>
    .iti {
        display: block;
    }

    .iti__search-input:focus {
        outline: 2px solid #4AAD52;
    }

    body.dark .iti__country-list,
    body.dark .iti__search-input {
        background-color: #3A3A41;
        color: #EAEAEA;
    }

    body.dark .iti__arrow {
        border-top-color: #EAEAEA;
    }

    body.dark .iti__arrow--up {
        border-bottom-color: #EAEAEA;
    }

    .hidden[type="checkbox"]:checked+span>span {
        background-color: #4AAD52;
    }

    .hidden[type="checkbox"]:checked+span {
        border-color: #4AAD52;
    }
</style>
@endassets
<section x-data="{ step: 1 }" class="bg-secondary dark:bg-dark">
    <livewire:tools.nav-banner />
    <div class="flex items-center justify-center py-12 lg:py-16">
        <form wire:submit="register" @keyup.shift.alt.right.window="if (step < 3) step += 1"
            @keyup.shift.alt.left.window="if (step > 1) step -= 1"
            class="rounded-md w-[83.33%] md:w-[66.66%] lg:w-[49.99%] space-y-4 bg-light dark:bg-body-dark px-8 py-6 shadow-lg dark:shadow-card-2 dark:shadow-light">
            <div id="alert" role="alert"
                class="mb-2 @if ($error) flex @else hidden @endif w-full items-center justify-center rounded border-l-8 border-[#d33434] bg-[#d33434] bg-opacity-75 p-4 shadow-md dark:bg-body-dark">
                <div class="mr-5 flex h-9 w-full max-w-[36px] items-center justify-center rounded-lg bg-[#d33434]">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.4917 7.65579L11.106 12.2645C11.2545 12.4128 11.4715 12.5 11.6738 12.5C11.8762 12.5 12.0931 12.4128 12.2416 12.2645C12.5621 11.9445 12.5623 11.4317 12.2423 11.1114C12.2422 11.1113 12.2422 11.1113 12.2422 11.1113C12.242 11.1111 12.2418 11.1109 12.2416 11.1107L7.64539 6.50351L12.2589 1.91221L12.2595 1.91158C12.5802 1.59132 12.5802 1.07805 12.2595 0.757793C11.9393 0.437994 11.4268 0.437869 11.1064 0.757418C11.1063 0.757543 11.1062 0.757668 11.106 0.757793L6.49234 5.34931L1.89459 0.740581L1.89396 0.739942C1.57364 0.420019 1.0608 0.420019 0.740487 0.739944C0.42005 1.05999 0.419837 1.57279 0.73985 1.89309L6.4917 7.65579ZM6.4917 7.65579L1.89459 12.2639L1.89395 12.2645C1.74546 12.4128 1.52854 12.5 1.32616 12.5C1.12377 12.5 0.906853 12.4128 0.758361 12.2645L1.1117 11.9108L0.758358 12.2645C0.437984 11.9445 0.437708 11.4319 0.757539 11.1116C0.757812 11.1113 0.758086 11.111 0.75836 11.1107L5.33864 6.50287L0.740487 1.89373L6.4917 7.65579Z"
                            fill="#ffffff" stroke="#ffffff"></path>
                    </svg>
                </div>
                <div class="w-full">
                    <h5 class="text-base font-bold text-dark dark:text-[#d33434]">
                        Error
                    </h5>
                    <p class="text-sm font-bold leading-relaxed text-body-dark dark:text-secondary">
                        {{ $error }}
                    </p>
                </div>
                <button type="button"
                    class="ms-auto bg-light/50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-dark/50 dark:text-red-400 dark:hover:ring-red-400 dark:hover:ring-2"
                    data-dismiss-target="#alert" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <h1 class="text-xl font-bold leading-tight tracking-tight text-dark md:text-2xl dark:text-light">
                Sign up to access an account
            </h1>
            <div x-cloak x-show="step == 1" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90" class="space-y-6">
                {{-- School Name | School Alias --}}
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="relative md:w-2/3">
                        <label for="s_name"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">School
                            Name</label>
                        <div class="relative">
                            <input type="text" wire:model.blur="form.s_name" name="s_name" id="s_name"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                placeholder="SkoolMaven Academy" required>
                            <svg wire:loading wire:target="form.s_name" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-0"
                            class="@error('form.s_name') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_name')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-0" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-1/3">
                        <label for="s_alias"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">School
                            Alias</label>
                        <div class="relative">
                            <input type="text" wire:model.blur="form.s_alias" name="s_alias" id="s_alias"
                                placeholder="SKMA"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                required>
                            <svg wire:loading wire:target="form.s_alias" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-1"
                            class="@error('form.s_alias') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_alias')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-1" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- School Address | Country --}}
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="relative md:w-full">
                        <label for="s_addr"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">School
                            Address</label>
                        <div class="relative">
                            <input type="text" wire:model.blur="form.s_addr" name="s_addr" id="s_addr"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                placeholder="No. 1 Ekwema Crescent, Ikenegbu" required>
                            <svg wire:loading wire:target="form.s_addr" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-2"
                            class="@error('form.s_addr') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_addr')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-2" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-1/2">
                        <label for="country"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Country</label>
                        <div class="relative">
                            <select wire:model.blur="form.country" name="country" id="country"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/80 dark:placeholder-secondary/60 dark:text-light">
                                <option value>Select an option</option>
                                @foreach ($form->countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <svg wire:loading wire:target="form.country" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-3"
                            class="@error('form.country') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.country')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-3" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- State | LGA | Postal Code / PMB --}}
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="relative md:w-1/3">
                        <label for="state"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">State</label>
                        <div class="relative">
                            <select wire:model.blur="form.state" name="state" id="state"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/80 dark:placeholder-secondary/60 dark:text-light">
                                <option value>Select an option</option>
                                @if ($form->country)
                                @foreach ($form->states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                                @endif
                            </select>
                            <svg wire:loading wire:target="form.state" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-4"
                            class="@error('form.state') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.state')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-4" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-1/3">
                        <label for="lga"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">LGA</label>
                        <div class="relative">
                            <select wire:model.blur="form.lga" name="lga" id="lga"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/80 dark:placeholder-secondary/60 dark:text-light">
                                <option value>Select an option</option>
                                @if($form->state)
                                @foreach($form->lgas as $lga)
                                <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                                @endforeach
                                @endif
                            </select>
                            <svg wire:loading wire:target="form.lga" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-5"
                            class="@error('form.lga') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.lga')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-5" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-1/3">
                        <label for="s_pmb"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Postal
                            code / PMB</label>
                        <div class="relative">
                            <input type="text" wire:model.blur="form.s_pmb" name="s_pmb" id="s_pmb"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                placeholder="460242" required>
                            <svg wire:loading wire:target="form.s_pmb" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-6"
                            class="@error('form.s_pmb') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_pmb')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-6" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Contact Email | Website URL --}}
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="relative md:w-full">
                        <label for="s_email"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Contact
                            Email</label>
                        <div class="relative">
                            <input type="email" wire:model.blur="form.s_email" name="s_email" id="s_email"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                placeholder="edu@skoolmaven.com" required>
                            <svg wire:loading wire:target="form.s_email" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-7"
                            class="@error('form.s_email') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_email')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-7" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-full">
                        <label for="s_url"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Website
                            URL</label>
                        <div class="relative">
                            <input type="text" wire:model.blur="form.s_url" name="s_url" id="s_url"
                                placeholder="www.skoolmaven.com"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                required>
                            <svg wire:loading wire:target="form.s_url" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-8"
                            class="@error('form.s_url') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_url')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-8" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Institution Type | Affiliates --}}
                <div class="flex flex-col md:flex-row md:items-start gap-4">
                    <div class="relative md:w-full">
                        <div class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">
                            Institution
                            Type</div>
                        <div class="relative space-y-2">
                            <div class="flex items-center">
                                <label for="s_kg" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_type.kg" name="s_kg" id="s_kg"
                                        aria-describedby="s_kg" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span
                                        class="text-sm font-medium text-body-dark dark:text-secondary">Kindergarten</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <label for="s_ps" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_type.ps" name="s_ps" id="s_ps"
                                        aria-describedby="s_ps" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span class="text-sm font-medium text-body-dark dark:text-secondary">Primary</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <label for="s_ss" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_type.ss" name="s_ss" id="s_ss"
                                        aria-describedby="s_ss" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span
                                        class="text-sm font-medium text-body-dark dark:text-secondary">Secondary</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <label for="s_ts" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_type.ts" name="s_ts" id="s_ts"
                                        aria-describedby="s_ts" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span class="text-sm font-medium text-body-dark dark:text-secondary">Tertiary</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <label for="s_si" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_type.si" name="s_si" id="s_si"
                                        aria-describedby="s_si" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span class="text-sm font-medium text-body-dark dark:text-secondary">Special</span>
                                </label>
                            </div>
                            <svg wire:loading wire:target="form.s_type" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-9"
                            class="@error('form.s_type') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_type')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-9" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-full">
                        <div class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">
                            Affiliates</div>
                        <div class="relative space-y-2">
                            <div class="flex items-center">
                                <label for="s_jamb" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_affiliates.jamb" name="s_jamb"
                                        id="s_jamb" aria-describedby="s_jamb" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span class="text-sm font-medium text-body-dark dark:text-secondary">JAMB</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <label for="s_waec" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_affiliates.waec" name="s_waec"
                                        id="s_waec" aria-describedby="s_waec" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span class="text-sm font-medium text-body-dark dark:text-secondary">WAEC</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <label for="s_neco" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_affiliates.neco" name="s_neco"
                                        id="s_neco" aria-describedby="s_neco" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span class="text-sm font-medium text-body-dark dark:text-secondary">NECO</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <label for="s_gce" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_affiliates.gce" name="s_gce"
                                        id="s_gce" aria-describedby="s_gce" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span class="text-sm font-medium text-body-dark dark:text-secondary">GCE</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <label for="s_sat" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_affiliates.sat" name="s_sat"
                                        id="s_sat" aria-describedby="s_sat" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span class="text-sm font-medium text-body-dark dark:text-secondary">SAT</span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <label for="s_ielts" class="flex items-center cursor-pointer gap-2">
                                    <input type="checkbox" wire:model.blur="form.s_affiliates.ielts" name="s_ielts"
                                        id="s_ielts" aria-describedby="s_ielts" class="hidden">
                                    <span role="checkbox"
                                        class="w-4 h-4 border flex border-body-dark/30 rounded bg-secondary dark:bg-body-dark dark:border-secondary/30">
                                        <span class="rounded w-full m-0.5"></span>
                                    </span>
                                    <span class="text-sm font-medium text-body-dark dark:text-secondary">IELTS</span>
                                </label>
                            </div>
                            <svg wire:loading wire:target="form.s_affiliates" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-10"
                            class="@error('form.s_affiliates') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_affiliates')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-10" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div x-cloak x-show="step == 2" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90" class="space-y-6">
                {{-- Accreditation | Location Status --}}
                <div wire:ignore class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="relative md:w-full">
                        <label for="s_accredit"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Accreditation</label>
                        <div class="relative">
                            <select wire:model.blur="form.s_accredit" name="s_accredit" id="s_accredit"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/80 dark:placeholder-secondary/60 dark:text-light">
                                {{-- Additional information will be necessary to validate this claim --}}
                                <option value>Select an option</option>
                                <option value="intl">International</option>
                                <option value="ntl">National</option>
                                <option value="rgl">Regional</option>
                            </select>
                            <svg wire:loading wire:target="form.s_accredit" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-11"
                            class="@error('form.s_accredit') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_accredit')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-11" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-full">
                        <label for="s_location"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Location
                            Status</label>
                        <div class="relative">
                            <select wire:model.blur="form.s_location" name="s_location" id="s_location"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/80 dark:placeholder-secondary/60 dark:text-light">
                                <option value>Select an option</option>
                                <option value="hq">Headquarters</option>
                                <option value="br">Branch</option>
                            </select>
                            <svg wire:loading wire:target="form.s_location" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-12"
                            class="@error('form.s_location') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_location')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-12" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Logo | Established Date --}}
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="relative md:w-full">
                        <label for="s_logo"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Logo</label>
                        <div class="relative">
                            <input type="file" wire:model.blur="form.s_logo" name="s_logo" id="s_logo"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 !outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light file:font-medium file:border-none file:cursor-pointer file:text-dark file:bg-light dark:file:text-light dark:file:bg-body-dark"
                                required>
                            <svg wire:loading wire:target="form.s_logo" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-13"
                            class="@error('form.s_logo') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_logo')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-13" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div wire:ignore class="relative md:w-full">
                        <label for="s_est"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Established
                            Date</label>
                        <div class="relative">
                            <input type="date" wire:model.blur="form.s_est" name="s_est" id="s_est"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                x-data x-ref="est" x-init="window.flatpickr($refs.est, {
                                            dateFormat: 'Y-m-d',
                                            altInput: true,
                                            altFormat: 'F j, Y',
                                        });
                                        $refs.est.addEventListener('change', function() {
                                            $dispatch('input', $refs.est.value);
                                        });" placeholder="January 01, 2007" required>
                            <svg wire:loading wire:target="form.s_est" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-14"
                            class="@error('form.s_est') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.s_est')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-14" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Mission --}}
                <div class="relative">
                    <label for="s_mission"
                        class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Mission</label>
                    <div class="relative">
                        <textarea wire:model.blur="form.s_mission" name="s_mission" id="s_mission"
                            class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                            placeholder="SkoolMaven Academy..." required></textarea>
                        <svg wire:loading wire:target="form.s_mission" role="status" aria-hidden="true"
                            class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                    </div>
                    <div id="alert-15"
                        class="@error('form.s_mission') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                        role="alert">
                        <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            @error('form.s_mission')
                            {{ $message }}
                            @enderror
                        </div>
                        <button type="button"
                            class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                            data-dismiss-target="#alert-15" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                </div>
                {{-- Vision --}}
                <div class="relative">
                    <label for="s_vision"
                        class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Vision</label>
                    <div class="relative">
                        <textarea wire:model.blur="form.s_vision" name="s_vision" id="s_vision"
                            class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                            placeholder="SkoolMaven Academy..." required></textarea>
                        <svg wire:loading wire:target="form.s_vision" role="status" aria-hidden="true"
                            class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                    </div>
                    <div id="alert-16"
                        class="@error('form.s_vision') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                        role="alert">
                        <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            @error('form.s_vision')
                            {{ $message }}
                            @enderror
                        </div>
                        <button type="button"
                            class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                            data-dismiss-target="#alert-16" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div x-cloak x-show="step == 3" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90" class="space-y-6">
                {{-- Names --}}
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="relative md:w-1/3">
                        <label for="u_fname"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">First
                            Name</label>
                        <div class="relative">
                            <input type="text" wire:model.blur="form.u_fname" name="u_fname" id="u_fname"
                                placeholder="Ifeanyichukwu"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                required>
                            <svg wire:loading wire:target="form.u_fname" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-17"
                            class="@error('form.u_fname') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.u_fname')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-17" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-1/3">
                        <label for="u_mname"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Middle
                            Name</label>
                        <div class="relative">
                            <input type="text" wire:model.blur="form.u_mname" name="u_mname" id="u_mname"
                                placeholder="Noel"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                required>
                            <svg wire:loading wire:target="form.u_mname" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-18"
                            class="@error('form.u_mname') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.u_mname')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-18" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-1/3">
                        <label for="u_lname"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Last
                            Name</label>
                        <div class="relative">
                            <input type="text" wire:model.blur="form.u_lname" name="u_lname" id="u_lname"
                                placeholder="Akudinobi"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                required>
                            <svg wire:loading wire:target="form.u_lname" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-19"
                            class="@error('form.u_lname') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.u_lname')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-19" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- DOB | Gender | Position --}}
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div wire:ignore class="relative md:w-1/3">
                        <label for="u_dob"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Date of
                            Birth</label>
                        <div class="relative">
                            <input type="date" wire:model.blur="form.u_dob" name="u_dob" id="u_dob"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                x-data x-ref="dob" x-init="window.flatpickr($refs.dob, {
                                            dateFormat: 'Y-m-d',
                                            altInput: true,
                                            altFormat: 'F j, Y',
                                        });
                                        $refs.dob.addEventListener('change', function() {
                                            $dispatch('input', $refs.dob.value);
                                        });" placeholder="January 01, 1970" required>
                            <svg wire:loading wire:target="form.u_dob" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-20"
                            class="@error('form.u_dob') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.u_dob')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-20" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div wire:ignore class="relative md:w-1/3">
                        <label for="u_gender"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Gender</label>
                        <div class="relative">
                            <select wire:model.blur="form.u_gender" name="u_gender" id="u_gender"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/80 dark:placeholder-secondary/60 dark:text-light">
                                <option value>Select an option</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <svg wire:loading wire:target="form.u_gender" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-21"
                            class="@error('form.u_gender') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.u_gender')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-21" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div wire:ignore class="relative md:w-1/3">
                        <label for="u_position"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Position</label>
                        <div class="relative">
                            <select wire:model.blur="form.u_position" name="u_position" id="u_position"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/80 dark:placeholder-secondary/60 dark:text-light">
                                <option value>Select an option</option>
                                <option value="administrator">Administrator</option>
                                <option value="principal">Principal</option>
                                <option value="owner">School Owner</option>
                            </select>
                            <svg wire:loading wire:target="form.u_position" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-22"
                            class="@error('form.u_position') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.u_position')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-22" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Religion | Avatar --}}
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div wire:ignore class="relative md:w-full">
                        <label for="u_religion"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Religion</label>
                        <div class="relative">
                            <select wire:model.blur="form.u_religion" name="u_religion" id="u_religion"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/80 dark:placeholder-secondary/60 dark:text-light">
                                <option value>Select an option</option>
                                <option value="christianity">Christianity</option>
                                <option value="islam">Islam</option>
                                <option value="other">Other</option>
                            </select>
                            <svg wire:loading wire:target="form.u_religion" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-28"
                            class="@error('form.u_religion') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.u_religion')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-28" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-full">
                        <label for="u_avatar"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Profile
                            Picture</label>
                        <div class="relative">
                            <input type="file" wire:model.blur="form.u_avatar" name="u_avatar" id="u_avatar"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 !outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light file:font-medium file:border-none file:cursor-pointer file:text-dark file:bg-light dark:file:text-light dark:file:bg-body-dark"
                                required>
                            <svg wire:loading wire:target="form.u_avatar" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-25"
                            class="@error('form.u_avatar') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.u_avatar')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-25" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Phone | User's Email --}}
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="relative md:w-full">
                        <label for="u_phone"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Phone
                            Number</label>
                        <div class="relative">
                            <input x-data x-ref="phoneInput"
                                x-init="window.intlTelInput($refs.phoneInput, { geoIpLookup: callback => {
                                        axios.post('https://ipapi.co/country_code')
                                            .then(res => callback(res.data))
                                            .catch(() => callback('ng'));
                                    },
                                    initialCountry: 'auto',
                                    preferredCountries: ['ng', 'us', 'ca', 'uk'],utilsScript: '{{ asset('src/js/iti/utils.js') }}'}); $refs.phoneInput.addEventListener('blur', function () { $dispatch('input', window.intlTelInputGlobals.getInstance($refs.phoneInput).getNumber()); });"
                                type="tel" wire:model.blur="form.u_phone" name="u_phone" id="u_phone"
                                aria-describedby="u_phone"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                required>
                            <svg wire:loading wire:target="form.u_phone" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-23"
                            class="@error('form.u_phone') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.u_phone')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-23" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-full">
                        <label for="u_email"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">User&apos;s
                            Email</label>
                        <div class="relative">
                            <input type="email" wire:model.blur="form.u_email" name="u_email" id="u_email"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                placeholder="user@skoolmaven.com" required>
                            <svg wire:loading wire:target="form.u_email" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-24"
                            class="@error('form.u_email') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.u_email')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-24" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Password | Confirm --}}
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="relative md:w-full">
                        <label for="u_password"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Password</label>
                        <div class="relative">
                            <input type="password" wire:model.blur="form.password_confirmation" name="u_password"
                                id="u_password"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                placeholder="••••••••" required>
                            <svg wire:loading wire:target="form.password_confirmation" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-26"
                            class="@error('form.password_confirmation') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.password_confirmation')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-26" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative md:w-full">
                        <label for="u_c_password"
                            class="block mb-2 text-sm font-medium text-body-dark dark:text-secondary">Confirm
                            Password</label>
                        <div class="relative">
                            <input type="password" wire:model.blur="form.password" name="u_c_password" id="u_c_password"
                                class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"
                                placeholder="••••••••" required>
                            <svg wire:loading wire:target="form.password" role="status" aria-hidden="true"
                                class="dark:text-body-dark text-secondary absolute top-1/4 right-4 h-5 w-5 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="alert-27"
                            class="@error('form.password') flex @else hidden @enderror z-50 items-center absolute w-full p-0.5 bg-red-800 rounded-lg text-light dark:bg-dark dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                @error('form.password')
                                {{ $message }}
                                @enderror
                            </div>
                            <button type="button"
                                class="ms-auto bg-light/50 text-red-800 rounded-lg focus:ring-2 focus:ring-red-400 hover:bg-red-200 inline-flex items-center dark:hover:ring-red-400 dark:hover:ring-2 justify-center h-5 w-5 dark:bg-dark/50 dark:text-red-400"
                                data-dismiss-target="#alert-27" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col items-center gap-y-2 text-xs md:text-sm text-center font-medium text-body-dark/70 dark:text-secondary/70">
                    <p>{{ __(config('app.name')) }} may use your phone number to call or send text messages with
                        information regarding your account.</p>
                    <p>By clicking Sign up, you are agreeing to {{ __(config('app.name')) }}&apos;s <a
                            href="{{ route('terms') }}"
                            class="font-medium text-primary hover:underline transition focus:outline-none focus:underline">Terms
                            of
                            Service</a> and are acknowledging our <a href="{{ route('privacy') }}"
                            class="font-medium text-primary hover:underline transition focus:outline-none focus:underline">Privacy
                            Policy</a> applies.</p>
                </div>
            </div>
            <div class="flex items-center justify-between gap-x-20">
                <button x-cloak x-show="step > 1" x-transition @click.stop="step -= 1" type="button"
                    class="w-1/2 md:w-1/4 bg-body-dark text-secondary py-2 text-sm font-medium rounded-md transition hover:bg-body-dark/90 dark:bg-secondary dark:text-body-dark dark:hover:bg-secondary/90">
                    Previous
                </button>
                <button x-cloak x-show="step < 3" x-transition @click.stop="step += 1" type="button"
                    class="w-1/2 md:w-1/4 bg-primary text-light py-2 text-sm font-medium rounded-md transition hover:bg-primary/90 dark:hover:bg-primary/90">
                    Next
                </button>
                <button x-cloak x-show="step === 3" x-transition type="submit"
                    class="w-1/2 relative flex items-center justify-center md:w-1/4 bg-primary text-light py-2 text-sm font-medium rounded-md transition hover:bg-primary/90 dark:hover:bg-primary/90">
                    Sign up
                    <svg wire:loading wire:target="register" role="status" aria-hidden="true"
                        class="text-body-dark absolute right-2 h-5 w-5 animate-spin fill-primary" viewBox="0 0 100 101"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                </button>
            </div>
            <p class="text-sm font-light text-body-dark/60 dark:text-secondary/60">
                Already have an account? <a href="{{ route('app.login') }}"
                    class="font-medium text-primary hover:underline transition focus:outline-none focus:underline">Sign
                    in</a>
            </p>
        </form>
    </div>
</section>