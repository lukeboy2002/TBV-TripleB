<x-app-layout title="Create Album">
    <x-heading.main>Create Album</x-heading.main>
    <x-card.default>
        <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="lg:flex gap-8 w-full">
                <div class="flex-row space-y-6 w-full  lg:w-3/4 px-3">
                    <div>
                        <x-form.label for="name" value="{{ __('Name') }}"/>
                        <x-form.input id="name"
                                      name="name"
                                      type="text"
                                      class="block w-full"
                                      :value="old('name')"
                                      required
                                      autofocus
                        />
                        <x-form.error for="name"/>
                    </div>
                </div>
                <aside class="w-full space-y-4 lg:w-1/4 flex-col pt-4 px-3 gap-4">
                    <div>
                        <x-heading.sub>Album Image</x-heading.sub>
                        <div class="relative group">
                            <img id="preview-image"
                                 src="{{ Storage::url('assets/placeholder.png') }}"
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
                </aside>
            </div>
            <div class="flex justify-end mt-4">
                <x-button.default>Save</x-button.default>
            </div>
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
        </script>
    @endpush
</x-app-layout>