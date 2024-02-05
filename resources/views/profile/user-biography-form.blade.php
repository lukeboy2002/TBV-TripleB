@push('styles')
    <style>
        .dark .ck.ck-reset_all * {
            color: white !important;
        }
        .ck .ck-toolbar {
            background-color: rgb(75 85 99) !important;
            border-color: rgb(107 114 128);
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
        }

        .dark .ck .ck-toolbar {
            background-color: rgb(75 85 99) !important;
            border-color: rgb(107 114 128);
        }
        .dark .ck .ck-sticky-panel__content {
            color: #6366f1;
        }
        .dark .ck-editor__editable[role="textbox"] {
            /* Editing area */
            color: white;
        }
        .dark .ck-editor {
            /* Editing area */
            background-color: blue;
        }
        .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
            border-color: rgb(107 114 128);
            border-bottom-left-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
        }

        .dark .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
            border-color: rgb(107 114 128);
        }
        .dark .ck.ck-editor__main>.ck-editor__editable{
            background-color: rgb(75 85 99);
        }
    </style>
@endpush
<x-sections.form submit="save">
    <x-slot name="title">
        Biography
    </x-slot>

    <x-slot name="description">
        A small biography.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <div wire:ignore>
                <x-forms.label for="biography" value="Biography" />
                <x-forms.textarea id="biography" name="biography" wire:model.defer="biography"></x-forms.textarea>
                <x-forms.input-error for="biography" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex items-center space-x-2">
            <x-messages />
            <x-buttons.primary class="px-3 py-2 text-xs font-medium">
                Save
            </x-buttons.primary>
        </div>
    </x-slot>
</x-sections.form>
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            ClassicEditor
                .create(document.querySelector('#biography'), {
                    removePlugins: ['Heading', 'Table', 'CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],

                    ckfinder: {
                        uploadUrl: '{{ route('admin.users.upload', ['_token' => csrf_token()]) }}'
                    }
                })
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set('biography', editor.getData());
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
