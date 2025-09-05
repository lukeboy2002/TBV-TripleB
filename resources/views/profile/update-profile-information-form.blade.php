<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        Profiel informatie
    </x-slot>

    <x-slot name="description">
        Update de profielgegevens en het e-mailadres van uw account.
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <x-form.input type="file" id="photo" class="hidden"
                              wire:model.live="photo"
                              x-ref="photo"
                              x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            "/>

                <x-form.label for="photo" value="Avatar"/>

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->username }}"
                         class="rounded-full size-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-button.default class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Kies een nieuwe afbeelding') }}
                </x-button.default>

                @if ($this->user->profile_photo_path)
                    <x-button.secondary type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Verwijder afbeelding') }}
                    </x-button.secondary>
                @endif

                <x-input-error for="photo" class="mt-2"/>
            </div>
        @endif

        <!-- Username -->
        <div class="col-span-6 sm:col-span-4">
            <x-form.label for="username" value="Gebruikersnaam"/>
            <x-form.input id="username" type="text" class="mt-1 block w-full" wire:model="state.username" required
                          autocomplete="username"/>
            <x-form.error for="name" class="mt-2"/>
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-form.label for="name" value="Volledige naam"/>
            <x-form.input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required
                          autocomplete="name"/>
            <x-form.error for="name" class="mt-2"/>
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-form.label for="email" value="{{ __('Email') }}"/>
            <x-form.input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                          autocomplete="username"/>
            <x-form.error for="email" class="mt-2"/>

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            wire:click.prevent="sendEmailVerification">
                        Klik hier om de verificatie-e-mail opnieuw te verzenden.
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-success">
                        Er is een nieuwe verificatielink naar uw e-mailadres verzonden.
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            Ogeslagen.
        </x-action-message>

        <x-button.default wire:loading.attr="disabled" wire:target="photo">
            Save
        </x-button.default>
    </x-slot>
</x-form-section>
