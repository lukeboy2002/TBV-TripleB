@php
    if (! isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
        JS
        : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between space-x-2">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="hidden items-center px-2 py-1 bg-background border border-secondary/30 rounded-md font-semibold text-xs text-secondary/30 uppercase tracking-widest disabled:opacity-50 transition ease-in-out duration-150 select-none">                        <x-lucide-chevrons-left
                                class="w-4 h-4"/>
                    </span>
                @else
                    @if(method_exists($paginator,'getCursorName'))
                        <button dusk="previousPage"
                                wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-2 py-1 bg-background border border-secondary/30 rounded-md font-semibold text-xs text-danger uppercase tracking-widest hover:border-border/30 focus:border-border/30 active:border-border/30 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                            <x-lucide-chevrons-left class="w-4 h-4"/>
                        </button>
                    @else
                        <button wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                wire:loading.attr="disabled"
                                dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                class="inline-flex items-center px-2 py-1 bg-background border border-secondary/30 rounded-md font-semibold text-xs text-danger uppercase tracking-widest hover:border-border/30 focus:border-border/30 active:border-border/30 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                            <x-lucide-chevrons-left class="w-4 h-4"/>
                        </button>
                    @endif
                @endif
            </span>

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    @if(method_exists($paginator,'getCursorName'))
                        <button dusk="nextPage"
                                wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-2 py-1 bg-background border border-secondary/30 rounded-md font-semibold text-xs text-secondary uppercase tracking-widest hover:border-border/30 focus:border-border/30 active:border-border/30 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                            <x-lucide-chevrons-right class="w-4 h-4"/>
                        </button>
                    @else
                        <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                                dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                class="inline-flex items-center px-2 py-1 bg-background border border-secondary/30 rounded-md font-semibold text-xs text-secondary uppercase tracking-widest hover:border-border/30 focus:border-border/30 active:border-border/30 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                            <x-lucide-chevrons-right class="w-4 h-4"/>
                        </button>
                    @endif
                @else
                    <span class="hidden items-center px-2 py-1 bg-background border border-secondary/30 rounded-md font-semibold text-xs text-secondary/30 uppercase tracking-widest disabled:opacity-50 transition ease-in-out duration-150 select-none">
                        <x-lucide-chevrons-right class="w-4 h-4"/>
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>
