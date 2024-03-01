<x-app-layout>
    <x-slot name="header">
        <div class="relative w-full">
            <img src="{{ asset($album->image )}}" class="block w-full h-96 object-center object-cover" alt="$slide->title"/>
            <div class="absolute inset-0 h-full text-center">
                <div class="flex flex-col h-full items-center justify-center">
                    <h5 class="bg-gray-200/80 px-6 py-2 text-3xl font-black text-orange-500 uppercase">{{ $album->title }}</h5>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mt-4 mx-auto flex justify-end items-center space-x-2 mr-2">
            <div class="flex justify-end items-center space-x-2">
            @can('update', $album)
                <x-links.btn-secondary href="{{ route('admin.albums.show' , $album) }}" class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-photo-film mr-2"></i>edit</x-links.btn-secondary>
            @endcan
            </div>
        </div>
    </x-slot>
    <div class="pt-6 grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-4">
        @foreach ($photos as $photo)
            <div class="p-2">
                <a href="{{ route('albums.image', [$album->id, $photo->id]) }}" class="block h-56 overflow-hidden">
                    <img alt="gallery" class="object-cover object-center w-full h-full block rounded-lg" src="{{ $photo->getUrl('thumbnail') }}">
                </a>
            </div>
      @endforeach
    </div>

</x-app-layout>