<form wire:submit="save">
    <div class="fi-modal-header flex px-6 pt-6 gap-x-5">
        <div class="absolute end-4 top-4">
            <button
                style="--c-300:var(--gray-300);--c-400:var(--gray-400);--c-500:var(--gray-500);--c-600:var(--gray-600);"
                class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 disabled:pointer-events-none disabled:opacity-70 -m-1.5 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500 fi-color-gray fi-modal-close-btn"
                title="Close" type="button" tabindex="-1" wire:click="$dispatch('closeModal')">
                <span class="sr-only">
                    Close
                </span> <svg class="fi-icon-btn-icon h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="">
            <h2 class="fi-modal-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                Subjects
            </h2>
            <p class="fi-modal-description text-sm text-gray-500 dark:text-gray-400 mt-2">
                You can view and assign subjects to a grade
            </p>
        </div>
    </div>
    <div class="fi-modal-content flex flex-col gap-y-4 py-6 px-6">
        <div style="--cols-default: repeat(1, minmax(0, 1fr));"
            class="grid grid-cols-[--cols-default] fi-fo-component-ctn gap-6" x-data="{}">
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div data-field-wrapper="" class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3 ">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white"> Subjects
                                    offered
                                </span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div style="--cols-default: 1; --cols-lg: 3;"
                                class="columns-[--cols-default] lg:columns-[--cols-lg] fi-fo-checkbox-list gap-4 -mt-4">
                                @foreach ($grades as $grade)
                                <div wire:key="{{ $loop->iteration}}" class="break-inside-avoid pt-4">
                                    <label class="fi-fo-checkbox-list-option-label flex gap-x-3">
                                        <input type="checkbox"
                                            class="fi-checkbox-input rounded border-none bg-white shadow-sm ring-1 transition duration-75 checked:ring-0 focus:ring-2 focus:ring-offset-0 disabled:pointer-events-none disabled:bg-gray-50 disabled:text-gray-50 disabled:checked:bg-current disabled:checked:text-gray-400 dark:bg-white/5 dark:disabled:bg-transparent dark:disabled:checked:bg-gray-600 text-primary-600 ring-gray-950/10 focus:ring-primary-600 checked:focus:ring-primary-500/50 dark:text-primary-500 dark:ring-white/20 dark:checked:bg-primary-500 dark:focus:ring-primary-500 dark:checked:focus:ring-primary-400/50 dark:disabled:ring-white/10 mt-1"
                                            value="{{ $grade->id }}" wire:model="staffGrades">
                                        <div class="grid text-sm leading-6">
                                            <span
                                                class="fi-fo-checkbox-list-option-label font-medium text-gray-950 dark:text-white">
                                                {{ $grade->name }}
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fi-modal-footer w-full px-6 pb-6">
        <div class="fi-modal-footer-actions gap-3 flex flex-wrap items-center">
            <x-filament::button type="submit">
                Update
            </x-filament::button>
            <x-filament::button color="gray" wire:click="$dispatch('closeModal')">
                Cancel
            </x-filament::button>
        </div>
    </div>
</form>