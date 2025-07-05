<div>
    <x-tbv-heading_h3>Create Events</x-tbv-heading_h3>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-background/80">
        @if (session()->has('message'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                 role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <div class="shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form wire:submit="save">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <x-tbv-label for="name">Event Name</x-tbv-label>
                            <x-tbv-input type="text" id="name" wire:model="name"
                                         class="mt-1 block w-full"/>
                            <x-tbv-input-error for="name" class="mt-2"/>
                        </div>

                        <div>
                            <x-tbv-label for="date">Date & Time</x-tbv-label>
                            <x-tbv-input type="datetime-local" id="date" wire:model="date"
                                         class="mt-1 block w-full"/>
                            <x-tbv-input-error for="date" class="mt-2"/>
                        </div>

                        <div>
                            <x-tbv-label for="description">Description
                                (Optional)
                            </x-tbv-label>
                            <textarea id="description" wire:model="description" rows="3"
                                      class="mt-1 block w-full bg-input border-border text-primary rounded-md shadow-xs focus:border-border focus:ring-ring"></textarea>
                            <x-tbv-input-error for="description" class="mt-2"/>
                        </div>

                        <div>
                            <x-tbv-label for="image">Image (Optional)</x-tbv-label>
                            <x-tbv-input type="file" id="image" wire:model="image" class="mt-1 block w-full"/>
                            <x-tbv-input-error for="image" class="mt-2"/>

                            @if ($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" class="h-32 w-32 object-cover rounded">
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-end gap-2">
                            <x-tbv-link-btn-secondary href="{{ route('agenda.index') }}">
                                Cancel
                            </x-tbv-link-btn-secondary>
                            <x-tbv-button type="submit">
                                Create Event
                            </x-tbv-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
