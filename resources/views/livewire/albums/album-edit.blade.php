<div>
    <x-heading.main>{{ __('Edit Album') }}</x-heading.main>
    <form wire:submit.prevent="update">
        <div class="mx-auto flex max-w-7xl flex-wrap flex-col-reverse lg:flex-row">
            <main class="w-full px-3 lg:w-3/4">
                <x-card.default class="flex flex-col gap-6">

                    {{-- Existing photos in this album --}}
                    <div>
                        <x-heading.sub>{{ __('Existing Photos') }}</x-heading.sub>
                        @php($existing = $this->album->getMedia('albums'))
                        @if($existing->count())
                            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($existing as $media)
                                    <img class="rounded border object-cover w-full h-32"
                                         src="{{ $media->getUrl('thumbnail') }}"
                                         alt="photo">
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500 mt-2">{{ __('No photos in this album yet.') }}</p>
                        @endif
                    </div>
                    @can('update', $album)
                        <div>
                            <x-form.label>{{ __('Title') }}</x-form.label>
                            <x-form.input type="text" wire:model="title" class="w-full border rounded p-2"/>
                            <x-form.error for="title"/>
                        </div>

                        <div>
                            <div wire:ignore>
                                <x-tiptapeditor.editor :enable-image-upload="false">
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
                    @endcan

                    @can('upload:image')
                        <div class="mt-6">
                            <x-heading.sub>{{ __('Add Images') }}</x-heading.sub>
                            <x-card.default>
                                <x-form.input
                                        type="file"
                                        wire:model="uploads"
                                        multiple
                                        accept="image/*"
                                        class="mt-2 block w-full text-sm"
                                />
                                <x-form.error for="uploads" class="mt-2"/>
                                <x-form.error for="uploads.*" class="mt-2"/>

                                <div class="mt-3" wire:loading wire:target="uploads">
                                    <x-badge.default>{{ __('Uploading...') }}</x-badge.default>
                                </div>

                                @if($uploads)
                                    <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                        @foreach($uploads as $upload)
                                            <img class="rounded border object-cover w-full h-32"
                                                 src="{{ $upload->temporaryUrl() }}" alt="preview">
                                        @endforeach
                                    </div>
                                @endif
                            </x-card.default>
                        </div>
                    @endcan

                    <div class="block w-full md:flex md:justify-end">
                        <x-button.default type="submit">{{ __('Save') }}</x-button.default>
                    </div>

                </x-card.default>
            </main>
            <aside class="pt-6 flex w-full flex-col px-3 lg:pt-0 lg:w-1/4 mb-6 lg:mb-20 gap-6">
                <x-card.side>
                    <x-slot name="header">Image</x-slot>

                    <div class="relative group" wire:ignore.self>
                        {{-- Preview image: new upload > existing stored image > placeholder --}}
                        <img
                                alt="Preview"
                                class="w-full h-48 object-scale-down rounded-lg bg-transparent"
                                src="{{
                                    $new_image_path
                                        ? $new_image_path->temporaryUrl()
                                        : ($image_path
                                            ? Storage::url($image_path)
                                            : asset('storage/assets/placeholder.png'))
                                }}"
                        />

                        {{-- Hover overlay with upload label --}}
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <x-form.label for="new_image_path"
                                          class="cursor-pointer bg-background/80 text-primary hover:bg-secondary hover:text-white px-4 py-2 rounded-lg">
                                <span>Upload image</span>
                                <input type="file"
                                       id="new_image_path"
                                       name="new_image_path"
                                       class="hidden"
                                       accept="image/*"
                                       wire:model.live="new_image_path"
                                />
                            </x-form.label>
                        </div>

                        {{-- Uploading state indicator --}}
                        <div class="absolute inset-0 flex items-center justify-center bg-background/90 text-white text-sm rounded-lg"
                             wire:loading.flex
                             wire:target="new_image_path">
                            <div class="flex h-[20rem] md:h-[40rem] items-center justify-center">
                                <svg class="animate-spin h-12 w-12 text-secondary" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8v4a4 4 0 00-2.83 6.83L4 12z"></path>
                                </svg>
                            </div>
                        </div>

                        {{-- Validation error must use the Livewire property name --}}
                        <x-form.error for="new_image_path" class="mt-2"/>
                    </div>
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
