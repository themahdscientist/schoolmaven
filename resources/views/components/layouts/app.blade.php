<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-satoshi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg">
    <title>SkoolMaven&trade; CSaaS: {{ $title }}</title>
    @livewireStyles
    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex h-full flex-col antialiased">
    @guest
    <main class="h-full antialiased">
        {{ $slot }}
    </main>
    @endguest

    @auth
    <main x-data="{ sidebarToggle: false }" class="flex bg-secondary dark:bg-dark">
        {{-- Control Panel | Sidebar --}}
        <livewire:dashboard.sidebar />

        {{-- Header & Navigation --}}
        <section class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <livewire:dashboard.header />
            {{ $slot }}
        </section>
    </main>
    @endauth

    @livewireScriptConfig
    @filamentScripts
</body>

</html>