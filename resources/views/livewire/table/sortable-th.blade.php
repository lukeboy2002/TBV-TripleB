<th scope="col" class="px-6 py-3 " wire:click="setSortBy('{{ $name }}')">
    <button class="flex items-center">
        {{ $displayName }}
        @if ($sortBy !== $name)
            <x-icons name="dirnotset" />
        @elseif($sortDir === 'ASC')
            <x-icons name="asc" />
        @else
            <x-icons name="desc" />
        @endif
    </button>
</th>
