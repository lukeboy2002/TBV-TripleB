<x-app-layout>
    EDIT GAME
    {{ $game->getFormattedDate() }}

    <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
        <div>
            <x-label for="image" :value="__('Image')"/>
            <input id="image" class="block mt-1 w-full" type="file" name="image"/>
        </div>
        <div class="flex justify-end mt-4">
            <x-button-primary type="submit" class="btn btn-primary">Submit Result</x-button-primary>
        </div>
    </form>

</x-app-layout>