<div>
    <x-slot name="header">
        All Blogposts
    </x-slot>

    <div class="flex justify-between items-center space-x-4 pb-4 pt-2">
        <div class="flex items-center">
            <x-search/>
        </div>
        <div class="flex items-center">
            @can('create:post')
                <x-links.btn-primary href="{{ route('admin.posts.create') }}" class="px-3 py-2 text-xs font-medium">Create post</x-links.btn-primary>
            @endcan
        </div>
    </div>

    @if (!$posts->isEmpty())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Featured image
                    </th>
                    @include('livewire.table.sortable-th',[
                        'name' => 'title',
                         'displayName' => 'Title'
                    ])
                    @include('livewire.table.sortable-th',[
                         'name' => 'user_id',
                          'displayName' => 'By'
                     ])
                    @include('livewire.table.sortable-th',[
                         'name' => 'featured',
                          'displayName' => 'Featured'
                     ])
                    @include('livewire.table.sortable-th',[
                         'name' => 'published_at',
                          'displayName' => 'publish after'
                     ])
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr wire:key="{{$post->id}}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="{{$post->getImage()}}" class="h-12 w-auto" alt="{{ $post->title }}">
                        </th>
                        <td class="px-6 py-4">
                            {{ ucfirst($post->title) }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($post->author !== NULL)
                                {{$post->author->username}}
                            @else
                                User is deleted
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if( $post->featured =='1' )
                                <i class="fa-regular fa-circle-check text-green-600 fa-xl"></i>
                            @else
                                <i class="fa-regular fa-circle-xmark text-red-700 fa-xl"></i>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($post->published_at)
                                {{ $post->getFormattedDate() }}
                            @else
                                <p>not available</p>
                            @endif
                        </td>
                        <td class="text-right mr-4 space-x-2">
                            @if ($post->trashed())
                                <div class="flex space-x-2">
                                    @can('force-delete:post')
                                        <x-links.btn-primary href="{{ route('admin.posts.trashed.restore' , $post->id) }}" class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-trash-arrow-up"></i></x-links.btn-primary>
                                        <x-buttons.danger class="px-2.5 py-2.5 text-xs font-medium" wire:click="forceDelete( {{ $post->id }})" wire:loading.attr="disabled">
                                            <i class="fa-solid fa-eraser"></i>
                                        </x-buttons.danger>
                                    @endcan
                                    @hasrole('member')
                                    <span class="px-2.5 py-2.5 text-xs font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">Deleted</span>
                                    @endhasrole
                                </div>
                            @else
                                <div class="flex space-x-2">
                                    @can('view', $post)
                                        <x-links.btn-primary
                                            href="{{ route('admin.posts.show' , $post) }}"
                                            class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-eye"></i>
                                        </x-links.btn-primary>
                                    @endcan
                                    @can('update', $post)
                                        <x-links.btn-primary
                                            href="{{ route('admin.posts.edit' , $post) }}"
                                            class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-pen-to-square"></i>
                                        </x-links.btn-primary>
                                    @endcan
                                    @can('delete', $post)
                                        <x-buttons.danger class="px-3 py-2.5 text-xs font-medium" wire:click="delete( {{ $post->id }})" wire:loading.attr="disabled">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </x-buttons.danger>
                                    @endcan
                                </div>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="py-4 px-3">
            <x-items-per-page/>
        </div>
        <div class="px-4 py-4">
            {{ $posts->links() }}
        </div>
    @else
        <div class="flex flex-col justify-center items-center h-40 space-y-4">
            <div class="text-orange-500"><i class="fa-regular fa-circle-xmark fa-2xl"></i></div>
            <p class="text-xl font-bold tracking-tight text-gray-700 dark:text-white">No records found</p>
        </div>
    @endif
    <!-- Delete Post Confirmation Modal -->
    <x-modals.dialog wire:model.live="confirmingDeletion">
        <x-slot name="title">
            Delete Post
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this post?
        </x-slot>

        <x-slot name="footer">
            <x-buttons.secondary class="px-3 py-2 text-xs font-medium" wire:click="$set('confirmingDeletion', false)" wire:loading.attr="disabled">
                Cancel
            </x-buttons.secondary>

            <x-buttons.danger class="px-3 py-2 text-xs font-medium" wire:click="deletePost( {{ $confirmingDeletion }} )" wire:loading.attr="disabled">
                Delete Post
            </x-buttons.danger>
        </x-slot>
    </x-modals.dialog>

    <x-modals.dialog wire:model.live="confirmingForceDeletion">
        <x-slot name="title">
            Delete Post
        </x-slot>

        <x-slot name="content">

            <div class="flex space-x-3 items-center pb-4 text-md ">
                <x-icons name="error" class="text-sm text-red-700" />
                <p>All information will be deleted</p>
            </div>
            Are you sure you want to delete this post?
        </x-slot>

        <x-slot name="footer">
            <x-buttons.secondary class="px-3 py-2 text-xs font-medium" wire:click="$set('confirmingForceDeletion', false)" wire:loading.attr="disabled">
                Cancel
            </x-buttons.secondary>

            <x-buttons.danger class="px-3 py-2 text-xs font-medium" wire:click="ForceDeletePost( {{ $confirmingForceDeletion }} )" wire:loading.attr="disabled">
                Delete Post
            </x-buttons.danger>
        </x-slot>
    </x-modals.dialog>

</div>
