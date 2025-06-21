<div class="bg-background-accent rounded-lg shadow-md p-4">
    <x-tbv-heading_h5>Following</x-tbv-heading_h5>

    <div class="space-y-3">
        @forelse($following as $followedUser)
            <div class="flex items-center space-x-3">
                <img src="{{ $followedUser->profile_photo_url }}" alt="{{ $followedUser->username }}"
                     class="w-10 h-10 rounded-full">
                <div>
                    <a href="{{ route('profile.show', $followedUser) }}"
                       class="font-medium text-primary hover:text-secondary">
                        {{ $followedUser->username }}
                    </a>
                    <p class="text-xs text-primary-muted">{{ $followedUser->name }}</p>
                </div>
            </div>
        @empty
            <p class="text-primary-muted text-sm">Not following anyone yet.</p>
        @endforelse

        {{--        @if($totalFollowing > $limit)--}}
        {{--            <div class="text-center mt-2">--}}
        {{--                --}}{{--                TODO: view more following--}}
        {{--                <button class="text-sm text-secondary hover:underline">View all following</button>--}}
        {{--            </div>--}}
        {{--        @endif--}}
    </div>
</div>