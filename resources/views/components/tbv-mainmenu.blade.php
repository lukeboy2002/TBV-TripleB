<x-tbv-link-navigation href="{{ route('home') }}" :active="request()->routeIs('home')" class="flex gap-2">
    <x-lucide-home class="h-5 w-5"/>
    Home
</x-tbv-link-navigation>
<x-tbv-link-navigation href="{{ route('team') }}" :active="request()->routeIs('team')" class="flex gap-2">
    <x-lucide-users class="h-5 w-5"/>
    Team
</x-tbv-link-navigation>
<x-tbv-link-navigation href="{{ route('post') }}" :active="request()->routeIs('post')" class="flex gap-2">
    <x-lucide-newspaper class="h-5 w-5"/>
    Blog
</x-tbv-link-navigation>
<x-tbv-link-navigation href="{{ route('events') }}" :active="request()->routeIs('events')" class="flex gap-2">
    <x-lucide-calendar-range class="h-5 w-5"/>
    Events
</x-tbv-link-navigation>
<x-tbv-link-navigation href="{{ route('contact') }}" :active="request()->routeIs('contact')" class="flex gap-2">
    <x-lucide-receipt-text class="h-5 w-5"/>
    Contact
</x-tbv-link-navigation>