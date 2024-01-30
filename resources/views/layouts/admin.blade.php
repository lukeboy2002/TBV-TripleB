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

    <x-theme.admin.main-navigation />
    <x-theme.admin.side-bar />

    <main class="md:ml-64 min-h-screen px-8 pt-24">
        @if (isset($header))
            <header>
                <x-cards.default class="mx-auto py-6 px-4 mb-4">
                    <x-theme.heading>{{ $header }}</x-theme.heading>
                </x-cards.default>
            </header>
        @endif
        <div class="h-96 mb-4">
            {{ $slot }}
        </div>
    </main>

@stack('modals')

    <livewire:scripts />
    @stack('scripts')
</body>
</html>
