<div class="bg-background-accent rounded-lg shadow-md p-4 mb-4">
    <x-tbv-heading_h5>Followers</x-tbv-heading_h5>
    <div class="space-y-3">
        @forelse($followers as $follower)
            <div class="flex items-center space-x-3">
                <img src="{{ $follower->profile_photo_url }}" alt="{{ $follower->username }}"
                     class="w-10 h-10 rounded-full">
                <div>
                    <a href="{{ route('profile.show', $follower) }}"
                       class="font-medium text-primary hover:text-secondary">
                        {{ $follower->username }}
                    </a>
                    <p class="text-xs text-primary-muted">{{ $follower->name }}</p>
                </div>
            </div>
        @empty
            <p class="text-primary-muted text-sm">No followers yet.</p>
        @endforelse

        {{--        @if($totalFollowers > $limit)--}}
        {{--            <div class="text-center mt-2">--}}
        {{--                --}}{{--                TODO: view more followers--}}
        {{--                <button class="text-sm text-secondary hover:underline">View all followers</button>--}}
        {{--            </div>--}}
        {{--        @endif--}}
    </div>
</div>