<x-app-layout>
    @push('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet"/>
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
              rel="stylesheet"/>
    @endpush

    <x-slot name="hero">
        <img src="{{ asset("storage/assets/newgame.png") }}"
             alt="Background Image"
             class="absolute inset-0 w-full h-124 object-cover object-bottom"
        />
        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <h3 class="text-orange-500 font-heading font-semibold tracking-wide text-xl md:text-2xl uppercase">
                Game {{$game->id}} - {{ $game->getFormattedDate() }}
            </h3>
            <h1 class="text-5xl font-heading font-black tracking-wider uppercase text-white">
                TBV-TripleB
            </h1>
        </div>
    </x-slot>

    <x-card>
        <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Username
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Points
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Winner
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    CUP
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($game->users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ ucfirst($user->username) }}
                                    </th>
                                    <td class="px-6 py-4">
                                        <input type="hidden" name="users[]" value="{{ $user->id }}">
                                        <input type="number" name="points[{{ $user->id }}]"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                               placeholder="points for {{ $user->username }}" required>
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="checkbox"
                                               name="winner_id"
                                               class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 focus:ring-2 "
                                               id="winner-{{ $user->id }}"
                                               value="{{ $user->id }}"
                                        >
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="checkbox"
                                               name="cup_winner_id"
                                               class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 focus:ring-2 "
                                               id="cup-winner-{{ $user->id }}"
                                               value="{{ $user->id }}"
                                        >
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <x-label for="image" value="Cup Winner"/>
                    <x-input type="file" name="image" id="image"/>
                    <x-input-error for="image" class="mt-2"/>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <x-button-primary type="submit" class="btn btn-primary">Submit Result</x-button-primary>
            </div>
        </form>
    </x-card>
    @push('scripts')
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);

            const inputElement = document.querySelector('#image');

            const pond = FilePond.create(inputElement, {
                acceptedFileTypes: ['image/*'],
                server: {
                    process: '{{ route('filepond.upload') }}',
                    revert: '{{ route('filepond.revert') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>