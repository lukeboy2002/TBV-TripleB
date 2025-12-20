<x-card.side>
    <x-slot name="header">Mijn Aanwezigheid</x-slot>
    @hasanyrole('admin|member')
    <div class="space-y-3">
        @if (session()->has('message'))
            <div class="w-full text-center pt-2">
                <div class="text-xs text-success">{{ session('message') }}</div>
            </div>
        @endif

        <div class="flex flex-col items-center gap-2 p-4">
            <button type="button"
                    wire:click="setStatus('attending')"
                    class="w-full px-3 py-1 rounded border text-xs {{ $status === 'attending' ? 'bg-green-100 border-green-300 text-green-800' : 'border-secondary/30' }}">
                Aanwezig
            </button>

            <button type="button"
                    wire:click="setStatus('not_attending')"
                    class="w-full px-3 py-1 rounded border text-xs {{ $status === 'not_attending' ? 'bg-red-100 border-red-300 text-red-800' : 'border-secondary/30' }}">
                Niet aanwezig
            </button>

            <button type="button"
                    wire:click="setStatus('maybe')"
                    class="w-full px-3 py-1 rounded border text-xs {{ $status === 'maybe' ? 'bg-yellow-100 border-yellow-300 text-yellow-800' : 'border-secondary/30' }}">
                Mischien
            </button>
        </div>
    </div>
    @endhasanyrole
</x-card.side>