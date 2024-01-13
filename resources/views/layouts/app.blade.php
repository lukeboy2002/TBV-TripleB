<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://kit.fontawesome.com/26b11da1dc.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        @stack('styles')
        <livewire:styles />
    </head>
    <body class="antialiased relative text-gray-900 dark:text-white bg-white dark:bg-gray-800 max-w-full overflow-x-hidden">
        <div class="z-50">
{{--            <x-messages />--}}
        </div>
        <x-theme.header />
        <x-theme.main-navigation />

        @if (isset($header))
            <header>
                {{ $header }}
            </header>
        @endif

        @if (isset($side))
            <div class="max-w-6xl mx-auto flex flex-wrap">
                <main class="w-full md:w-2/3 flex flex-col px-3">
                    {{ $slot }}
                </main>
                <aside class="w-full md:w-1/3 flex flex-col px-3">
                    {{ $side }}
                </aside>
            </div>
        @else
            <main class="max-w-6xl mx-auto">
                {{ $slot }}
            </main>

        @endif
        <x-theme.mobile-navigation />

        <x-theme.footer />
        @stack('modals')

        <livewire:scripts />
        @stack('scripts')
    </body>
</html>
