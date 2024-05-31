@assets
<style>
    .fi-checkbox-input[disabled='disabled'] {
        box-shadow: 1px 1px 1px 1px #B22222 !important;
    }
</style>
@endassets
<section class="p-4 md:p-8">
    <x-filament::breadcrumbs :breadcrumbs="[
            route('app.'.session('role').'.dashboard') => 'Home',
            route('app.'.session('role').'.academics') => 'Academics',
            route('app.'.session('role').'.academics.classrooms') => 'Classrooms',
        ]" class="mb-4 md:mb-8" />
    {{-- Classrooms table --}}
    <div>
        {{ $this->table }}
    </div>
</section>