<form wire:submit="delete">
    <button type="submit"
        class="{{ $class }} relative flex w-full items-center justify-between rounded px-4 py-2 font-medium duration-300 ease-in-out hover:bg-danger">
        <div class="flex items-center gap-2.5">
            @svg('m-arrow-right-end-on-rectangle', 'w-6 h-6')
            <span>Log Out</span>
        </div>
        <div wire:loading.delay role="status">
            <x-filament::loading-indicator class="h-6 w-6" />
            <span class="sr-only">Loading...</span>
        </div>
    </button>
</form>