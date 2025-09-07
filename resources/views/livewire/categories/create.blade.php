<div class="space-y-4">

    @if (session('status'))
        <div class="text-green-700 text-sm">{{ session('status') }}</div>
    @endif

    <form wire:submit.prevent="createCategory" class="space-y-4">
        <div>
            <x-form.label for="name" value="Naam"/>
            <div class="flex flex-wrap gap-2">
                <x-form.input type="text" wire:model.defer="name" class="w-full border rounded px-3 py-2"
                              placeholder="Category name"/>
            </div>
            <x-form.error for="name"/>
        </div>

        <div>
            <x-form.label for="color" value="Kleur"/>
            <div class="flex flex-wrap gap-2">
                @foreach($availableColors as $c)
                    <x-badge.category :color="$c" :active="$color === $c" wire:click="$set('color', '{{ $c }}')"
                                      class="rounded-l-lg">
                        {{ ucfirst($c) }}
                    </x-badge.category>
                @endforeach
            </div>
            <x-form.error for="color"/>

            <!-- Preview section -->
            <div class="mt-4">
                <div class="border border-secondary/30 rounded p-3 flex flex-col gap-2 bg-background-hover">
                    <div class="flex items-center gap-2 flex-wrap">
                        <x-badge.category :color="$color" :active="true">
                            {{ $name !== '' ? $name : 'Nieuwe categorie' }}
                        </x-badge.category>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <x-form.label for="description" value="Omschrijving"/>
            <textarea wire:model.defer="description"
                      class="bg-transparent text-sm text-primary-muted placeholder-primary-muted rounded-lg block w-full p-2.5 border border-secondary/30 focus:border-secondary focus:outline-none focus:ring-0"
                      rows="3"
                      placeholder="Optional description..."></textarea>
        </div>

        <div class="flex justify-end gap-2">
            <x-button.default type="submit">Save</x-button.default>
        </div>
    </form>
</div>
