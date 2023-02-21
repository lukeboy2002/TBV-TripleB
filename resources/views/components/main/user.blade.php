<div class="flex items-center space-x-4">
    @if (Route::has('login'))
        @auth
            <!-- Profile dropdown -->
            <div class="ml-3 text-gray-900 dark:text-white text-base font-bold md:block hidden">
                <span class="sr-only">Open user menu for </span>
                {{ current_user()->username }}
            </div>
            <x-dropdowns.user />
        @else
        <div class="px-2 flex space-x-4">
            <x-links.primair class="text-xs" href="{{ route('login') }}" :active="request()->routeIs('login')">
                <i class="text-orange-500 fa-solid fa-arrow-right-to-bracket mr-2 fa-lg"></i>Login
            </x-links.primair>
            @if (Route::has('register'))
                <x-links.primair href="{{ route('register') }}" :active="request()->routeIs('register')">
                    <i class="text-orange-500 fa-solid fa-arrow-right-to-bracket mr-2 fa-lg"></i>Register
                </x-links.primair>
            @endif
        </div>
        @endauth
    @endif
</div>
