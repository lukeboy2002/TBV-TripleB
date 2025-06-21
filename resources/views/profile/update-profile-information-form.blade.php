<div>
    <x-tbv-heading_h5>Profile Information</x-tbv-heading_h5>
    <x-tbv-form-section submit="updateProfileInformation">
        <x-slot name="form">
            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" id="photo" class="hidden"
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

                    <x-tbv-label for="photo" value="{{ __('Avatar') }}"/>

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

                    <x-tbv-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-tbv-button>

                    @if ($this->user->profile_photo_path)
                        <x-tbv-button_secondary type="button" class="mt-2" wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </x-tbv-button_secondary>
                    @endif

                    <x-input-error for="photo" class="mt-2"/>
                </div>
            @endif

            <div class="col-span-6 sm:col-span-4">
                <x-tbv-label for="username" value="{{ __('Username') }}"/>
                <x-tbv-input id="username" type="text" class="mt-1 block w-full" wire:model="state.username" required
                             autocomplete="username"/>
                <x-tbv-input-error for="username" class="mt-2"/>
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-tbv-label for="name" value="{{ __('Full name') }}"/>
                <x-tbv-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required
                             autocomplete="name"/>
                <x-tbv-input-error for="name" class="mt-2"/>
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-tbv-label for="email" value="{{ __('Email') }}"/>
                <x-tbv-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                             autocomplete="username"/>
                <x-tbv-input-error for="email" class="mt-2"/>

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <p class="text-sm mt-6 flex gap-2 text-danger">
                        <x-lucide-triangle-alert class="h-5 w-5"/>
                        {{ __('Your email address is unverified.') }}

                        <button type="button"
                                class="text-danger underline text-sm hover:text-secondary focus:outline-none focus:text-secondary transition duration-150 ease-in-out"
                                wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p class="mt-2 font-medium text-sm flex gap-2 text-success">
                            <x-lucide-check class="h-5 w-5"/>
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-tbv-button wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save') }}
            </x-tbv-button>
        </x-slot>
    </x-tbv-form-section>
</div>