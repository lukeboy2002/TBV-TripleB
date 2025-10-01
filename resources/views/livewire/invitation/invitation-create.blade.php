<div>
    <x-heading.sub>{{ __('Invite User') }}</x-heading.sub>
    <x-card.default>
        <form wire:submit.prevent="createInvitation" class="space-y-4">
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
                        {{ __('Invite User') }}
                    </x-button.default>
                </div>
            </div>
        </form>
    </x-card.default>
</div>