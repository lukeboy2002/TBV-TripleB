<div class="sticky top-0 z-40">

    <nav x-data="{ open: false }" class="bg-menu/90">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <div class="flex items-center text-xl font-black text-orange-500 tracking-widest">
                    <x-logo.menu/>
                    TBV-TripleB
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-4 lg:-my-px lg:ms-10 lg:flex">
                    <x-link-nav href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-link-nav>
                    <x-link-nav href="{{ route('team') }}" :active="request()->routeIs('team')">
                        {{ __('Team') }}
                    </x-link-nav>
                    <x-link-nav href="{{ route('game') }}" :active="request()->routeIs('game')">
                        {{ __('Game') }}
                    </x-link-nav>
                    <x-link-nav href="{{ route('blog') }}" :active="request()->routeIs('blog')">
                        {{ __('Blog') }}
                    </x-link-nav>
                    <x-link-nav href="{{ route('event') }}" :active="request()->routeIs('event')">
                        {{ __('Event') }}
                    </x-link-nav>
                    <x-link-nav href="{{ route('gallery') }}" :active="request()->routeIs('gallery')">
                        {{ __('Gallery') }}
                    </x-link-nav>
                    <div class="border border-l border-orange-500/30"></div>
                    <div class="hidden lg:flex lg:items-center lg:ms-6">
                        @if (Route::has("login"))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <!-- Settings Dropdown -->
                                    <div class="relative ms-3">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                    <button class="flex rounded-full border-2 border-transparent text-sm transition focus:border-gray-300 focus:outline-none">
                                                        <img class="h-8 w-8 rounded-full object-cover"
                                                             src="{{ Auth::user()->profile_photo_url }}"
                                                             alt="{{ Auth::user()->username }}"
                                                        />
                                                    </button>
                                                @else
                                                    <span class="inline-flex rounded-md">
                                                <button type="button"
                                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50">
                                                    {{ Auth::user()->username }}

                                                    <svg class="-me-0.5 ms-2 h-4 w-4"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5"
                                                         stroke="currentColor"
                                                    >
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                                @endif
                                            </x-slot>

                                            <x-slot name="content">
                                                <!-- Account Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __("Manage Account") }}
                                                </div>

                                                <x-link-dropdown wire:navigate href="{{ route('profile.show') }}">
                                                    {{ __("Profile") }}
                                                </x-link-dropdown>
                                                <div class="border-t border-orange-500/30"></div>

                                                <!-- Authentication -->
                                                <form method="POST"
                                                      action="{{ route("logout") }}"
                                                      x-data
                                                >
                                                    @csrf

                                                    <x-link-dropdown href="{{ route('logout') }}"
                                                                     @click.prevent="$root.submit();"
                                                    >
                                                        {{ __("Log Out") }}
                                                    </x-link-dropdown>
                                                </form>
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                @else
                                    <div class="ml-2 space-x-2">
                                        <x-link-nav href="{{ route('login') }}" class="text-sm">
                                            Login
                                        </x-link-nav>
                                        <x-link-nav href="{{ route('register') }}" class="text-sm">
                                            register
                                        </x-link-nav>
                                    </div>
                                @endauth
                            </nav>
                        @endif
                    </div>
                    <div class="border border-l border-primary/30"></div>
                    <div class="flex items-center space-x-2">
                        <x-switchable-theme/>
                    </div>
                </div>


                <!-- Hamburger -->
                <div class="-me-2 flex items-center lg:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-orange-500 hover:bg-black/10 focus:outline-none focus:bg-black/10 focus:text-orange-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden bg-menu-light lg:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-link-nav-responsive href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('team') }}" :active="request()->routeIs('team')">
                    {{ __('Team') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('game') }}" :active="request()->routeIs('game')">
                    {{ __('Game') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('blog') }}" :active="request()->routeIs('blog')">
                    {{ __('Blog') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('event') }}" :active="request()->routeIs('event')">
                    {{ __('Event') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('gallery') }}" :active="request()->routeIs('gallery')">
                    {{ __('Gallery') }}
                </x-link-nav-responsive>
            </div>

            <!-- Responsive Settings Options -->
            @if (Route::has("login"))
                <div class="border-t border-gray-200 pb-1 pt-4">
                    @auth()
                        <div class="flex items-center px-4">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="me-3 shrink-0">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                         src="{{ Auth::user()->profile_photo_url }}"
                                         alt="{{ Auth::user()->username }}"
                                    />
                                </div>
                            @endif

                            <div>
                                <div class="text-base font-medium text-gray-700 dark:text-gray-50">
                                    {{ Auth::user()->username }}
                                </div>
                                <div class="text-sm font-medium text-gray-500">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <!-- Account Management -->
                            <x-link-nav-responsive href="{{ route('profile.show') }}"
                                                   :active="request()->routeIs('profile.show')"
                            >
                                {{ __("Profile") }}
                            </x-link-nav-responsive>
                            <!-- Authentication -->
                            <form method="POST"
                                  action="{{ route("logout") }}"
                                  x-data
                            >
                                @csrf
                                <x-link-nav-responsive href="{{ route('logout') }}"
                                                       @click.prevent="$root.submit();"
                                >
                                    {{ __("Log Out") }}
                                </x-link-nav-responsive>
                            </form>
                        </div>
                    @else
                        <x-link-nav-responsive href="{{ route('login') }}">
                            Login
                        </x-link-nav-responsive>
                        <x-link-nav-responsive href="{{ route('register') }}">
                            Register
                        </x-link-nav-responsive>
                    @endauth
                </div>
            @endif
        </div>
    </nav>
</div>