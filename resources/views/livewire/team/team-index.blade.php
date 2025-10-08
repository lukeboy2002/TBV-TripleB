<div class="mx-auto flex max-w-7xl flex-wrap">
    <div wire:loading
         class="rounded-lg absolute inset-0 flex items-center justify-center bg-background/90 z-10">
        <div class="flex h-[20rem] md:h-[40rem] items-center justify-center">

            <svg class="animate-spin h-12 w-12 text-secondary"
                 xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v4a4 4 0 00-2.83 6.83L4 12z"></path>
            </svg>
        </div>
    </div>
    @foreach($this->users as $user)
        <main class="flex w-full flex-col px-3 lg:w-3/4 mb-6 lg:mb-0">
            <x-heading.main>{{ __('Team') }}</x-heading.main>

            {{--            <div class="md:flex gap-4">--}}
            <x-card.default class="md:flex gap-4 w-full">
                <div class="w-full md:w-1/2">
                    <img class="rounded-lg w-full h-[20rem] md:h-[40rem] object-cover"
                         src="{{ asset('storage/'. $user->profile->image_path) }}"
                         alt="{{ $user->username }}"/>
                </div>

                <div class="w-full md:w-1/2">
                    <div class="text-2xl font-secondary font-bold text-secondary flex justify-between">
                        <div>{{ ucfirst($user->username) }}</div>
                        <div>{{ $this->users->links() }}</div>
                    </div>
                    <div class="mt-4 prose prose-orange dark:prose-invert text-primary">{!! $user->profile->biography !!}</div>
                </div>

            </x-card.default>
        </main>
        <aside class="md:flex lg:flex-col flex-row w-full px-3 pt-0 md:full lg:w-1/4 gap-6">
            <x-card.side class="mb-6 md:mb-0">
                <x-slot name="header">{{ __("Player Info") }}</x-slot>
                <table class="w-full text-sm text-left rtl:text-right">
                    <tbody>
                    <tr class="text-primary-muted font-medium">
                        <th scope="row" class="py-4">
                            {{ __('Name') }}
                        </th>
                        <td class="py-4 text-primary">
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr class="text-primary-muted font-medium">
                        <th scope="row" class="py-4">
                            {{ __('City') }}
                        </th>
                        <td class="py-4 text-primary">
                            {{ $user->profile->city }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                @auth
                    @if(auth()->id() === $user->id)
                        <x-slot name="footer">

                            <div class="flex justify-end">
                                <x-link.default href="{{ route('profile.show') }}" icon="square-pen">
                                    {{ __('Edit Profile') }}
                                </x-link.default>
                            </div>

                        </x-slot>
                    @endif
                @endauth
            </x-card.side>
            <x-card.side>
                <x-slot name="header">{{ __("Player Stats") }}</x-slot>
                <table class="w-full text-sm text-left rtl:text-right">
                    <tbody>
                    <tr class="text-primary-muted font-medium">
                        <th scope="row" class="py-4">
                            {{ __('Points') }}
                        </th>
                        <td class="py-4 text-primary">
                            {{--                            {{ $user->total_points }}--}}
                        </td>
                    </tr>
                    <tr class="text-primary-muted font-medium">
                        <th scope="row" class="py-4">
                            {{ __('Matches played') }}
                        </th>
                        <td class="py-4 text-primary">
                            {{--                            {{ $user->total_games_played }}--}}
                        </td>
                    </tr>
                    <tr class="text-primary-muted font-medium">
                        <th scope="row" class="py-4">
                            {{ __('Matches won') }}
                        </th>
                        <td class="py-4 text-primary">
                            {{--                            {{ $user->total_games_won }}--}}
                        </td>
                    </tr>
                    <tr class="text-primary-muted font-medium">
                        <th scope="row" class="py-4">
                            {{ __('Cups won') }}
                        </th>
                        <td class="py-4 text-primary">
                            {{--                            {{ $user->total_cups_won }}--}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </x-card.side>
        </aside>
    @endforeach
</div>