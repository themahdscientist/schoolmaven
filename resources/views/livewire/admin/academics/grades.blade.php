<section class="p-4 md:p-8">
    <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.academics') => 'Academics',
            route('app.'.session('role').'.academics.grades') => 'Grades',
        ]" class="mb-4 md:mb-8" />
    {{-- Grades table --}}
    <div>
        {{ $this->table }}
    </div>
</section>