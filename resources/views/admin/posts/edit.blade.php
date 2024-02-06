<x-admin-layout>
    @push('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    @endpush

    <x-slot name="header">
        Edit blogpost
    </x-slot>

    <x-cards.default>
        <form method="POST" action="{{ route('admin.posts.update', $post) }}" class="space-y-6">
            @method('PUT')
            @csrf

            <div>
                <x-forms.label for="image" value="Image" />
                <x-forms.input type="file" name="image" id="image" />
                <x-forms.input-error for="image" class="mt-2" />
            </div>
            <div class="flex justify-between space-x-6">
                <div class="w-1/2">
                    <x-forms.label for="title" value="Title" />
                    <x-forms.input type="text" name="title" id="title" :value="old('title') ?? $post->title" required />
                    <x-forms.input-error for="title" class="mt-2" />
                </div>
                <div class="w-1/2">
                    <x-forms.label for="categories" value="Categories" />
                    <select
                        class="js-example-basic-multiple" style="width: 100%"
                        id="categories"
                        name="categories[]"
                        data-placeholder="Select categories..."
                        data-allow-clear="false"
                        multiple="multiple">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <x-forms.input-error for="categories" class="mt-2" />
                </div>
            </div>
            <div>
                <x-forms.label for="body" value="Post" />
                <textarea id="body" name="body">{{ $post->body }}</textarea>
                <x-forms.input-error for="body" class="mt-2" />
            </div>
            <div class="flex justify-between items-center space-x-6">
                <div class="w-1/2">
                    <x-forms.label for="published_at" value="Publish" class="mr-5"/>
                    <x-forms.input type="date" name="published_at" id="published_at" :value="old('published_at') ?? $post->published_at->format('Y-m-d')" />
                    <x-forms.input-error for="published_at" class="mt-2" />
                </div>
                <div class="w-1/2">
                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                        <input name="featured"
                               id="featured"
                               value="1"{{ ($post->featured == 1 ? ' checked' : '') }}
                               aria-describedby="featured"
                               type="checkbox"
                               class="sr-only peer"
                        >
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Featured</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-end space-x-4">
                <x-links.btn-secondary href="{{ url()->previous() }}" class="px-3 py-2 text-xs font-medium">Back</x-links.btn-secondary>
                <x-buttons.primary type="submit" class="px-3 py-2 text-xs font-medium">Save</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>



    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        @php
            $category_ids = [];
        @endphp

        @foreach($post->categories as $category)
            @php
                array_push($category_ids, $category->id);
            @endphp
        @endforeach

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
                        source: '{{ Storage::disk('public')->url($post->image) }}',
                        options: {
                            type: 'local',
                        },
                    }
                ],
            });

            // SELECT 2
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
                data = [];
                data = <?php echo json_encode($category_ids); ?>;
                $('.js-example-basic-multiple').val(data);
                $('.js-example-basic-multiple').trigger('change');
            });

            //CKEDITOR
            ClassicEditor
                .create(document.querySelector('#body'), {
                    ckfinder: {
                        uploadUrl: '{{ route('admin.posts.upload', ['_token' => csrf_token()]) }}'
                    }
                })
                .catch(error => {
                    console.error(error);
                });

        </script>
    @endpush
</x-admin-layout>
