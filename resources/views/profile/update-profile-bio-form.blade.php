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
                <div wire:ignore>
                    <x-tiptapeditor.editor :enable-image-upload="true">
                        <label for="editor" class="sr-only">Biografie</label>
                        <div id="editor"
                             data-initial="{{ $this->body ?? '' }}"
                             data-upload-url="{{ route('editor.uploads.images') }}"
                             class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"></div>
                    </x-tiptapeditor.editor>
                </div>
                <input id="body" name="body" type="hidden" wire:model.defer="body">
                <x-form.error for="body" class="mt-2"/>
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
</div>