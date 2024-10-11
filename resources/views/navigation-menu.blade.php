<div class="sticky top-0 z-40">
    <nav x-data="{ open: false }" class="bg-menu/90">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <div class="flex items-center text-xl font-black text-orange-500 tracking-widest">
                    <x-application-logo/>
                    TBV-TripleB
                </div>
                <div class="flex">
                    <!-- Navigation Links -->
                    <div class="hidden space-x-4 sm:-my-px sm:flex">
                        <x-link-nav href="{{ route('home') }}" :active="request()->routeIs('home')">
                            {{ __('Home') }}
                        </x-link-nav>
                        <x-link-nav href="{{ route('gallery') }}" :active="request()->routeIs('gallery')">
                            {{ __('Gallery') }}
                        </x-link-nav>
                        <x-link-nav href="{{ route('specials') }}" :active="request()->routeIs('specials')">
                            {{ __('Specials') }}
                        </x-link-nav>
                        <x-link-nav href="{{ route('about-us') }}" :active="request()->routeIs('about-us')">
                            {{ __('About-us') }}
                        </x-link-nav>
                        <x-link-nav href="{{ route('book') }}" :active="request()->routeIs('book')">
                            {{ __('Book') }}
                        </x-link-nav>
                        <x-link-nav href="{{ route('events') }}" :active="request()->routeIs('events')">
                            {{ __('Events') }}
                        </x-link-nav>
                        <x-link-nav href="{{ route('shop') }}" :active="request()->routeIs('shop')">
                            {{ __('Shop') }}
                        </x-link-nav>
                        <x-link-nav href="{{ route('blog') }}" :active="request()->routeIs('blog')">
                            {{ __('Blog') }}
                        </x-link-nav>
                        <x-link-nav href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                            {{ __('Contact') }}
                        </x-link-nav>
                        <div class="border border-l border-orange-500/30"></div>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        @if (Route::has('login'))
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                @auth
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <img class="h-8 w-8 rounded-full object-cover"
                                                         src="{{ Auth::user()->profile_photo_url }}"
                                                         alt="{{ Auth::user()->username }}"/>
                                                </button>
                                            @else
                                                <span class="inline-flex rounded-md">
                                                    <button type="button"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                        {{ Auth::user()->username }}

                                                        <svg class="ms-2 -me-0.5 h-4 w-4"
                                                             xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5"
                                                             stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                                        </svg>
                                                    </button>
                                                </span>
                                            @endif
                                        </x-slot>

                                        <x-slot name="content">
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Account') }}
                                            </div>

                                            <x-link-dropdown href="{{ route('profile.show') }}">
                                                {{ __('Profile') }}
                                            </x-link-dropdown>

                                            <div class="border-t border-orange-500/30"></div>
                                            <x-link-dropdown href="{{ route('games.create') }}">
                                                {{ __('New Game') }}
                                            </x-link-dropdown>
                                            <div class="border-t border-orange-500/30"></div>
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                @csrf

                                                <a href="{{ route('logout') }}"
                                                   class="block px-4 py-2 text-sm leading-5 text-gray-400 hover:text-orange-500 focus:outline-none focus:text-orange-500 transition duration-150 ease-in-out"
                                                   @click.prevent="$root.submit();">
                                                    {{ __('Log Out') }}
                                                </a>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @else
                                    <x-link-nav href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    </x-link-nav>

                                    @if (Route::has('register'))
                                        <x-link-nav href="{{ route('register') }}">
                                            {{ __('Register') }}
                                        </x-link-nav>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-orange-500 hover:bg-menu/30 focus:outline-none focus:bg-menu/30 transition duration-150 ease-in-out">
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
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="space-y-1 pb-3 pt-2">
                <x-link-nav-responsive href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('gallery') }}" :active="request()->routeIs('gallery')">
                    {{ __('Gallery') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('specials') }}" :active="request()->routeIs('specials')">
                    {{ __('Specials') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('about-us') }}" :active="request()->routeIs('about-us')">
                    {{ __('About-us') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('book') }}" :active="request()->routeIs('book')">
                    {{ __('Book') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('events') }}" :active="request()->routeIs('events')">
                    {{ __('Events') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('shop') }}" :active="request()->routeIs('shop')">
                    {{ __('Shop') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('blog') }}" :active="request()->routeIs('blog')">
                    {{ __('Blog') }}
                </x-link-nav-responsive>
                <x-link-nav-responsive href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                    {{ __('Contact') }}
                </x-link-nav-responsive>
            </div>

            @if (Route::has('login'))
                <!-- Responsive Settings Options -->

                <div class="border-t border-gray-200 pb-1 pt-4">
                    @auth
                        <div class="flex items-center px-4">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="shrink-0 me-3">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                         src="{{ Auth::user()->profile_photo_url }}"
                                         alt="{{ Auth::user()->username }}"/>
                                </div>
                            @endif

                            <div>
                                <div class="font-medium text-base text-gray-400">{{ Auth::user()->username }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <!-- Account Management -->
                            <x-link-nav-responsive href="{{ route('profile.show') }}"
                                                   :active="request()->routeIs('profile.show')">
                                {{ __('Profile') }}
                            </x-link-nav-responsive>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-link-nav-responsive href="{{ route('logout') }}"
                                                       @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
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
                    @endif
                </div>
            @endauth
        </div>
    </nav>
</div>
