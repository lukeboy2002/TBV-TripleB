<x-app-layout>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-4">
        @foreach($albums as $album)
        <div class="relative">
            <a href="{{ route('albums.show', $album->id)}} ">
            <img class="max-h-60 max-w-full rounded-lg" src="{{ asset('storage/'.$album->image) }}" alt="{{ $album->title }}">
            <div class="absolute inset-0 text-center">
                <div class="flex flex-col h-full items-center justify-center">
                    <h5 class="bg-gray-200/80 px-6 text-2xl font-black text-orange-500 uppercase">{{ $album->title }}</h5>
                </div>
            </div>
            </a>
        </div>
        @endforeach
    </div>
</x-app-layout>


