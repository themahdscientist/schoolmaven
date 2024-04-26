<section class="p-4 md:p-8">
    <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.academics') => 'Academics',
            route('app.'.session('role').'.academics.subjects') => 'Subjects',
        ]" class="mb-4 md:mb-8" />
    {{-- Subjects table --}}
    <div
        class="fi-ta-ctn divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
        <div class="fi-ta-header flex flex-col gap-3 p-4 sm:px-6 sm:flex-row sm:items-center">
            <div class="grid gap-y-1">
                <h3 class="fi-ta-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    Subjects </h3>
                <p class="fi-ta-header-description text-sm text-gray-600 dark:text-gray-400"> Manage your
                    subjects (courses) here. </p>
            </div>
        </div>
        <div
            class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10">
            @empty($subjects)
            <div class="fi-ta-empty-state px-6 py-12">
                <div class="fi-ta-empty-state-content mx-auto grid max-w-lg justify-items-center text-center">
                    <div class="fi-ta-empty-state-icon-ctn mb-4 rounded-full bg-gray-100 p-3 dark:bg-gray-500/20">
                        <svg class="fi-ta-empty-state-icon h-6 w-6 text-gray-500 dark:text-gray-400"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                clip-rule="evenodd"></path>
                            <path
                                d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z">
                            </path>
                        </svg>
                    </div>
                    <h4
                        class="fi-ta-empty-state-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        No guardians </h4>
                    <p class="fi-ta-empty-state-description text-sm text-gray-500 dark:text-gray-400 mt-1"> </p>
                    <div class="fi-ta-actions flex shrink-0 items-center gap-3 flex-wrap justify-center mt-6">
                        <button
                            style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);"
                            class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action"
                            type="button" wire:loading.attr="disabled" wire:click="mountTableAction('create')"> <svg
                                wire:loading.remove.delay.default="1" wire:target="mountTableAction('create')"
                                class="fi-btn-icon transition duration-75 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875ZM12.75 12a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V18a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V12Z"
                                    clip-rule="evenodd"></path>
                            </svg> <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                class="animate-spin fi-btn-icon transition duration-75 h-5 w-5 text-white"
                                wire:loading.delay.default="" wire:target="mountTableAction('create')">
                                <path clip-rule="evenodd"
                                    d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                    fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                            </svg> <span class="fi-btn-label"> New Guardian </span> </button>
                    </div>
                </div>
            </div>
            @else
            <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                <thead class="divide-y divide-gray-200 dark:divide-white/5">
                    <tr class="bg-gray-50 dark:bg-white/5">
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6" style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                <span
                                    class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    S/N
                                </span>
                            </span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6" style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                <span
                                    class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    Name
                                </span>
                            </span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6" style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                <span
                                    class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    Type
                                </span>
                            </span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6" style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                <span
                                    class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    Description
                                </span>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                    @foreach ($subjects as $subject)
                    <tr
                        class="fi-ta-row [@media(hover:hover)]:transition [@media(hover:hover)]:duration-75 bg-gray-50 dark:bg-white/5 dark:odd:bg-dark/0 odd:bg-white/0">
                        <td
                            class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3  align-middle">
                            <div class="fi-ta-col-wrp">
                                <div class="flex w-full disabled:pointer-events-none justify-center text-center">
                                    <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">

                                        <div class="flex text-center justify-center">
                                            <div class="flex max-w-max" style="">
                                                <div class="fi-ta-text-item inline-flex items-center gap-1.5">
                                                    <span
                                                        class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white"
                                                        style="">
                                                        {{ $loop->iteration }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td
                            class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3  align-middle">
                            <div class="fi-ta-col-wrp">
                                <div class="flex w-full disabled:pointer-events-none justify-center text-center">
                                    <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">

                                        <div class="flex text-center justify-center">
                                            <div class="flex max-w-max" style="">
                                                <div class="fi-ta-text-item inline-flex items-center gap-1.5">
                                                    <span
                                                        class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white"
                                                        style="">
                                                        {{ $subject->name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td
                            class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3  align-middle">
                            <div class="fi-ta-col-wrp">
                                <div class="flex w-full disabled:pointer-events-none justify-center text-center">
                                    <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">

                                        <div class="flex text-center justify-center">
                                            <div class="flex max-w-max" style="">
                                                <div class="fi-ta-text-item inline-flex items-center gap-1.5">
                                                    <span
                                                        class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white"
                                                        style="">
                                                        {{ $subject->type }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td
                            class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3  align-middle">
                            <div class="fi-ta-col-wrp">
                                <div class="flex w-full disabled:pointer-events-none justify-center text-center">
                                    <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">

                                        <div class="flex text-center justify-center">
                                            <div class="flex max-w-max" style="">
                                                <div class="fi-ta-text-item inline-flex items-center gap-1.5">
                                                    <span
                                                        class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white"
                                                        style="">
                                                        {{ $subject->description }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            @endempty
        </div>
    </div>
    </div>
</section>