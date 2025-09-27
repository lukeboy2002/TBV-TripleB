<div>
    <x-heading.sub>All Categories</x-heading.sub>
    <x-card.default>
        <div class="relative overflow-x-auto shadow-md rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-primary-muted border border-secondary/30">
                <thead class="text-xs text-primary bg-background-hover">
                <tr>
                    @include('livewire.components.sortable-th',[
                        'name' => 'name',
                         'displayName' => __('Name')
                    ])
                    <th scope="col" class="px-6 py-3">
                        {{ __('Total posts') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Description') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr wire:key="{{$category->id}}" class="bg-transparent border-b border-secondary/30 ">
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            <x-badge.category :color="$category->color" class="rounded-l-lg">
                                {{ $category->name }}
                            </x-badge.category>
                            
                        </td>
                        <td class="px-6 py-4">
                            {{ $category->posts_count }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $category->description }}
                        </td>
                        <td class="py-4 text-right">

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-4">
            {{ $categories->links() }}
        </div>
    </x-card.default>
</div>
