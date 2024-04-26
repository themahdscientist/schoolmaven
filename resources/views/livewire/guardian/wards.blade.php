<section class="p-4 md:p-8">
    <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.wards') => 'Wards',
            ]" class="mb-4 md:mb-8" />
    {{-- Profile --}}
    <form class="space-y-4">
        {{ $this->wardsInfolist }}
    </form>
    <x-filament-actions::modals />
</section>