<section class="p-4 md:p-8">
    <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.students') => 'Students',
        ]" class="mb-4 md:mb-8" />
    {{-- Students table --}}
    <div>
        {{ $this->table }}
    </div>
</section>