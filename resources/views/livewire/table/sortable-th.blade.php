<th scope="col" class="px-6 py-3 " wire:click="setSortBy('{{ $name }}')">
    <button class="flex items-center">
        {{ $displayName }}
        @if ($sortBy !== $name)
            <x-lucide-chevrons-up-down class="h-4 w-4"/>
        @elseif($sortDir === 'ASC')
            <x-lucide-arrow-down-a-z class="h-4 w-4"/>
        @else
            <x-lucide-arrow-up-a-z class="h-4 w-4"/>
        @endif
    </button>
</th>
