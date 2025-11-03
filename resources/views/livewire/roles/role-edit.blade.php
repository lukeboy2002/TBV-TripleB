<div>
    <x-heading.sub>Edit Role, {{ $role->name }}</x-heading.sub>
    <div class="flex flex-col gap-6">
        <x-card.default>
            <form wire:submit.prevent="updateRole">
                <div class="mb-4">
                    <x-form.label for="name" value="{{ __('Name') }}"/>
                    <x-form.input id="name" type="text" wire:model="name" required/>
                    <x-form.error for="name"/>
                </div>
                <x-heading.side>Permissions</x-heading.side>
                <div class="flex flex-wrap gap-4">
                    @foreach($allPermissions as $permission)
                        <label class="flex items-center text-primary space-x-2 p-2 border border-secondary/30 rounded-lg cursor-pointer hover:bg-background-hover hover:text-secondary hover:border-secondary">
                            <x-form.checkbox
                                    type="checkbox"
                                    wire:model="selectedPermissions"
                                    value="{{ $permission }}"
                            />
                            <span>{{ $permission }}</span>
                        </label>
                    @endforeach
                </div>
                <div class="flex justify-end">
                    <x-button.default>{{ __('Save') }}</x-button.default>
                </div>
            </form>
        </x-card.default>
    </div>
</div>

