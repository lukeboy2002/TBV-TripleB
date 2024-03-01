<div>
    <x-slot name="header">
        All Albums
    </x-slot>

    <div class="flex justify-between items-center space-x-4 pb-4 pt-2">
        <div class="flex items-center">
            <x-search/>
        </div>
        <div class="flex items-center">
            @can('create:album')
                <x-links.btn-primary href="{{ route('admin.albums.create') }}" class="px-3 py-2 text-xs font-medium">Create Album</x-links.btn-primary>
            @endcan
        </div>
    </div>
    @if (!$albums->isEmpty())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">

                    </th>
                    @include('livewire.table.sortable-th',[
                        'name' => 'title',
                         'displayName' => 'Album Title'
                    ])
                    <th scope="col" class="px-6 py-3"></th>
                    <th scope="col" class="px-6 py-3">Owner</th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($albums as $album)
                    <tr wire:key="{{$album->id}}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="{{ asset('storage/'.$album->image) }}" class="h-12 w-auto" alt="{{ $album->title }}">
                        </th>
                        <td class="px-6 py-4 flex items-center space-x-2">
                            {{ ucfirst($album->title) }}
                            @can('upload:album-image')
                                <a href="{{ route('admin.albums.show' , $album) }}" class="px-2.5 py-2.5 text-xs font-medium">( <i class="fa-solid fa-photo-film mr-2"></i>add and delete album images )</a>
                            @endcan
                        </td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4">{{ $album->user->username }}</td>
                        <td class="py-4 text-right">
                            <div class="flex justify-end space-x-2">
                                @can('update', $album)
                                    <x-links.btn-primary href="{{ route('admin.albums.edit' , $album) }}" class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-pen-to-square"></i></x-links.btn-primary>
                                @endcan
                                @can('delete', $album)
                                    <x-buttons.danger class="px-3 py-2.5 text-xs font-medium" wire:click="delete( {{ $album->id }})" wire:loading.attr="disabled"><i class="fa-solid fa-trash-can"></i></x-buttons.danger>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="py-4 px-3">
            <x-items-per-page />
        </div>
        <div class="px-4 py-4">
            {{ $albums->links() }}
        </div>
    @else
        <div class="flex flex-col justify-center items-center h-40 space-y-4">
            <div class="text-orange-500"><i class="fa-regular fa-circle-xmark fa-2xl"></i></div>
            <p class="text-xl font-bold tracking-tight text-gray-700 dark:text-white">No records found</p>
        </div>
    @endif

    <!-- Delete Album Confirmation Modal -->
    <x-modals.dialog wire:model.live="confirmingDeletion">
        <x-slot name="title">
            Delete Album
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this album?
        </x-slot>

        <x-slot name="footer">
            <x-buttons.secondary class="px-3 py-2 text-xs font-medium" wire:click="$set('confirmingDeletion', false)" wire:loading.attr="disabled">
                Cancel
            </x-buttons.secondary>

            <x-buttons.danger class="px-3 py-2 text-xs font-medium" wire:click="deleteAlbum( {{ $confirmingDeletion }} )" wire:loading.attr="disabled">
                Delete Album
            </x-buttons.danger>
        </x-slot>
    </x-modals.dialog>
</div>
