<section class="p-4 md:p-8">
    <x-filament::breadcrumbs :breadcrumbs="[
route('app.'.session('role').'.dashboard') => 'Home',
route('app.'.session('role').'.academics.timetables') => 'Timetable',
]" class="mb-4 md:mb-8" />
    {{-- Timetables --}}
    <div class="space-y-8">
        <form>
            {{ $this->form }}
        </form>
    </div>
</section>