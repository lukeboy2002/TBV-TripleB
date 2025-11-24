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

    <section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <aside class="fixed top-[6.5rem] left-0 h-[calc(100vh-6.5rem)] bg-background text-primary flex flex-col items-center py-6 transition-all duration-300 group
                           w-16 hover:w-56 focus-within:w-56
                           2xl:w-56 2xl:hover:w-56 2xl:focus-within:w-56 z-40">
            <nav class="flex flex-col w-full">
                <x-menu.admin/>
            </nav>
        </aside>


        <!-- Content -->
        <div class="pl-16">
            <!-- Page Content -->
            @if (isset($side))
                <div class="mx-auto flex max-w-7xl flex-wrap pt-4">
                    <main class="flex w-full flex-col px-3 lg:w-3/4">
                        {{ $slot }}
                    </main>
                    <aside class="flex w-full flex-col px-3 pt-0 lg:w-1/4 mb-20">
                        {{ $side }}
                    </aside>
                </div>
            @else
                <main class="pt-4">
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
