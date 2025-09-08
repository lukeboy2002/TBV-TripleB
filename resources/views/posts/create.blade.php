<x-app-layout title="Create Post">
    <x-slot name="header">
        <x-heading.main>Nieuwe Post</x-heading.main>
    </x-slot>
    <x-card.default>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
              class="lg:flex gap-8 w-full">
            @csrf
            <div class="flex-row space-y-6 w-full  lg:w-3/4 px-3">
                <div>
                    <x-form.label for="title" value="{{ __('Titel') }}"/>
                    <x-form.input id="title" class="w-full" type="text" name="title"
                                  :value="old('title')"
                                  required autofocus autocomplete="title"/>
                    <x-form.error for="title" class="mt-2"/>
                </div>
                <div>
                    <x-form.label for="body" value="{{ __('Beschrijving / post') }}"/>
                    <textarea id="body" name="body"
                              class="w-full text-primary-muted bg-transparent rounded-lg border-secondary/30 focus:border-secondary focus:ring-0"
                              rows="10"
                              placeholder="Write your post here..."></textarea>
                </div>
                <div class="flex justify-between">
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
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Spotlight</span>
                            </label>
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        <x-button.default>Save</x-button.default>
                    </div>
                </div>
            </div>

            <aside class="w-full space-y-4 lg:w-1/4 flex-col pt-4 px-3 gap-4">
                <div>
                    <x-heading.sub>Post Afbeelding</x-heading.sub>
                    <div class="relative group">
                        <img id="preview-image"
                             src="{{ asset('storage/assets/placeholder.png') }}"
                             alt="Preview"
                             class="w-full h-48 object-scale-down rounded-lg bg-transparent"
                        />
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <x-form.label for="image"
                                          class="cursor-pointer bg-background/80 text-primary hover:bg-secondary hover:text-white px-4 py-2 rounded-lg">
                                <span>Upload image</span>
                                <input type="file"
                                       id="image"
                                       name="image"
                                       class="hidden"
                                       accept="image/*"
                                       onchange="previewImage(event)"
                                />
                            </x-form.label>
                        </div>
                        <x-form.error for="image" class="mt-2"/>
                    </div>
                </div>

                <div>
                    <x-heading.sub>Categorie</x-heading.sub>
                    <x-form.select id="category" name="category_id"
                                   class="w-full text-sm bg-input border-border text-primary focus:border-border focus:ring-border rounded-md shadow-xs">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-form.select>
                </div>
                <div>
                    <x-heading.sub>Publicatiedatum</x-heading.sub>
                    <x-form.input
                            class="w-full"
                            type="date"
                            name="published_at"
                            id="published_at"
                            :value="old('published_at', now()->toDateString())"
                    />
                    <x-form.error for="published_at" class="mt-2"/>
                </div>

                <div class="lg:hidden flex justify-end">
                    <x-button.default>Save</x-button.default>
                </div>
            </aside>
        </form>
    </x-card.default>
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
                        uploadUrl: '{{ route('post.upload', ['_token' => csrf_token()]) }}'
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-app-layout>