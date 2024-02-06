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
        <x-theme.header />
        <x-theme.main-navigation />

        @if (isset($header))
            <header>
                {{ $header }}
            </header>
        @endif

{{--        @auth--}}
{{--            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! current_user()->hasVerifiedEmail())--}}
{{--                <div class="max-w-6xl mx-auto px-3">--}}
{{--                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">--}}
{{--                        <x-icons name="error" class="mr-1"/>Your email address is unverified.--}}
{{--                        <x-links.primary href="{{ route('profile.show', current_user()->username) }}" class="ml-6 text-left" >--}}
{{--                            Click here to go to your Profile settings to resent a new email--}}
{{--                        </x-links.primary>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @endauth--}}

        @if (isset($side))
            <div class="max-w-6xl mx-auto flex flex-wrap py-8">
                <main class="w-full md:w-2/3 flex flex-col px-3">
                    {{ $slot }}
                </main>
                <aside class="w-full md:w-1/3 flex flex-col px-3">
                    {{ $side }}
                </aside>
            </div>
        @else
            <main class="max-w-6xl mx-auto pb-8">
                {{ $slot }}
            </main>
        @endif

        <x-theme.footer />
        @stack('modals')

        <livewire:scripts />
        @stack('scripts')
    </body>
</html>
