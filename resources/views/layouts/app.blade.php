@props(['title' => ''])
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=montserrat:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet"/>

    <!-- Scripts -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <style>
        html {
            background-color: hsl(220 14.3% 95.9%); /* gray-100 */
        }

        html.dark {
            background-color: hsl(220.9 39.3% 11%); /* gray-900 */
        }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @stack('styles')
</head>
<body class="font-sans antialiased">
<x-banner/>

<div class="min-h-screen bg-body z-0">
    @livewire('navigation-menu')
    @if (isset($hero))
        <div class="bg-black/20">
            <div class="w-full mx-auto">
                {{ $hero }}
            </div>
        </div>
    @endif
    <section class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Page Heading -->
        @if (isset($header))
            <header class="my-4">
                {{ $header }}
            </header>
        @endif
        <!-- Page Content -->
        @if (isset($side))
            <div class="mx-auto flex max-w-7xl flex-wrap">
                <main class="flex w-full flex-col px-3 lg:w-3/4">
                    {{ $slot }}
                </main>
                <aside class="flex w-full flex-col px-3 pt-0 lg:w-1/4 mb-20">
                    {{ $side }}
                </aside>
            </div>
        @else
            <main>
                {{ $slot }}
            </main>
        @endif
    </section>
</div>

@stack('modals')
@stack('scripts')
@livewireScripts
</body>
</html>
