<div>
    <div class="flex justify-end items center space-x-16 pt-8 md:pt-0">
        {{ $users->links() }}
    </div>
    @foreach($users as $user)
        <x-cards.default class="mb-8">
            <div class="sm:flex">
                <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->username }}" class="h-full sm:h-80 min-w-60 rounded-t-lg sm:rounded-t-none sm:rounded-tl-lg" >
                <div class="ml-4 w-full space-y-4 sm:space-y-6">
                    <div class="pt-6 sm:pt-0">
                        <p class="text-2xl font-black text-orange-500">{{ $user->username }}</p>
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
                            <div class="w-1/2"></div>
                            <div class="w-1/2">Played games</div>
                            <div class="w-1/2"></div>
                        </div>
                        <div class="flex justify-between">
                            <div class="w-1/2">Games won</div>
                            <div class="w-1/2"></div>
                            <div class="w-1/2">Games cup</div>
                            <div class="w-1/2"></div>
                        </div>
                    </div>

                    @if( $user->biography )
                        <div class="hidden sm:block w-full pt-4 text-gray-700 dark:text-white">
                            <p class="text-xl font-black text-orange-500">Biograpy</p>
                            <div class="pt-2 text-gray-700 dark:text-white">
                                {!! $user->biography !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </x-cards.default>
    @endforeach
    <x-slot name="side">
        {{--        <livewire:ranking />--}}
    </x-slot>
</div>
