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
                            {{ $post->author->username }}
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
                        <td class="py-4 text-right">
                            edit delete
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


</div>
