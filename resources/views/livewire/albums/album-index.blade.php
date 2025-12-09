<div class="mb-6">
    @can('create:album')
        <div class="flex justify-end space-x-2 pb-4">
            <x-link.button href="{{ route('album.create') }}">{{ __('New Album') }}</x-link.button>
        </div>
    @endcan
    @if ($this->albums->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($this->albums as $album)

                <div class="p-3 rounded-lg shadow-md bg-background-hover/20">
                    <div class="relative">
                        <a href="{{ route('albums.show', $album) }}">
                            <!-- Afbeelding -->

                            <img src="{{ asset('storage/' .$album->image_path) }}"
                                 alt="{{ $album->title }}"
                                 class="w-full h-80 md:h-56 object-cover rounded-lg shadow">

                            <!-- Titel linksboven -->
                            <div class="absolute top-0 left-0 w-full bg-background-hover/50 text-secondary font-black px-3 py-1 rounded-t">
                                {{ ucfirst($album->title) }}
                            </div>

                            <!-- Edit/Delete rechtsonder -->
                            <div class="absolute bottom-0 right-0 flex gap-2 items-center p-1">
                                <div class="text-primary-muted text-xs">{{ __('By') }} {{ ucfirst($album->user->username) }}</div>
                                @can('update', $album)
                                    <x-link.icon icon="edit" href="{{ route('album.edit', $album->slug) }}"
                                                 class="text-edit"/>
                                @endcan
                                @can('delete', $album)
                                    <div class="flex items-center gap-2">
                                        <x-button.icon wire:click="confirmDeletion({{ $album->id }})" icon="trash"
                                                       class="text-error"/>
                                    </div>
                                @endcan
                            </div>
                        </a>
                    </div>
                </div>

            @endforeach
        </div>
        <div class="mt-8 flex justify-center">
            {{ $this->albums->links() }}
        </div>
    @else
        <x-card.default>
            <div class="text-primary-muted flex flex-col items-center gap-2">
                <x-lucide-image-off class="w-14 h-14 text-secondary"/>
                <p class="text-xl">
                    {{ __('No albums available yet.') }}</p>
            </div>
        </x-card.default>
    @endif

    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
             role="dialog"
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-background/75" aria-hidden="true"
                     wire:click="toggleModal"></div>

                <!-- Main modal -->
                <div class="flex justify-between items-center h-screen max-w-md mx-auto">
                    <div class="bg-background border border-secondary/30 relative rounded-lg shadow-sm w-full">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-secondary/30">
                            <h3 class="text-xl font-semibold text-secondary font-secondary">
                                {{ __('Delete Album') }}
                            </h3>
                            <x-button.icon type="button"
                                           class="text-secondary"
                                           icon="x"
                                           wire:click="toggleModal"
                                           data-modal-hide="authentication-modal"/>
                            <span class="sr-only">Close modal</span>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <div class="flex justify-center mb-4 text-error" aria-hidden="true">
                                <x-lucide-circle-alert class="h-12 w-12"/>
                            </div>
                            <h3 class="mb-5 text-lg font-normal text-primary-muted">
                                {{ __('Are you sure you want to delete this Album and all images') }}
                            </h3>
                            <x-button.default wire:click.prevent="deletePost" type="button">
                                {{ __('Yes') }}
                            </x-button.default>
                            <x-button.secondary wire:click="toggleModal" type="button">
                                {{ __('No') }}
                            </x-button.secondary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

