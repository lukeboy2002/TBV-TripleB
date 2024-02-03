<x-sections.form submit="updateProfileInformation">
    <x-slot name="title">
        Profile Information
    </x-slot>

    <x-slot name="description">
        Update your account's profile information and email address.
    </x-slot>

    <x-slot name="form">

        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                       wire:model="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-forms.label for="photo" value="Avatar" class="mb-3"/>

                <div class="flex items-center space-x-8">
                    <div class="flex-col">
                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->username }}" class="rounded-full h-20 w-20 object-cover">
                        </div>
                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                  x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>
                    </div>
                    <div class="flex h-auto space-x-2">
                        <x-buttons.secondary class="px-3 py-2 text-xs font-medium" type="button" x-on:click.prevent="$refs.photo.click()">
                            Select A New Photo
                        </x-buttons.secondary>

                        @if ($this->user->profile_photo_path)
                            <x-buttons.secondary type="button" class="px-3 py-2 text-xs font-medium" wire:click="deleteProfilePhoto">
                                Remove Photo
                            </x-buttons.secondary>
                        @endif
                    </div>
                </div>
                <x-forms.input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-forms.label for="username" value="Username" />
            <x-forms.input id="username" type="text" class="mt-1 block w-full" wire:model.defer="state.username" autocomplete="username" />
            <x-forms.input-error for="username" class="mt-2" />
        </div>
        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-forms.label for="email" value="Email" />
            <x-forms.input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" autocomplete="username" />
            <x-forms.input-error for="email" class="mt-2" />
        </div>
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
            <div class="col-span-6">

                <div class="max-w-6xl mx-auto">
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                        <x-icons name="error" class="mr-1 text-red-500"/>Your email address is unverified.
                        <x-buttons.link class="ml-6 text-left" type="button" wire:click.prevent="sendEmailVerification">
                            Click here to re-send the verification email.
                        </x-buttons.link>
                    </div>
                </div>
                @if ($this->verificationLinkSent)
                    <div class="max-w-6xl mx-auto">
                        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                            <x-icons name="check" class="mr-1" />A new verification link has been sent to your email address.
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </x-slot>


    <x-slot name="actions">
        <x-action-message class="mr-3 flex items-center" on="saved">
            <x-icons name="check" class="mr-1"/>Saved</x-action-message>

        <x-buttons.primary class="px-3 py-2 text-xs font-medium" wire:loading.attr="disabled" wire:target="photo">
            Save
        </x-buttons.primary>
    </x-slot>
</x-sections.form>
