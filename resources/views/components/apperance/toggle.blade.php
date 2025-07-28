<div>
    <button id="theme-toggle"
            type="button"
            data-popover-target="tooltip-toggle"
            class="items-center flex gap-2 px-1 text-base font-medium leading-5 text-primary hover:text-secondary focus:outline-hidden focus:text-secondary transition duration-150 ease-in-out">
        <x-lucide-moon id="theme-toggle-dark-icon"
                       class="hidden w-5 h-5"/>
        <x-lucide-sun id="theme-toggle-light-icon"
                      class="hidden w-5 h-5"/>
    </button>

    <div id="tooltip-toggle" role="tooltip"
         class="absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
        Appearance
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>