<div>
    <x-form-section submit="updateProfileBio">
        <x-slot name="title">
            Extra informatie
        </x-slot>

        <x-slot name="description">
            Update de profielgegevens.
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-form.label for="city" value="Woonplaats"/>
                <x-form.input id="city" type="text" class="mt-1 block w-full" wire:model="city"/>
                <x-form.error for="city" class="mt-2"/>
            </div>

            <div class="col-span-6">
                <x-form.label for="biography" value="Biografie"/>
                <div x-data="{ value: @entangle('biography').defer }" wire:ignore>
                    <textarea id="biography" x-ref="editor" x-cloak class="w-full"></textarea>
                </div>
                <x-form.error for="biography" class="mt-2"/>
            </div>
        </x-slot>

        <x-slot name="actions">
            <div class="pt-4 flex items-center">
                <x-action-message class="me-3" on="saved">
                    Ogeslagen.
                </x-action-message>

                <x-button.default type="submit" wire:loading.attr="disabled">
                    Save
                </x-button.default>
            </div>
        </x-slot>
    </x-form-section>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

        <script>
            document.addEventListener('livewire:init', () => {
                const el = document.getElementById('biography');
                let ck;

                ClassicEditor
                    .create(el, {
                        toolbar: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', '|',
                            'link', 'blockQuote', 'bulletedList', 'numberedList', '|',
                            'undo', 'redo'
                        ]
                    })
                    .then(editor => {
                        ck = editor;

                        // Init value vanuit Livewire
                        editor.setData(@js($biography ?? ''));

                        // Sync richting Livewire
                        editor.model.document.on('change:data', () => {
                            @this.
                            set('biography', editor.getData());
                        });

                        // Sync terug vanuit Livewire
                        Livewire.on('refresh-biography', (newVal) => {
                            if (typeof newVal === 'string' && newVal !== editor.getData()) {
                                editor.setData(newVal);
                            }
                        });
                    })
                    .catch(error => console.error(error));

                // Livewire hooks
                Livewire.hook('component.initialized', (component) => {
                    const editorWrapper = el.closest('[wire\\:ignore]');
                    if (editorWrapper) {
                        // wire:ignore voorkomt diff-problemen
                    }
                });
            });
        </script>
    @endpush
</div>