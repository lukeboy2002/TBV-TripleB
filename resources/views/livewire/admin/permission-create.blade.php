<x-card.default>
    <div class="shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form wire:submit="save">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-form.label for="permission" value="{{ __('Permission') }}"/>
                        <x-form.input wire:model="name"
                                      id="name"
                                      name="name"
                                      type="text"
                                      placeholder="{{ __('Permission')}}"
                                      required
                                      class="mt-1 block w-full"/>
                        <x-form.error for="name" class="mt-2"/>
                    </div>

                    <div class="flex justify-end gap-2">
                        <x-button.secondary href="{{ route('admin.permissions.index') }}">
                            Cancel
                        </x-button.secondary>
                        <x-button.default type="submit">
                            Create Role
                        </x-button.default>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-card.default>
