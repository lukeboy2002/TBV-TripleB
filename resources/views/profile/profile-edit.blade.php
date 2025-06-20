<div>
    <x-tbv-heading_h5>{{ __('Additional Information') }}</x-tbv-heading_h5>

    <x-tbv-form-section submit="updateProfile">
        <x-slot name="form">
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Cover Photo File Input -->
                <input type="file" id="photo" class="hidden"
                       wire:model.live="cover"
                       x-ref="photo"
                       x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        "/>

                <x-tbv-label for="photo" value="{{ __('Cover Photo') }}"/>

                <!-- Current Cover Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    @if(isset($state['cover_path']))
                        <img src="{{ Storage::url($state['cover_path']) }}" alt="Cover Photo"
                             class="rounded w-full h-[250px] object-cover">
                    @else
                        <img src="{{ Storage::url('covers/default.png') }}" alt="Default Cover"
                             class="rounded w-full h-[250px] object-cover">
                    @endif
                </div>

                <!-- New Cover Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded w-full h-[250px] bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-tbv-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Cover Photo') }}
                </x-tbv-button>

                @if (isset($state['cover_path']) && $state['cover_path'] != 'covers/default.png')
                    <x-tbv-button_secondary type="button" class="mt-2" wire:click="deleteCoverPhoto">
                        {{ __('Remove Cover Photo') }}
                    </x-tbv-button_secondary>
                @endif

                <x-tbv-input-error for="cover" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-tbv-label for="city" value="{{ __('City') }}"/>
                <x-tbv-input id="city" type="text" class="mt-1 block w-full" wire:model="state.city"/>
                <x-tbv-input-error for="state.city" class="mt-2"/>
            </div>

            <div class="col-span-6">
                <x-tbv-label for="biography" value="{{ __('Biography') }}"/>
                <div wire:ignore>
                <textarea data-description="@this" id="biography" rows="3" class="mt-1 block w-full form-textarea"
                          wire:model="state.biography"></textarea>
                </div>
                <x-tbv-input-error for="state.biography" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-tbv-label for="phone_number" value="{{ __('Phone Number') }}"/>
                <x-tbv-input id="phone_number" type="text" class="mt-1 block w-full" wire:model="state.phone_number"/>
                <x-tbv-input-error for="state.phone_number" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-tbv-label for="birthday" value="{{ __('Birthday') }}"/>
                <x-tbv-input id="birthday" type="date" class="mt-1 block w-full" wire:model="state.birthday"/>
                <x-tbv-input-error for="state.birthday" class="mt-2"/>
            </div>

        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-tbv-button wire:loading.attr="disabled" wire:target="cover">
                {{ __('Save Changes') }}
            </x-tbv-button>
        </x-slot>
    </x-tbv-form-section>

    @if (session('status'))
        <div class="mt-4 text-green-600 font-semibold">
            {{ session('status') }}
        </div>
    @endif
</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            ClassicEditor
                .create(document.querySelector('#biography'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.
                        set('biography', editor.getData());
                    })
                    Livewire.on('reinit', () => {
                        editor.setData('', '')
                    })
                })
                .catch(error => {
                    console.error(error);
                });
        })
    </script>
@endpush
