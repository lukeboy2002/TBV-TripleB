@can('update', $model)
    <div class="space-y-2">
        <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
                <x-tbv-badge-tag>
                    {{ $tag }}
                    <button type="button"
                            wire:click="removeTag('{{ $tag }}')"
                            class="ml-1 text-gray-500 hover:text-gray-700">
                        &times;
                    </button>
                </x-tbv-badge-tag>
            @endforeach
        </div>

        <div class="flex items-center gap-2">
            <x-tbv-input class="text-sm w-full"
                         type="text"
                         wire:model="newTag"
                         wire:keydown.enter="addTag"
                         placeholder="new tag"/>
            <x-tbv-button type="button"
                          wire:click="addTag">
                <x-lucide-circle-plus class="w-5 h-5 text-primary"/>
            </x-tbv-button>
        </div>
    </div>
@else
    <div class="space-y-2">
        <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
                <x-tbv-badge-tag>
                    {{ $tag }}
                </x-tbv-badge-tag>
            @endforeach
        </div>
    </div>
@endcan


