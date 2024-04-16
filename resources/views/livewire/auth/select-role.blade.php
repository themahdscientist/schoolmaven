<div class="bg-secondary dark:bg-dark h-full">
    <livewire:tools.nav-banner />
    <div class="flex items-center justify-center py-6 md:py-12">
        <form wire:submit="done"
            class="rounded-md w-2/3 md:w-1/2 lg:w-1/3 space-y-4 bg-light dark:bg-body-dark px-8 py-6 shadow-lg dark:shadow-card-2 dark:shadow-light">
            <div>
                <label class="text-body-dark dark:text-secondary mb-2 block font-bold" for="role">
                    Select a role:
                </label>
                <div class="relative">
                    <select wire:model="role" id="role" name="role"
                        class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/80 dark:placeholder-secondary/60 dark:text-light">
                        @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->description }}</option>
                        @endforeach
                    </select>
                </div>
                @error('role')
                <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-end">
                <button
                    class="relative flex items-center justify-center focus:shadow-outline rounded-md bg-primary px-4 py-2 font-bold text-light text-sm focus:outline-none"
                    type="submit">
                    Continue
                    <div wire:loading.delay role="status">
                        <x-filament::loading-indicator class="absolute top-[20%] -right-7 h-6 w-6" />
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </form>
    </div>
</div>