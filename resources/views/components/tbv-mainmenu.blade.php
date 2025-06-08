<x-tbv-link-navigation href="{{ route('home') }}" :active="request()->routeIs('home')" class="flex gap-2">
    <x-lucide-home class="h-5 w-5"/>
    Home
</x-tbv-link-navigation>
<x-tbv-link-navigation href="{{ route('team.index') }}" :active="request()->routeIs('team')" class="flex gap-2">
    <x-lucide-users class="h-5 w-5"/>
    Team
</x-tbv-link-navigation>
@role('admin|member')
<x-tbv-link-navigation href="{{ route('admin.games.index') }}" :active="request()->routeIs('admin.games.*')"
                       class="flex gap-2">
    <x-lucide-swords class="h-5 w-5"/>
    Games
</x-tbv-link-navigation>
@endrole
{{--@role('admin|member')--}}
{{--<x-tbv-dropdown align="left" width="48">--}}
{{--    <x-slot name="trigger">--}}
{{--        <button type="button" class="flex items-center gap-2 text-sm font-medium">--}}
{{--            <x-lucide-users class="h-5 w-5"/>--}}
{{--            Team--}}
{{--            <svg class="ms-1 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                      d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>--}}
{{--            </svg>--}}
{{--        </button>--}}
{{--    </x-slot>--}}

{{--    <x-slot name="content">--}}
{{--        <x-tbv-link-dropdown href="#" class="block">--}}
{{--            {{ __('Team Overzicht') }}--}}
{{--        </x-tbv-link-dropdown>--}}
{{--        <x-tbv-link-dropdown href="#" class="block">--}}
{{--            {{ __('Team Kalender') }}--}}
{{--        </x-tbv-link-dropdown>--}}
{{--        <x-tbv-link-dropdown href="#" class="block">--}}
{{--            {{ __('Statistieken') }}--}}
{{--        </x-tbv-link-dropdown>--}}
{{--    </x-slot>--}}
{{--</x-tbv-dropdown>--}}
{{--@else--}}
{{--    <x-tbv-link-navigation href="{{ route('team.index') }}" :active="request()->routeIs('team')" class="flex gap-2">--}}
{{--        <x-lucide-users class="h-5 w-5"/>--}}
{{--        Team--}}
{{--    </x-tbv-link-navigation>--}}
{{--    @endrole--}}

<x-tbv-link-navigation href="{{ route('post.index') }}" :active="request()->routeIs('post')" class="flex gap-2">
    <x-lucide-newspaper class="h-5 w-5"/>
    Blog
</x-tbv-link-navigation>
@role('admin|member')
<x-tbv-link-navigation href="{{ route('admin.post.create') }}" :active="request()->routeIs('admin.post.create')"
                       class="flex gap-2">
    <x-lucide-file-plus-2 class="h-5 w-5"/>
    New Post
</x-tbv-link-navigation>
@endrole
<x-tbv-link-navigation href="{{ route('events') }}" :active="request()->routeIs('events')" class="flex gap-2">
    <x-lucide-calendar-range class="h-5 w-5"/>
    Events
</x-tbv-link-navigation>
<x-tbv-link-navigation href="{{ route('contact') }}" :active="request()->routeIs('contact')" class="flex gap-2">
    <x-lucide-receipt-text class="h-5 w-5"/>
    Contact
</x-tbv-link-navigation>