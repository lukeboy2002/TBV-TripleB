<x-admin-layout>
    @push('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    @endpush

    <x-slot name="header">
        Edit Album
    </x-slot>

    <x-cards.default>
        <form method="POST" action="{{ route('admin.albums.update', $album) }}" class="space-y-6">
            @method('PUT')
            @csrf
            <div>
                <x-forms.label for="image" value="Image" />
                <x-forms.input type="file" name="image" id="image" />
                <x-forms.input-error for="image" class="mt-2" />
            </div>
            <div>
                <x-forms.label for="title" value="Title" />
                <x-forms.input type="text" name="title" id="title" :value="old('title') ?? $album->title" />
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
                FilePond.registerPlugin(FilePondPluginImagePreview);
                FilePond.registerPlugin(FilePondPluginFileValidateType);

                const inputElement = document.querySelector('#image');

                const pond = FilePond.create(inputElement, {
                    acceptedFileTypes: ['image/*'],
                    server: {
                        load: (source, load, error, progress, abort, headers) => {
                            const myRequest = new Request(source);
                            fetch(myRequest).then((res) => {
                                return res.blob();
                            })
                                .then(load);
                        },
                        process: '{{ route('admin.filepond.upload') }}',
                        revert: '{{ route('admin.filepond.revert') }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    },
                    files: [
                        {
                            source: '{{ Storage::disk('public')->url($album->image) }}',
                            options: {
                                type: 'local',
                            },
                        }
                    ],
                });
            </script>
        @endpush
</x-admin-layout>