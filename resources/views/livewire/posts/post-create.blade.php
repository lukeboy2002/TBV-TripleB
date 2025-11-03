<div>
    <x-heading.main>{{ __('New Post') }}</x-heading.main>
    <form wire:submit.prevent="save">
        @csrf
        <div class="mx-auto flex max-w-7xl flex-wrap flex-col-reverse lg:flex-row">

            <main class="w-full px-3 lg:w-3/4">
                <x-card.default class="flex flex-col gap-6">

                    <div>
                        <x-form.label for="title">{{ __('Title') }}</x-form.label>
                        <x-form.input type="text" wire:model="title" class="w-full border rounded p-2"/>
                        <x-form.error for="title"/>
                    </div>

                    <div>
                        <div wire:ignore>
                            <x-tiptapeditor.editor :enable-image-upload="true">
                                <label for="editor" class="sr-only">Content</label>
                                <div id="editor"
                                     data-initial="{{ $this->body ?? '' }}"
                                     data-upload-url="{{ route('editor.uploads.images') }}"
                                     class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"></div>
                            </x-tiptapeditor.editor>
                        </div>
                        <input id="body" name="body" type="hidden" wire:model.defer="body">
                        <x-form.error for="body" class="mt-2"/>
                    </div>


                    <div class="md:flex justify-between items-center">
                        <div class="flex items-center">
                            <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                <input wire:model="is_featured"
                                       name="is_featured"
                                       id="is_featured"
                                       value="1"
                                       aria-describedby="is_featured"
                                       type="checkbox"
                                       class="sr-only peer"
                                       checked
                                >
                                <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500 dark:peer-checked:bg-orange-500"></div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Spotlight</span>
                            </label>
                        </div>
                        <div class="flex items-center gap-3 mt-3 md:mt-0">
                            <x-form.label>{{ __('Publication date') }}</x-form.label>
                            <x-form.input type="date" wire:model="published_at" class="w-full border rounded p-2 mb-2"/>
                        </div>
                    </div>

                    <div class="block w-full md:flex md:justify-end">
                        <x-button.default type="submit">{{ __('Save') }}</x-button.default>
                    </div>
                </x-card.default>
            </main>
            <aside class="pt-6 flex w-full flex-col px-3 lg:pt-0 lg:w-1/4 mb-6 lg:mb-20 gap-6">
                <x-card.side>
                    <x-slot name="header">Image</x-slot>
                    <div class="relative group" wire:ignore.self>
                        {{-- Preview image --}}
                        <img
                                alt="Preview"
                                class="w-full h-48 object-scale-down rounded-lg bg-transparent"
                                src="{{ $featured_image ? $featured_image->temporaryUrl() : asset('storage/assets/placeholder.png') }}"
                        />

                        {{-- Hover overlay with upload label --}}
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <x-form.label for="featured_image"
                                          class="cursor-pointer bg-background/80 text-primary hover:bg-secondary hover:text-white px-4 py-2 rounded-lg">
                                <span>Upload image</span>
                                <input type="file"
                                       id="featured_image"
                                       name="featured_image"
                                       class="hidden"
                                       accept="image/*"
                                       wire:model.live="featured_image"
                                />
                            </x-form.label>
                        </div>

                        {{-- Uploading state indicator (optional) --}}
                        <div class="absolute inset-0 flex items-center justify-center bg-background/90 text-white text-sm rounded-lg"
                             wire:loading.flex
                             wire:target="featured_image">
                            <div class="flex h-[20rem] md:h-[40rem] items-center justify-center">

                                <svg class="animate-spin h-12 w-12 text-secondary"
                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8v4a4 4 0 00-2.83 6.83L4 12z"></path>
                                </svg>
                            </div>
                        </div>

                        {{-- Validation error must use the Livewire property name --}}
                        <x-form.error for="featured_image" class="mt-2"/>
                    </div>
                </x-card.side>

                <x-card.side>
                    <x-slot name="header">{{ __('Category') }}</x-slot>
                    <x-form.select wire:model="category_id" class="w-full border rounded p-2">
                        <option value="">{{ __('Choose category') }}</option>
                        @foreach($allCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.error for="category_id"/>
                </x-card.side>

                <x-card.side>
                    <x-slot name="header">Tags</x-slot>
                    <x-form.input type="text" wire:model.lazy="tags" placeholder="Tags"/>
                    <small class="text-gray-500">{{ __('Add multiple tags using commas.') }}</small>
                </x-card.side>

            </aside>
        </div>
    </form>
</div>
