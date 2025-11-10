<x-action-section>
    <x-slot name="title">
        {{ __("Create Passkey") }}
    </x-slot>

    <x-slot name="description">
        {{ __('Log in safely and quickly without a password') }}
    </x-slot>

    <x-slot name="content">
        <form id="passkeyForm" wire:submit="validatePasskeyProperties">
            <div>
                <x-form.label for="name">{{ __('Name') }}</x-form.label>
                <x-form.input autocomplete="off" type="text" wire:model="name"/>
                <x-form.error for="name"/>
            </div>

            <div class="mt-4 flex justify-end">
                <x-button.default type="submit">
                    {{ __('Save') }}
                </x-button.default>
            </div>
        </form>


        <div class="mt-4 rounded-lg shadow-sm border-secondary/30 bg-background-hover divide-y divide-secondary/30">
            @foreach($passkeys as $passkey)
                <div class="flex justify-between items-center p-4">
                    <div>
                        <div class="text-secondary">
                            {{ $passkey->name }}
                        </div>
                        <div class="text-primary-muted text-xs">
                            {{ __('Last used') }}
                            : {{ $passkey->last_used_at?->diffForHumans() ?? __('Not used yet') }}
                        </div>
                    </div>
                    <div>
                        <x-button.danger wire:click="deletePasskey({{ $passkey->id }})">
                            {{ __('passkeys::passkeys.delete') }}
                        </x-button.danger>
                    </div>
                </div>
            @endforeach
        </div>
    </x-slot>
</x-action-section>

@include('passkeys::livewire.partials.createScript')
