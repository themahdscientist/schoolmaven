<section class="p-4 md:p-8">
    <div class="flex items-center justify-between px-4 mb-8">
        <h1 class="font-extrabold text-xl md:text-3xl text-body-dark dark:text-secondary">Profile</h1>
        <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.profile') => 'Profile',
            ]" />
    </div>
    {{-- Profile --}}
    <div class="pb-8">
        <form wire:submit="save" class="space-y-4">
            {{ $this->form }}

            <x-filament::button size="lg" icon="c-clipboard-document" type="submit">
                Save
            </x-filament::button>
        </form>

        <x-filament-actions::modals />
    </div>
</section>