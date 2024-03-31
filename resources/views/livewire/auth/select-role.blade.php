<div class="bg-secondary dark:bg-dark h-full">
    <livewire:tools.nav-banner />
    <div class="flex items-center justify-center py-6 md:py-12">
        <form wire:submit="set"
            class="rounded-md w-2/3 md:w-1/2 lg:w-1/3 space-y-4 bg-light dark:bg-body-dark px-8 py-6 shadow-lg dark:shadow-card-2 dark:shadow-light">
            <div>
                <label class="text-body-dark dark:text-secondary mb-2 block font-bold" for="role">
                    Select a role:
                </label>
                <div class="relative">
                    <select wire:model="role" id="role" name="role" class="bg-secondary placeholder-body-dark/60 text-dark text-sm rounded-lg w-full py-2 px-4 outline-none focus:ring-primary focus:ring-2 caret-primary dark:bg-dark/40 dark:placeholder-secondary/60 dark:text-light"></select>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->description }}</option>
                        @endforeach
                </div>
                @error('role')
                    <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-end">
                <button
                    class="relative focus:shadow-outline rounded-md bg-primary px-4 py-2 font-bold text-light text-sm focus:outline-none"
                    type="submit">
                    Continue
                    <svg wire:loading wire:target="set" role="status" aria-hidden="true"
                        class="dark:text-body-dark text-light absolute -right-6 h-5 w-5 animate-spin fill-primary"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
