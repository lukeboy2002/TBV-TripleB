<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name', '') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=montserrat:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet"/>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-white">
<x-banner/>
<div class="grid min-h-[100dvh] grid-rows-[auto_1fr_auto]">
    <livewire:navigation-menu/>

    <section class="px-0">
        <!-- Page Heading -->
        @if (isset($hero))
            <div class="relative h-124">
                {{ $hero }}
            </div>
        @endif

        <!-- Page Content -->
        @if (isset($side))
            <div class="mx-auto flex max-w-7xl flex-wrap py-4 sm:px-6 lg:px-8">
                <main class="flex w-full flex-col px-3 md:w-3/4">
                    {{ $slot }}
                </main>
                <aside class="flex w-full flex-col px-3 md:w-1/4 mb-20">
                    {{ $side }}
                </aside>
            </div>
        @else
            <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        @endif
    </section>
    <x-footer/>
</div>
@stack('modals')

@livewireScripts
</body>
</html>
