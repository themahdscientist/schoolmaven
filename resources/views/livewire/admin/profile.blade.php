<section class="p-4 md:p-8">
    <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.profile') => 'Profile',
            ]" class="mb-4 md:mb-8" />
    {{-- Profile --}}
    <form wire:submit="save" class="space-y-4">
        {{ $this->form }}

        <x-filament::button size="lg" icon="s-clipboard-document" type="submit">
            Save
        </x-filament::button>
    </form>
    <x-filament-actions::modals />
</section>