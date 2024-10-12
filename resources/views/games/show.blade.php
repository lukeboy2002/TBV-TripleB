<x-app-layout>
    <x-slot name="hero">
        <img src="{{ asset("storage/assets/newgame.png") }}"
             alt="Background Image"
             class="absolute inset-0 w-full h-124 object-cover object-bottom"
        />
        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <h3 class="text-orange-500 font-heading font-semibold tracking-wide text-xl md:text-2xl uppercase">
                Game Details {{ $game->id }} - {{ $game->getFormattedDate() }}
            </h3>
            <h1 class="text-5xl font-heading font-black tracking-wider uppercase text-white">
                TBV-TripleB
            </h1>
        </div>
    </x-slot>

    <div class="sm:flex justify-between gap-4">
        <x-card class="w-full sm:w-2/3">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Points
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($game->user_scores as $score)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ucfirst($score->username) }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $score->points }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-card>
        <x-card class="w-full sm:w-1/3 mt-4 sm:mt-0 space-y-6">
            <div>
                <x-heading>Game Winner <i class="ri-medal-line"></i></x-heading>
                <p>
                    @if($game->game_winner)
                        {{ ucfirst($game->game_winner->username) }}
                    @else
                        No winner yet
                    @endif
                </p>
            </div>
            <div>
                <x-heading>Cup Winner <i class="ri-award-line"></i></x-heading>
                <p>
                    @if($game->cup_winner)
                        {{ ucfirst($game->cup_winner->username) }}
                    @else
                        No cup winner yet
                    @endif
                </p>
            </div>
        </x-card>
    </div>
    <x-slot name="side">
        <x-scorelist/>
    </x-slot>
</x-app-layout>