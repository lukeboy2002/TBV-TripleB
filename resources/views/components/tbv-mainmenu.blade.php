<x-tbv-link-navigation wire:navigate href="{{ route('home') }}" :active="request()->routeIs('home')" class="flex gap-2">
    <x-lucide-home class="h-5 w-5"/>
    Home
</x-tbv-link-navigation>
<x-tbv-link-navigation wire:navigate href="{{ route('team.index') }}" :active="request()->routeIs('team')"
                       class="flex gap-2">
    <x-lucide-users class="h-5 w-5"/>
    Team
</x-tbv-link-navigation>
@role('admin|member')
<x-tbv-link-navigation wire:navigate href="{{ route('admin.games.index') }}"
                       :active="request()->routeIs('admin.games.*')"
                       class="flex gap-2">
    <x-lucide-swords class="h-5 w-5"/>
    Games
</x-tbv-link-navigation>
@endrole

<x-tbv-link-navigation wire:navigate href="{{ route('post.index') }}" :active="request()->routeIs('post')"
                       class="flex gap-2">
    <x-lucide-newspaper class="h-5 w-5"/>
    Blog
</x-tbv-link-navigation>
@role('admin|member')
<x-tbv-link-navigation wire:navigate href="{{ route('admin.post.create') }}"
                       :active="request()->routeIs('admin.post.create')"
                       class="flex gap-2">
    <x-lucide-file-plus-2 class="h-5 w-5"/>
    New Post
</x-tbv-link-navigation>
@endrole
<x-tbv-link-navigation wire:navigate href="{{ route('agenda.index') }}" :active="request()->routeIs('agenda.*')"
                       class="flex gap-2">
    <x-lucide-calendar-range class="h-5 w-5"/>
    Events
</x-tbv-link-navigation>
<x-tbv-link-navigation wire:navigate href="{{ route('albums.index') }}" :active="request()->routeIs('albums.*')"
                       class="flex gap-2">
    <x-lucide-images class="h-5 w-5"/>
    Albums
</x-tbv-link-navigation>
<x-tbv-link-navigation wire:navigate href="{{ route('contact') }}" :active="request()->routeIs('contact')"
                       class="flex gap-2">
    <x-lucide-receipt-text class="h-5 w-5"/>
    Contact
</x-tbv-link-navigation>