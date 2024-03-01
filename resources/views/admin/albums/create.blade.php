<x-admin-layout>
    @push('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    @endpush
    <x-slot name="header">
        New Album
    </x-slot>

    <x-cards.default>
        <form method="POST" action="{{ route('admin.albums.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
            <div>
                <x-forms.label for="image" value="Album Image" />
                <input type="file" name="image" id="image"/>
                <x-forms.input-error for="image" class="mt-2" />
            </div>
            <div>
                <x-forms.label for="title" value="Title" />
                <x-forms.input type="text" name="title" id="title" :value="old('title')" />
                <x-forms.input-error for="title" class="mt-2" />
            </div>
            <div class="flex justify-end space-x-4">
                <x-links.btn-secondary href="{{ url()->previous() }}" class="px-3 py-2 text-xs font-medium">Back</x-links.btn-secondary>
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Save</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>
        @push('scripts')
            <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
            <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
            <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
            <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

            <script>
                // FILEPOND
                FilePond.registerPlugin(FilePondPluginImagePreview);
                FilePond.registerPlugin(FilePondPluginFileValidateType);
                FilePond.registerPlugin(FilePondPluginFileValidateSize);


                const inputElement = document.querySelector('#image');

                const pond = FilePond.create(inputElement, {
                    acceptedFileTypes: ['image/*'],
                    server: {
                        process: '{{ route('admin.filepond.upload') }}',
                        revert: '{{ route('admin.filepond.revert') }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }
                });
            </script>
        @endpush
</x-admin-layout>