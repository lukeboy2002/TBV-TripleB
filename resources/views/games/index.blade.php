<x-app-layout>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($games as $game)
            <div class="flex flex-col rounded-md border border-gray-200">
                <div class="flex w-full items-center justify-between space-x-6 p-4">
                    {{ $game->getFormattedDate() }}
                    <i class="ri-gamepad-line text-3xl text-gray-500"></i>
                </div>
                <div class="px-4 pb-2">
                    @foreach($game->users as $user)
                        {{ ucfirst($user->username) }},
                    @endforeach
                </div>
                <div class="mt-auto bg-gray-50 border-t border-gray-200">
                    <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="flex w-0 flex-1">
                            <div class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                <i class="ri-medal-line text-2xl text-gray-400"></i>
                                {{ ucfirst($game->winner->username) }}
                            </div>
                        </div>
                        <div class="-ml-px flex w-0 flex-1">
                            <div class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                @if($game->cupWinner)
                                    <i class="ri-award-line text-2xl text-gray-400"></i>
                                    {{ ucfirst($game->cupWinner->username) }}
                                @else
                                    <i class="ri-award-line text-2xl text-gray-400"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="flex flex-col justify-center items-center h-40 space-y-4">
                <div class="text-orange-500"><i class="ri-close-circle-line text-5xl"></i></div>
                <p class="text-xl font-bold tracking-tight text-gray-700">No records found</p>
            </div>
        @endforelse
    </div>
    <div class="flex justify-end pt-4">
        <x-link-button-primary href="{{ route('games.create') }}">Create game</x-link-button-primary>
    </div>
    <x-slot name="side">
        <x-latest-cupholder/>
    </x-slot>
</x-app-layout>