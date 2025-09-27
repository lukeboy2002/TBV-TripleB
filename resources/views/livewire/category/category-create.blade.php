<div>
    <x-heading.sub>{{ __('Create new category') }}</x-heading.sub>
    <x-card.default>
        <form wire:submit.prevent="createCategory" class="space-y-4">
            <div>
                <x-form.label for="name" value="{{ __('Name') }}"/>
                <div class="flex flex-wrap gap-2">
                    <x-form.input type="text" wire:model.live="name" class="w-full border rounded px-3 py-2"
                                  placeholder="{{ __('Name') }}"
                                  icon="list"/>
                </div>
                <x-form.error for="name"/>
            </div>

            <div>
                <x-form.label for="color" value="{{ __('Color') }}"/>
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
                            <x-badge.category :color="$color" :active="true" class="rounded-l-lg">
                                {{ $name !== '' ? $name : __('Category') }}
                            </x-badge.category>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <x-form.label for="description" value="{{ __('Description') }}"/>
                <textarea wire:model.defer="description"
                          class="bg-transparent text-sm text-primary-muted placeholder-primary-muted rounded-lg block w-full p-2.5 border border-secondary/30 focus:border-secondary focus:outline-none focus:ring-0"
                          rows="3"
                          placeholder="{{ __('Optional description...') }}"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <x-button.default type="submit">{{ __('Save') }}</x-button.default>
            </div>
        </form>
    </x-card.default>
</div>