<section class="p-4 md:p-8 h-full">
    <div class="flex items-center justify-between px-4 mb-8">
        <h1 class="font-extrabold text-xl md:text-3xl text-body-dark dark:text-secondary">Grades Management</h1>
        <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.academics') => 'Academics',
            route('app.'.session('role').'.academics.grades') => 'Grades',
        ]" />
    </div>
    {{-- Staff table --}}
    <div>
        {{ $this->table }}
    </div>
</section>