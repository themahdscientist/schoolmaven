<section class="p-4 md:p-8">
    <x-filament::breadcrumbs :breadcrumbs="[
        route('app.'.session('role').'.dashboard') => 'Home',
        route('app.'.session('role').'.academics') => 'Academics',
        route('app.'.session('role').'.academics.classrooms') => 'Classrooms',
        ]" class="mb-4 md:mb-8" />
    {{-- Classrooms table --}}
    <div
        class="fi-ta-ctn divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
        <div class="fi-ta-header flex flex-col gap-3 p-4 sm:px-6 sm:flex-row sm:items-center">
            <div class="grid gap-y-1">
                <h3 class="fi-ta-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    Classrooms </h3>
                <p class="fi-ta-header-description text-sm text-gray-600 dark:text-gray-400"> Manage your
                    classrooms here. </p>
            </div>
        </div>
        <div
            class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10">
            @empty($classrooms)
            <div class="fi-ta-empty-state px-6 py-12">
                <div class="fi-ta-empty-state-content mx-auto grid max-w-lg justify-items-center text-center">
                    <div class="fi-ta-empty-state-icon-ctn mb-4 rounded-full bg-gray-100 p-3 dark:bg-gray-500/20">
                        @svg('s-rectangle-stack', 'fi-ta-empty-state-icon h-6 w-6 text-gray-500 dark:text-gray-400')
                    </div>
                    <h4
                        class="fi-ta-empty-state-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        No classrooms </h4>
                    <p class="fi-ta-empty-state-description text-sm text-gray-500 dark:text-gray-400 mt-1">You've not
                        been assigned any classrooms yet. Contact your administrator.</p>
                </div>
            </div>
            @else
            <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                <thead class="divide-y divide-gray-200 dark:divide-white/5">
                    <tr class="bg-gray-50 dark:bg-white/5">
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-#"
                            style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                <span
                                    class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    S/N
                                </span>
                            </span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-name"
                            style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                <span
                                    class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    Name
                                </span>
                            </span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-year_head"
                            style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                <span
                                    class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    Year Head
                                </span>
                            </span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-form_teacher"
                            style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                <span
                                    class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    Form Teacher
                                </span>
                            </span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-subjects_count"
                            style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                <span
                                    class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    No. of Subjects Offered
                                </span>
                            </span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-status"
                            style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                <span
                                    class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    Status
                                </span>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                    @foreach ($classrooms as $classroom)
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
                                                        {{ $classroom->name }}
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
                                                        {{ $classroom->grade->staff?->user->full_name }}
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
                                                        {{ $classroom->formTeacher?->user->full_name }}
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
                                                        @foreach ($classroom->subjects as $subject)
                                                        {{ $subject->name }} <br>
                                                        @endforeach
                                                        <br>
                                                        <b>Total of {{ $classroom->subjects->count() }} subject(s)</b>
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
                                                        @if ($classroom->status == 'active')
                                                        <x-filament::icon-button icon="s-check-circle" size="lg"
                                                            :tooltip="$classroom->status" />
                                                        @else
                                                        <x-filament::icon-button icon="s-x-circle" size="lg"
                                                            color="danger" :tooltip="$classroom->status" />
                                                        @endif
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
</section>