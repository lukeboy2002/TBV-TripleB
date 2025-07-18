<x-link.navigation href="{{ route('home') }}" :active="request()->routeIs('home')" icon="home">
    Home
</x-link.navigation>

<x-link.navigation href="{{ route('team') }}" :active="request()->routeIs('team')" icon="users">
    Team
</x-link.navigation>

<x-link.navigation href="{{ route('events') }}" :active="request()->routeIs('events')" class="">
    Events
</x-link.navigation>

<x-link.navigation href="{{ route('contact') }}" :active="request()->routeIs('contact')" class="">
    Contact
</x-link.navigation>