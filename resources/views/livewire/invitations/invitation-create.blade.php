<div>
    <x-heading.sub>Invite User</x-heading.sub>
    <x-card.default class="mb-4">

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
                    <x-button.default type="submit">
                        Invite User
                    </x-button.default>
                </div>
            </div>
        </form>
    </x-card.default>
</div>