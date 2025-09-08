<div>
    <nav class="w-full bg-background/80 py-3 px-4 h-[6.5rem] border-b border-secondary/30">
        <div class="flex justify-between items-center max-w-screen-2xl mx-auto">
            <div class="flex justify-start items-center">
                <!-- Hamburger menu-->
                <button type="button"
                        class="lg:hidden flex items-center bg-background rounded-full h-8 w-8 justify-center text-primary z-[100]"
                        data-drawer-target="drawer-navigation"
                        data-drawer-toggle="drawer-navigation"
                        aria-controls="drawer-navigation">
                    <span class="sr-only">Open menu</span>
                    <x-lucide-align-left class="w-5 h-5"/>
                </button>
                <x-logo.logo/>
                <!-- Desktop menu -->
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1 ml-6">
                    <div class="flex flex-col mt-4 space-x-6 text-sm font-medium lg:flex-row xl:space-x-8 lg:mt-0">
                        <x-menu.main/>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 lg:order-2">
                <x-apperance.toggle/>
                @if (Route::has('login'))
                    @auth
                        <x-lucide-minus class="w-auto h-8 rotate-90 text-secondary/30 "/>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-hidden focus:border-gray-300 transition">
                                        <img class="size-10 lg:size-8 rounded-full object-cover aspect-square mr-3"
                                             src="{{ Auth::user()->profile_photo_url }}"
                                             alt="{{ Auth::user()->username }}"/>
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-hidden focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        {{ Auth::user()->username }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </button>
                                </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-primary-muted">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link
                                        href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <div class="border-t border-secondary/30 my-2"></div>
                                <x-menu.user/>
                                <div class="border-t border-secondary/30 my-2"></div>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                                     @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <div>
                            <x-link.navigation href="{{ route('login') }}"
                                               icon="key-round"
                                               data-popover-target="tooltip-login">
                            </x-link.navigation>

                            <div id="tooltip-login" role="tooltip"
                                 class="absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
                                Login
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>

                        @if (Route::has('register'))
                            <div>
                                <x-link.navigation href="{{ route('register') }}"
                                                   icon="user-plus"
                                                   data-popover-target="tooltip-register">
                                </x-link.navigation>

                                <div id="tooltip-register" role="tooltip"
                                     class="absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
                                    Register
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>

                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>


    <!-- Drawer component -->
    <div id="drawer-navigation"
         class="fixed top-0 left-0 z-[100] h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-background/95 w-80 lg:hidden"
         tabindex="-1"
         aria-labelledby="drawer-navigation-label">
        <x-logo.logo/>
        <button type="button"
                data-drawer-hide="drawer-navigation"
                aria-controls="drawer-navigation"
                class="text-secondary bg-transparent hover:bg-accent hover:text-accent-foreground rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">close menu</span>
        </button>
        <div class="py-4 overflow-y-auto">
            <div class="flex flex-col gap-4 font-medium">
                <x-menu.main/>
            </div>
        </div>
    </div>
</div>