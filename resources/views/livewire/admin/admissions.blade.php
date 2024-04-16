<section class="p-4 md:p-8 h-full">
    <div class="flex items-center justify-between px-4 mb-8">
        <h1 class="font-extrabold text-xl md:text-3xl text-body-dark dark:text-secondary">Admissions</h1>
        <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.admissions') => 'Admissions',
            ]" />
    </div>
    {{-- Admissions --}}
    <div class="grid grid-cols-4 p-4 h-24 gap-8">
        {{ $this->student }}
        {{ $this->guardian }}
        {{ $this->student_guardian }}
    </div>
    <x-filament-actions::modals />
</section>