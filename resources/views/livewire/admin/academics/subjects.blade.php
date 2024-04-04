<section class="p-4 md:p-8 h-full">
    <div class="flex items-center justify-between px-4 mb-8">
        <h1 class="font-extrabold text-xl md:text-3xl text-body-dark dark:text-secondary">Subjects Management</h1>
        <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.academics') => 'Academics',
            route('app.'.session('role').'.academics.subjects') => 'Subjects',
        ]" />
    </div>
    {{-- Subjects table --}}
    <div class="pb-8">
        {{ $this->table }}
    </div>
</section>