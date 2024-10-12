<div class="relative overflow-x-auto">
    <div class="flex justify-end pb-4">
        {{ $scoreList->links() }}
    </div>

    @foreach($scoreList as $score)
        <x-card>
            <div class="flex">
                <img src="{{ asset('storage/' . $score->image) }}" alt="{{ $score->username }}"
                     class="h-full sm:h-80 min-w-60 rounded-t-lg sm:rounded-t-none sm:rounded-tl-lg">
                <div class="ml-4 w-full space-y-4 sm:space-y-6">
                    <div class="pt-6 sm:pt-0">
                        <p class="text-2xl font-black text-orange-500">{{ ucfirst($score->username) }}</p>
                    </div>

                    <div class="w-full space-y-2 text-sm text-gray-700 dark:text-white xl:hidden">
                        <div class="flex justify-between">
                            <div class="w-1/2">Points</div>
                            <div class="w-1/2"></div>
                        </div>
                        <div class="flex justify-between">
                            <div class="w-1/2">Played games</div>
                            <div class="w-1/2"></div>
                        </div>
                        <div class="flex justify-between">
                            <div class="w-1/2">Games won</div>
                            <div class="w-1/2"></div>
                        </div>
                        <div class="flex justify-between">
                            <div class="w-1/2">Games cup</div>
                            <div class="w-1/2"></div>
                        </div>
                    </div>
                    <div class="hidden xl:block w-full space-y-2 text-sm text-gray-700 dark:text-white">
                        <div class="flex justify-between">
                            <div class="w-1/2">Points</div>
                            <div class="w-1/2">{{ $score->total_points }}</div>
                            <div class="w-1/2">Played games</div>
                            <div class="w-1/2">{{ $score->total_games_played }}</div>
                        </div>
                        <div class="flex justify-between">
                            <div class="w-1/2">Games won</div>
                            <div class="w-1/2">{{ $score->total_wins }}</div>
                            <div class="w-1/2">Games cup</div>
                            <div class="w-1/2">{{ $score->total_cups }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </x-card>
    @endforeach

</div>
