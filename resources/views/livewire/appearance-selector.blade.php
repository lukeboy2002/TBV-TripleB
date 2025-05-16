<div x-data="{ open: false }" class="relative">
    <button
            @click="open = !open"
            class="flex items-center"
            aria-haspopup="true"
            :aria-expanded="open"
    >
        @switch($appearance)
            @case('light')
                <x-lucide-sun class="h-5 w-5 text-primary"/>
                @break
            @case('dark')
                <x-lucide-moon class="h-5 w-5 text-primary"/>
                @break
            @default
                <x-lucide-monitor class="h-5 w-5 text-primary"/>
        @endswitch
    </button>

    <div x-show="open"
         @click.away="open = false"
         class="absolute z-50 right-0 mt-2 w-32 rounded-md bg-background shadow-lg"
         x-transition
    >
        <div class="p-1">
            <button
                    wire:click="updateAppearance('light')"
                    @click="open = false"
                    class="flex w-full items-center rounded-md px-3.5 py-1.5 transition-colors {{ $appearance === 'light' ? 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100' : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60' }}"
            >
                <x-lucide-sun class="h-5 w-5"/>

                <span class="ml-1.5 text-sm">Light</span>
            </button>

            <button
                    wire:click="updateAppearance('dark')"
                    @click="open = false"
                    class="flex w-full items-center rounded-md px-3.5 py-1.5 transition-colors {{ $appearance === 'dark' ? 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100' : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60' }}"
            >
                <x-lucide-moon class="h-5 w-5"/>
                <span class="ml-1.5 text-sm">Dark</span>
            </button>

            <button
                    wire:click="updateAppearance('system')"
                    @click="open = false"
                    class="flex w-full items-center rounded-md px-3.5 py-1.5 transition-colors {{ $appearance === 'dark' ? 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100' : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60' }}"
            >
                <x-lucide-monitor class="h-5 w-5"/>
                <span class="ml-1.5 text-sm">System</span>
            </button>
        </div>
    </div>
</div>