<x-app-layout title="Album">
    <x-tbv-heading_h3>{{ $album->name }}</x-tbv-heading_h3>

    @can('addImage', $album)
        <div class="mx-auto flex w-full max-w-7xl flex-wrap py-4 bg-background/80 rounded-lg p-4">
            <form method="POST" action="{{ route('admin.albums.upload', $album->slug) }}" enctype="multipart/form-data">
                @csrf
                <div class="sm:col-span-6">
                    <x-tbv-label for="title"> Album Image</x-tbv-label>
                    <div class="mt-1">
                        <x-tbv-input type="file" id="image" name="image"/>
                    </div>
                    <x-tbv-input-error for="image" class="mt-2"/>
                </div>
                <div class="sm:col-span-6 pt-5">
                    <x-tbv-button>
                        <x-lucide-image-plus class="h-4 w-4 mr-2"/>
                        Upload
                    </x-tbv-button>
                </div>
            </form>
        </div>
    @endcan

    <div class="mx-auto flex w-full flex-wrap py-4 bg-background/80 rounded-lg p-4 mt-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-8">
            @forelse ($photos as $photo)
                <x-tbv-photo_card>
                    <a href="{{ route('album.image.show', [$album->slug, $photo->id] ) }}"
                       class="block overflow-hidden">
                        <img class="rounded-lg w-48 h-48 object-cover"
                             src="{{ $photo->getUrl('thumb') }}"
                             alt=""/>
                    </a>
                    <livewire:delete-image :album="$album" :imageId="$photo->id"/>

                </x-tbv-photo_card>
            @empty
                <p class="text-lg text-secondary font-bold flex gap-3 items-center">
                    <x-lucide-image-off class="h-5 w-5"/>
                    No Photos yet
                </p>
            @endforelse
        </div>
    </div>
    <x-slot name="side">
        Albums
    </x-slot>
</x-app-layout>
