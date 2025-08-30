<x-app-layout title="Create Event">
    <x-slot name="header">
        <x-heading.main>Nieuw agenda Item</x-heading.main>
    </x-slot>
    <x-card.default>
        <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="lg:flex gap-8 w-full">
                <div class="flex-row space-y-6 w-full  lg:w-3/4 px-3">
                    <div>
                        <x-form.label for="name" value="{{ __('Titel') }}"/>
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
                    <div>
                        <x-form.label for="date" value="{{ __('Startdatum en tijd') }}"/>
                        <x-form.input id="date"
                                      name="date"
                                      type="datetime-local"
                                      class="block w-full"
                                      :value="old('date')"
                                      required
                                      autofocus
                        />
                        <p class="text-xs text-primary-muted mt-1">Kies een begindatum. Voor een meerdaags event vul ook een einddatum in.</p>
                        <x-form.error for="date"/>
                    </div>
                    <div>
                        <x-form.label for="end_date" value="{{ __('Einddatum en tijd (optioneel)') }}"/>
                        <x-form.input id="end_date"
                                      name="end_date"
                                      type="datetime-local"
                                      class="block w-full"
                                      :value="old('end_date')"
                        />
                        <x-form.error for="end_date"/>
                    </div>
                    <div>
                        <x-form.label for="description" value="{{ __('Beschrijving') }}"/>
                        <textarea id="description" name="description"
                                  class="w-full text-primary-muted bg-transparent rounded-lg border-secondary/30 focus:border-secondary focus:ring-0"
                                  rows="10"
                                  placeholder="Event..."></textarea>
                    </div>

                    <div>
                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                            <input name="private"
                                   id="private"
                                   value="1"
                                   aria-describedby="private"
                                   type="checkbox"
                                   class="sr-only peer"
                                   checked
                            >
                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500 dark:peer-checked:bg-orange-500"></div>
                            <span class="ml-3 text-sm font-medium text-primary">Prive <span class="text-xs italic">(alleen teamleden)</span></span>
                        </label>
                    </div>
                </div>
                <aside class="w-full space-y-4 lg:w-1/4 flex-col pt-4 px-3 gap-4">
                    <div>
                        <x-heading.sub>Afbeelding</x-heading.sub>
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

            //CKEDITOR
            ClassicEditor
                .create(document.querySelector('#description'), {
                    ckfinder: {
                        uploadUrl: '{{ route('agenda.upload', ['_token' => csrf_token()]) }}'
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-app-layout>