<x-card.default>
    <div class="shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form wire:submit="save">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-form.label for="email" value="{{ __('Email') }}"/>
                        <x-form.input wire:model.defer="email"
                                      id="email"
                                      name="email"
                                      type="email"
                                      placeholder="{{ __('Email')}}"
                                      required
                                      class="mt-1 block w-full"/>
                        <x-form.error for="email" class="mt-2"/>
                    </div>

                    <div class="flex justify-end gap-2">
                        <x-button.secondary href="{{ route('admin.invitations.index') }}">
                            Cancel
                        </x-button.secondary>
                        <x-button.default type="submit">
                            Invite User
                        </x-button.default>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-card.default>
