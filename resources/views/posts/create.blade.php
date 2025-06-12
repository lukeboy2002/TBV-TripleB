<x-app-layout title="Create Post">
    <x-tbv-heading_h3>New post</x-tbv-heading_h3>

    <main>

        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8 bg-background/80 rounded-lg">
            <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mx-auto grid max-w-2xl grid-cols-1 grid-rows-1 items-start gap-x-8 gap-y-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                    <div class="lg:col-start-3 lg:row-end-1 hidden lg:block space-y-4">
                        <div class="rounded-lg bg-background-accent shadow-xs ring-1 ring-ring/30 p-2">
                            <x-tbv-heading_h5>Featured Image</x-tbv-heading_h5>


                            <div class="relative group">
                                <img id="preview-image"
                                     src="{{ Storage::url('assets/placeholder.jpeg') }}"
                                     alt="Preview"
                                     class="w-full h-48 object-cover rounded-lg"
                                />
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <label for="image"
                                           class="cursor-pointer bg-background/80 text-primary hover:bg-secondary hover:text-white px-4 py-2 rounded-lg">
                                        <span>Upload image</span>
                                        <input type="file"
                                               id="image"
                                               name="image"
                                               class="hidden"
                                               accept="image/*"
                                               onchange="previewImage(event)"
                                        />
                                    </label>
                                </div>
                                <x-tbv-input-error for="image" class="mt-2"/>
                            </div>

                        </div>
                        <div class="rounded-lg bg-background-accent shadow-xs ring-1 ring-ring/30 p-2">
                            <x-tbv-heading_h5>Category</x-tbv-heading_h5>
                            <div>
                                <label for="categories"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                                    category</label>
                                <select id="category" name="category_id"
                                        class="w-full text-sm bg-input border-border text-primary focus:border-border focus:ring-border rounded-md shadow-xs">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="rounded-lg bg-background-accent shadow-xs ring-1 ring-ring/30 p-2">
                            <x-tbv-heading_h5>Publish date</x-tbv-heading_h5>
                            <div>
                                <x-tbv-input
                                        class="w-full"
                                        type="date"
                                        name="published_at"
                                        id="published_at"
                                        :value="old('published_at')"
                                />


                                <x-tbv-input-error for="published_at" class="mt-2"/>
                            </div>
                        </div>
                        {{--                        <div class="rounded-lg bg-background-accent shadow-xs ring-1 ring-ring/30 p-2">--}}
                        {{--                            <x-tbv-heading_h5>Tags</x-tbv-heading_h5>--}}
                        {{--                            <livewire:tag-manager :model="$post"/>--}}
                        {{--                        </div>--}}
                    </div>

                    <div class="p-4 shadow-xs ring-1 ring-ring/30 rounded-lg lg:col-span-2 lg:row-span-2 lg:row-end-2">
                        <div class="mt-4">
                            <x-tbv-label for="title" value="{{ __('Title') }}"/>
                            <x-tbv-input id="title" class="w-full" type="text" name="title"
                                         :value="old('title')"
                                         required autofocus autocomplete="title"/>
                            <x-tbv-input-error for="title" class="mt-2"/>
                        </div>

                        <div class="mt-4">
                            <x-tbv-label for="body" value="{{ __('Content') }}"/>
                            <textarea id="body" name="body"
                                      placeholder="Write your post here..."></textarea>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex items-center space-x-6">
                                <div>
                                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input name="featured"
                                               id="featured"
                                               value="1"
                                               aria-describedby="featured"
                                               type="checkbox"
                                               class="sr-only peer"
                                               checked
                                        >
                                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500 dark:peer-checked:bg-orange-500"></div>
                                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Featured</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <x-tbv-button type="submit">Save</x-tbv-button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

        <script>
            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('preview-image').src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            }

            //CKEDITOR
            ClassicEditor
                .create(document.querySelector('#body'), {
                    ckfinder: {
                        uploadUrl: '{{ route('admin.post.upload', ['_token' => csrf_token()]) }}'
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-app-layout>