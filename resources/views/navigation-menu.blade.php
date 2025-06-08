<div>
    <nav class="fixed z-50 w-full bg-background/80 py-3 px-4 h-[6.5rem]">
        <div class="flex justify-between items-center max-w-screen-2xl mx-auto">
            <div class="flex justify-start items-center">
                <!-- Hamburger menu-->
                <button type="button"
                        class="lg:hidden flex items-center bg-background rounded-full h-8 w-8 justify-center text-primary"
                        data-drawer-target="drawer-navigation"
                        data-drawer-toggle="drawer-navigation"
                        aria-controls="drawer-navigation">
                    <span class="sr-only">Open menu</span>
                    <x-lucide-align-left class="w-5 h-5"/>
                </button>
                <x-tbv-logo/>
                <!-- Desktop menu -->
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1 ml-6">
                    <div class="flex flex-col mt-4 space-x-6 text-sm font-medium lg:flex-row xl:space-x-8 lg:mt-0">
                        <x-tbv-mainmenu/>
                    </div>
                </div>
            </div>
            <div class="flex items-center lg:order-2">
                @if (Route::has('login'))
                    @auth
                        <livewire:appearance-selector/>
                        <x-lucide-minus class="w-auto h-8 rotate-90 text-secondary/30 "/>
                        <x-tbv-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-hidden focus:border-gray-300 transition">
                                        <img class="size-8 rounded-full object-cover"
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
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-tbv-link-dropdown href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-tbv-link-dropdown>

                                <div class="border-t border-secondary/30 my-2"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-tbv-link-dropdown href="{{ route('logout') }}"
                                                         @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-tbv-link-dropdown>
                                </form>
                            </x-slot>
                        </x-tbv-dropdown>
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
        <x-tbv-logo/>
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
                <x-tbv-mainmenu/>
            </div>
        </div>
    </div>
</div>
