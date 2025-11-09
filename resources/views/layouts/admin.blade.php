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
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @stack('styles')
</head>
<body class="font-sans antialiased">
<x-banner/>

<div class="min-h-screen bg-body z-0">
    @livewire('navigation-menu')

    {{--    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
    {{--        <div class="mx-auto flex max-w-7xl flex-wrap">--}}
    {{--            <main class="flex w-full flex-col px-3 py-6 lg:w-3/4">--}}
    {{--                {{ $slot }}--}}
    {{--            </main>--}}
    {{--            <aside class="hidden lg:flex w-full flex-col px-3 pt-0 h-screen lg:pt-6 lg:w-1/4 mb-20 gap-6">--}}
    {{--                <x-menu.admin/>--}}

    {{--                {{ $side ?? '' }}--}}

    {{--            </aside>--}}
    {{--        </div>--}}
    {{--    </section>--}}

    <section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Sidebar -->
        <aside
                class="fixed top-[6.5rem] left-0 h-[calc(100vh-6.5rem)] bg-gray-800 text-white flex flex-col items-center py-6 transition-all duration-300 group hover:w-56 w-16 z-40 "
        >
            <nav class="flex flex-col space-y-4 w-full">
                <!-- Menu item -->
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-700 transition-all duration-200">
                    <!-- Icoon -->
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                    <!-- Tekst -->
                    <span
                            class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    Dashboard
                </span>
                </a>

                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-700 transition-all duration-200">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                    <span
                            class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    Games
                </span>
                </a>

                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-700 transition-all duration-200">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    <span
                            class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    Nieuw spel
                </span>
                </a>
            </nav>
        </aside>

        <!-- Content -->
        <div class="pl-16">
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
        </div>
    </section>

</div>

@stack('modals')
@stack('scripts')
@livewireScripts
</body>
</html>
