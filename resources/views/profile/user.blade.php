<x-app-layout title="Profile">

    <div class="mx-auto max-w-7xl bg-background/80 rounded-lg relative pb-4">
        <header>
            <div class="w-full h-[250px]">
                @if($user->profile && $user->profile->cover_path)
                    <img src="{{ Storage::url($user->profile->cover_path) }}"
                         alt="cover"
                         class="w-full h-full rounded-t-lg object-cover">
                @else
                    <img src="{{asset('storage/covers/default.png')}}"
                         alt="cover"
                         class="w-full h-full rounded-t-lg object-cover">
                @endif
            </div>
            <div class="flex flex-col items-center -mt-20">
                <img src="{{ $user->profile_photo_url }}"
                     alt="profile"
                     class="w-32 border-4 border-border rounded-full">
                <div class="flex items-center space-x-2 mt-2">
                    <p class="text-2xl text-secondary">{{ ucfirst($user->username) }}</p>

                </div>
            </div>
            @auth
                <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
                    @can ('update', $user)
                        <x-tbv-link-btn href="{{ route('profile.show') }}">
                            <x-lucide-user-round-pen class="h-4 w-4 mr-2"/>
                            <span>Edit</span>
                        </x-tbv-link-btn>
                    @else
                        <div class="flex items-center space-x-4 mt-2">
                            @if(auth()->user()->isFollowing($user))
                                <form action="{{ route('user.unfollow', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-tbv-button type="submit" color="red">
                                        <x-lucide-user-minus class="h-4 w-4 mr-2"/>
                                        <span>Unfollow</span>
                                    </x-tbv-button>
                                </form>
                            @else
                                <form action="{{ route('user.follow', $user) }}" method="POST">
                                    @csrf
                                    <x-tbv-button type="submit">
                                        <x-lucide-user-plus class="h-4 w-4 mr-2"/>
                                        <span>Follow</span>
                                    </x-tbv-button>
                                </form>
                            @endif
                            <x-tbv-button_secondary>
                                <x-lucide-message-square-more class="h-4 w-4 mr-2"/>
                                <span>Message</span>
                            </x-tbv-button_secondary>
                        </div>
                    @endcan
                </div>
            @endauth
        </header>
        <main class="mx-auto flex max-w-7xl flex-wrap py-4 bg-background/80 rounded-lg">
            <div class="w-full md:w-3/4 px-3 py-4">
                <section>
                    <x-tbv-heading_h5>Personal Info</x-tbv-heading_h5>
                    <div class="flex gap-2">
                        <ul class="mt-2 text-primary-muted w-1/2">
                            <li class="flex border-y border-border/30 py-2">
                                <span class="font-bold text-primary w-24">Full name:</span>
                                <span class="text-primary-muted">{{ $user->name }}</span>
                            </li>
                            <li class="flex border-b border-border/30 py-2">
                                <span class="font-bold text-primary w-24">Birthday:</span>
                                @if($user->profile && $user->profile->birthday)
                                    <span class="text-primary-muted">{{ $user->profile->getBirthdayDate() }}</span>
                                @else
                                    <span class="text-primary-muted">not availiable</span>
                                @endif
                            </li>
                            <li class="flex border-b border-border/30 py-2">
                                <span class="font-bold text-primary w-24">Joined:</span>
                                <span class="text-primary-muted">{{ $user->created_at->format('d M Y') }} ({{ $user->created_at->diffForHumans() }})</span>
                            </li>
                            <li class="flex border-b border-border/30 py-2">
                                <span class="font-bold text-primary w-24">Mobile:</span>
                                @if($user->profile && $user->profile->phone_number)
                                    <span class="text-primary-muted">{{ $user->profile->phone_number }}</span>
                                @else
                                    <span class="text-primary-muted">not availiable</span>
                                @endif

                            </li>
                            <li class="flex border-b border-border/30 py-2">
                                <span class="font-bold text-primary w-24">Email:</span>
                                <span class="text-primary-muted">{{ $user->email }}</span>
                            </li>
                            <li class="flex border-b border-border/30 py-2">
                                <span class="font-bold text-primary w-24">Location:</span>
                                <span class="text-primary-muted">{{ $user->profile ? $user->profile->city : 'not available' }}</span>
                            </li>
                        </ul>
                        <div class="w-1/2">
                            {!! $user->profile ? $user->profile->biography : '' !!}
                        </div>
                    </div>
                </section>

                <section>
                    <x-tbv-heading_h5>Activity Log</x-tbv-heading_h5>
                    <div class="relative px-4">
                        <div class="absolute h-full border border-dashed border-opacity-20 border-border/30"></div>

                        @forelse($activities as $activity)
                            <!-- start::Timeline item -->
                            <div class="flex items-center w-full my-6 -ml-1.5">
                                <div class="w-1/12 z-10">
                                    <div class="w-3.5 h-3.5 bg-secondary rounded-full"></div>
                                </div>
                                <div class="w-11/12">
                                    <p class="text-sm">
                                        {{ ucfirst($activity['message']) }}
                                    </p>
                                    <p class="text-xs text-primary-muted">{{ $activity['date']->diffForHumans() }}</p>
                                </div>
                            </div>
                            <!-- end::Timeline item -->
                        @empty
                            <div class="flex items-center w-full my-6 -ml-1.5">
                                <div class="w-1/12 z-10">
                                    <div class="w-3.5 h-3.5 bg-gray-400 rounded-full"></div>
                                </div>
                                <div class="w-11/12">
                                    <p class="text-sm">No activities found.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section>
                    <x-tbv-heading_h5>Statistics</x-tbv-heading_h5>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mt-4">
                        <x-tbv-stat-card
                                title="Posts"
                                :count="$stats['posts']"
                                color="indigo"
                                icon="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"
                        />

                        <x-tbv-stat-card
                                title="Comments"
                                :count="$stats['comments']"
                                color="green"
                                icon="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                        />

                        <x-tbv-stat-card
                                title="Likes"
                                :count="$stats['likes']"
                                color="red"
                                icon="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                        />

                        <x-tbv-stat-card
                                title="Followers"
                                :count="$stats['followers']"
                                color="purple"
                                icon="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                        />

                        <x-tbv-stat-card
                                title="Following"
                                :count="$stats['following']"
                                color="yellow"
                                icon="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                        />

                        @if ($user->hasRole(['admin', 'member']))
                            <x-tbv-stat-card
                                    title="Invitations"
                                    :count="$stats['invitations']"
                                    color="blue"
                                    icon="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />
                        @endif
                    </div>
                </section>
            </div>


            <aside class="hidden md:flex w-full flex-col px-3 md:w-1/4 gap-4">
                <livewire:user-following :user="$user"/>
                <livewire:user-followers :user="$user"/>

            </aside>
        </main>

    </div>
</x-app-layout>
