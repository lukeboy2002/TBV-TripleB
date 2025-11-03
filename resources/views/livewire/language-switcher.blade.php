<div class="relative inline-block text-left">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-hidden focus:border-none transition">
                @if($locale === 'nl')
                    🇳🇱 <span class="ml-2 uppercase text-primary">NL</span>
                @else
                    🇬🇧 <span class="ml-2 uppercase text-primary">EN</span>
                @endif
            </button>
        </x-slot>

        <x-slot name="content">
            <div class="py-1">
                <button wire:click="switchLanguage('nl')"
                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-primary hover:bg-background-hover hover:text-secondary focus:outline-hidden focus:bg-background-hover focus:text-secondary transition duration-150 ease-in-out">
                    🇳🇱 <span class="ml-2">Nederlands</span>
                </button>
                <button wire:click="switchLanguage('en')"
                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-primary hover:bg-background-hover hover:text-secondary focus:outline-hidden focus:bg-background-hover focus:text-secondary transition duration-150 ease-in-out">
                    🇬🇧 <span class="ml-2">English</span>
                </button>
            </div>
        </x-slot>
    </x-dropdown>
</div>

<script>
(function () {
    if (window.__langSwitchListenerAdded) return;
    window.__langSwitchListenerAdded = true;

    window.addEventListener('language-changed', function () {
        // Slight delay to ensure session is written before reload
        setTimeout(function () {
            if (document.startViewTransition) {
                document.startViewTransition(() => window.location.reload());
            } else {
                window.location.reload();
            }
        }, 50);
    });
})();
</script>
