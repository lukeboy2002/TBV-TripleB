<div class="flex flex-col gap-6">
    <x-card.side>
        <x-slot name="header">Present</x-slot>
        @forelse($attending as $attendance)
            <div class="flex items-center gap-4 p-2">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8 rounded-full" src="{{ $attendance->user->profile_photo_url }}"
                         alt="{{ $attendance->user->username }}">
                </div>
                <div class="text-sm font-medium text-secondary">{{ ucfirst($attendance->user->username) }}</div>
            </div>
        @empty
            <div class="p-2 text-secondary">No one confirmed yet.</div>
        @endforelse
    </x-card.side>

    <x-card.side>
        <x-slot name="header">Not present</x-slot>
        @forelse($notAttending as $attendance)
            <div class="flex items-center gap-4 p-2">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8 rounded-full" src="{{ $attendance->user->profile_photo_url }}"
                         alt="{{ $attendance->user->username }}">
                </div>
                <div class="text-sm font-medium text-secondary">{{ ucfirst($attendance->user->username) }}</div>
            </div>
        @empty
            <div class="p-2 text-secondary">No members marked not present.</div>
        @endforelse
    </x-card.side>

    <x-card.side>
        <x-slot name="header">Maybe</x-slot>
        @forelse($maybe as $attendance)
            <div class="flex items-center gap-4 p-2">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8 rounded-full" src="{{ $attendance->user->profile_photo_url }}"
                         alt="{{ $attendance->user->username }}">
                </div>
                <div class="text-sm font-medium text-secondary">{{ ucfirst($attendance->user->username) }}</div>
            </div>
        @empty
            <div class="p-2 text-secondary">No undecided members.</div>
        @endforelse
    </x-card.side>
</div>