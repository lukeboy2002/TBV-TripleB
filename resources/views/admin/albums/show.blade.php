<x-admin-layout>
    <x-slot name="header">
        Edit Album {{$album->title}}
    </x-slot>

    <x-cards.default>
        <div class="pb-6">
            <x-forms.label for="image" value="Album Image" />
            <img src="{{ asset('storage/'.$album->image) }}" class="h-44 w-auto" alt="{{ $album->title }}">
            @can('update:album')
                <a href="{{ route('admin.albums.edit' , $album) }}" class="px-2.5 py-2.5 text-xs font-medium">( <i class="fa-solid fa-image mr-2"></i>edit Album Image )</a>
            @endcan
        </div>

        <form method="POST" action="{{ route('admin.albums.upload', $album->id) }}" enctype="multipart/form-data">
            @csrf
            <div>
                <x-forms.label for="image" value="Image" />
                <x-forms.input type="file" id="image" name="image" />
                <x-forms.input-error for="title" class="mt-2" />
            </div>
            <div class="sm:col-span-6 pt-5">
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Upload</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>

    <div class="mt-4">
        <div class="grid grid-cols-5 gap-4">
            @foreach ($photos as $photo)
                <div>
                    <img class="h-full max-w-full rounded-lg object-cover" src="{{ $photo->getUrl('thumbnail') }}" alt="">
                    <div class="flex justify-end mt-2">
                        <form method="POST" action="{{ route('admin.albums.image.destroy', [$album->id, $photo->id]) }}">
                            @csrf
                            @method('DELETE')
                            <x-buttons.danger class="px-3 py-2 text-xs font-medium">Delete</x-buttons.danger>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-admin-layout>