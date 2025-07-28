<x-link.navigation href="{{ route('home') }}" :active="request()->routeIs('home')" icon="home">
    Home
</x-link.navigation>

<x-link.navigation href="{{ route('team') }}" :active="request()->routeIs('team')" icon="users">
    Team
</x-link.navigation>

<x-link.navigation href="{{ route('scores') }}" :active="request()->routeIs('scores')" icon="dices">
    Scores
</x-link.navigation>

<x-link.navigation href="{{ route('photos') }}" :active="request()->routeIs('photo')" icon="images">
    Photos
</x-link.navigation>

<x-link.navigation href="{{ route('blog') }}" :active="request()->routeIs('blog')" icon="newspaper">
    Blog
</x-link.navigation>

<x-link.navigation href="{{ route('contact') }}" :active="request()->routeIs('contact')" icon="receipt-text">
    Contact
</x-link.navigation>