<x-app-layout title="Edit Post">
    <x-tbv-heading_h1>{{ $post->title }}</x-tbv-heading_h1>

    <main>

        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8 bg-background/80 rounded-lg">
            <form action="{{ route('admin.post.update', $post) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mx-auto grid max-w-2xl grid-cols-1 grid-rows-1 items-start gap-x-8 gap-y-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                    <div class="lg:col-start-3 lg:row-end-1 hidden lg:block space-y-4">
                        <div class="rounded-lg bg-background-accent shadow-xs ring-1 ring-ring/30 p-2">
                            <x-tbv-heading_h5>Featured Image</x-tbv-heading_h5>
                            <div class="relative group">
                                @if($post->image)
                                    <img src="{{ asset($post->image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-48 object-cover rounded-lg"
                                    />
                                @endif

                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <label for="image"
                                           class="cursor-pointer bg-background/80 text-primary hover:bg-secondary hover:text-white px-4 py-2 rounded-lg">
                                        <span>change</span>
                                        <input type="file"
                                               id="image"
                                               name="image"
                                               class="hidden"
                                               accept="image/*"
                                               onchange="previewImage(event)"
                                        />
                                    </label>
                                </div>
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
                                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="rounded-lg bg-background-accent shadow-xs ring-1 ring-ring/30 p-2">
                            <x-tbv-heading_h5>Tags</x-tbv-heading_h5>
                            <livewire:tag-manager :model="$post"/>
                        </div>
                    </div>

                    <div class="p-4 shadow-xs ring-1 ring-ring/30 rounded-lg lg:col-span-2 lg:row-span-2 lg:row-end-2">
                        <div>
                            <x-tbv-label for="title" value="{{ __('Title') }}"/>
                            <x-tbv-input id="title" class="block mt-1 w-full" type="text" name="title"
                                         value="{{ old('name', $post->title) }}"
                                         required autofocus autocomplete="title"/>
                        </div>

                        <div class="mt-4">
                            <x-tbv-label for="body" value="{{ __('Content') }}"/>
                            <textarea id="body" name="body"
                                      placeholder="Write your post here...">{{ $post->body }}</textarea>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <div>
                                <label class="inline-flex items-center me-5 cursor-pointer">
                                    <input name="featured"
                                           id="featured"
                                           value="1" {{ ($post->featured == 1 ? ' checked' : '') }}
                                           aria-describedby="featured"
                                           type="checkbox"
                                           class="sr-only peer"
                                    >
                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500 dark:peer-checked:bg-orange-500"></div>
                                    <span class="ms-3 text-sm font-medium text-primary">Featured Post</span>
                                </label>
                            </div>
                            <div class="flex gap-2">
                                <x-tbv-button type="submit">Save</x-tbv-button>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-start-3">
                        <!-- FREE SPACE FOR EXTRA INFO -->
                        <div class="rounded-lg bg-background-accent shadow-xs ring-1 ring-ring/30 text-sm space-y-4 p-2">
                            <x-tbv-heading_h5>Post Info</x-tbv-heading_h5>
                            <div class="flex gap-2">
                                <div>Post by:</div>
                                {{ $post->author->username }}
                            </div>
                            <div class="flex gap-2">
                                <div>Created at:</div>
                                {{ $post->created_at->format('j F Y')}}
                            </div>
                            <div class="flex gap-2">
                                <div>Updated at:</div>
                                {{ $post->updated_at->format('j F Y')}}
                            </div>
                            <div class="flex gap-2">
                                <div>Published at:</div>
                                {{ $post->getFormattedDate() }}
                            </div>
                            <div class="flex gap-2">
                                <div>Likes:</div>
                                {{ $post->likes_count }}
                            </div>
                            <div class="flex gap-2">
                                <div>Comments:</div>
                                {{ $post->comments->count() }}
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

            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        // Target the specific image container
                        const imageContainer = document.querySelector('.relative.group');
                        if (imageContainer) {
                            // Check if there's already an image
                            const existingImg = imageContainer.querySelector('img');
                            if (existingImg) {
                                // Update existing image
                                existingImg.src = e.target.result;
                            } else {
                                // Create new image if none exists
                                const newImg = document.createElement('img');
                                newImg.src = e.target.result;
                                newImg.alt = "Preview";
                                newImg.className = "w-full h-48 object-cover rounded-lg";
                                // Insert the new image at the beginning of the container
                                imageContainer.insertBefore(newImg, imageContainer.firstChild);
                            }
                        }
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>
    @endpush
</x-app-layout>
