<x-slot name="header">
    <x-heading.heading1>Our Team</x-heading.heading1>
</x-slot>

<x-card.default class="lg:flex gap-4 w-full">
    @foreach($this->users as $user)
        <div class="relative md:flex gap-4 w-full px-3 lg:w-3/4">

            <!-- Loading Spinner -->
            <div wire:loading
                 class="rounded-lg absolute inset-0 flex items-center justify-center bg-background/90 z-10">
                <div class="flex h-[40rem] items-center justify-center">

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

            <div class="w-full md:w-1/2">
                <img class="rounded-lg w-full h-[20rem] md:h-[40rem] object-cover"
                     src="{{ Storage::url($user->profile->image_path) }}"
                     alt="{{ $user->username }}"/>
            </div>

            <div class="w-full md:w-1/2 pt-4">
                <div class="text-2xl font-secondary font-bold text-secondary flex justify-between">
                    <a wire:navigate
                       href="#">{{ ucfirst($user->username) }}</a>
                    <div>{{ $this->users->links() }}</div>
                </div>
                <div class="mt-8 content">{!! $user->profile->biography !!}</div>
            </div>
        </div>
    @endforeach
</x-card.default>