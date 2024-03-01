<x-app-layout>
    <x-cards.default>
        <h5 class="text-center px-6 pb-4 text-3xl font-black text-orange-500 uppercase">{{ $album->title }}</h5>

        <img src="{{ $image->getUrl() }}" class="rounded-lg">
        <div class="flex justify-end pt-4">
            <x-buttons.secondary type="button" onclick="history.back()" class="px-3 py-2 text-xs font-medium">Back</x-buttons.secondary>
        </div>
    </x-cards.default>

</x-app-layout>