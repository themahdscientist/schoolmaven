<section class="p-4 md:p-8 h-full">
    <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.staff') => 'Staff',
            ]" class="mb-4 md:mb-8" />
    {{-- Staff table --}}
    <div>
        {{ $this->table }}
    </div>
</section>