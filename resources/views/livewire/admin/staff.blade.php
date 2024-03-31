<section class="p-4 md:p-8 h-full">
    <div class="flex items-center justify-between px-4 mb-8">
        <h1 class="font-extrabold text-xl md:text-3xl text-body-dark dark:text-secondary">Staff Management</h1>
        <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => $user->school->name,
            route('app.'.session('role').'.staff') => 'Staff',
        ]" />
    </div>
    {{-- Staff table --}}
    <div>
        {{ $this->table }}
    </div>
</section>