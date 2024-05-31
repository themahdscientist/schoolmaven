@assets
<style>
    .fi-fo-field-wrp-error-message {
        display: none;
    }
</style>
@endassets
<section class="p-4 md:p-8">
    <x-filament::breadcrumbs :breadcrumbs="[
route('app.'.session('role').'.dashboard') => 'Home',
route('app.'.session('role').'.academics.timetables') => 'Timetable',
]" class="mb-4 md:mb-8" />
    {{-- Timetables --}}
    <div class="space-y-8">
        <form x-cloak x-show="$wire.search" wire:submit="generate" class="w-5/6 mx-auto space-y-4">
            {{ $this->searchEntries }}
            <x-filament::button size="lg" icon="s-pencil" type="submit" class="h-fit">
                Create
            </x-filament::button>
        </form>
        <form x-cloak x-show="$wire.timetable" wire:submit="create" class="w-11/12 mx-auto space-y-4">
            {{ $this->createTimetable }}
            <x-filament::button size="lg" icon="s-clipboard-document" type="submit" class="h-fit">
                Save
            </x-filament::button>
            <x-filament::button size="lg" icon="s-arrow-path" color="info" wire:click="generate" class="h-fit">
                Refresh
            </x-filament::button>
        </form>
    </div>
    <x-filament-actions::modals />
</section>