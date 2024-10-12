<div>
    <x-heading>Scorelist</x-heading>
    <div class="relative overflow-x-auto">
        <table class="w-full text-left rtl:text-right text-gray-500">
            <thead class="text-gray-700 uppercase bg-gray-50 text-xs">
            <tr>
                <th scope="col" class="px-4 py-3">Username</th>
                <th scope="col" class="px-4 py-3">G</th>
                <th scope="col" class="px-4 py-3">P</th>
                <th scope="col" class="px-4 py-3">W</th>
                <th scope="col" class="px-4 py-3">C</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scoreList as $score)
                <tr class="bg-white border-b text-xs">
                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $score->username }}
                    </th>
                    <td class="px-4 py-2">
                        {{ $score->total_games_played }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $score->total_points }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $score->total_wins }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $score->total_cups }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @hasanyrole('admin|member')
    <div class="flex justify-end mt-4">
        <x-link-button-primary href="{{ route('games.create') }}">new game</x-link-button-primary>
    </div>
    @endhasrole
</div>