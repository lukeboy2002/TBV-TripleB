<div class="flex justify-between items-center flex-row py-2 gap-3 max-w-7xl mx-auto px-4 z-50">
    <div class="flex gap-2 items-center">
        <x-tbv-button_icon type="button" icon="facebook"
                           class="bg-neutral-200 text-neutral-950 hover:bg-secondary hover:text-neutral-200 focus:outline-none focus:bg-secondary focus:text-neutral-200"/>
        <x-tbv-button_icon type="button" icon="linkedin"
                           class="bg-neutral-200 text-neutral-950 hover:bg-secondary hover:text-neutral-200 focus:outline-none focus:bg-secondary focus:text-neutral-200"/>
        <x-tbv-button_icon type="button" icon="instagram"
                           class="bg-neutral-200 text-neutral-950 hover:bg-secondary hover:text-neutral-200 focus:outline-none focus:bg-secondary focus:text-neutral-200"/>
        <x-tbv-button_icon type="button" icon="x"
                           class="bg-neutral-200 text-neutral-950 hover:bg-secondary hover:text-neutral-200 focus:outline-none focus:bg-secondary focus:text-neutral-200"/>
    </div>
    <div class="flex gap-2 items-center">
        @if (Route::has('login'))
            @guest
                <livewire:appearance-selector/>
                <livewire:auth.login-modal/>

                @if (Route::has('register'))
                    <div>
                        <a href="{{ route('register') }}" data-popover-target="tooltip-register"
                           class="flex items-center justify-center text-primary">
                            <x-lucide-user-plus class="w-5 h-5"/>
                        </a>

                        <div id="tooltip-register" role="tooltip"
                             class="absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
                            Register
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                @endif
            @endguest
        @endif
    </div>
</div>
