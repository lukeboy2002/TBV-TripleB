<x-link.navigation href="{{ route('home') }}" :active="request()->routeIs('home')" icon="home">
    Home
</x-link.navigation>

<x-link.navigation href="{{ route('team.index') }}" :active="request()->routeIs('team.*')" icon="users">
    Team
</x-link.navigation>

<x-link.navigation href="{{ route('games.index') }}" :active="request()->routeIs('games.*')" icon="dices">
    Wedstijden
</x-link.navigation>

<x-link.navigation href="{{ route('albums.index') }}" :active="request()->routeIs('albums.*')" icon="images">
    Foto's
</x-link.navigation>

<x-link.navigation href="{{ route('post.index') }}" :active="request()->routeIs('post.*')" icon="newspaper">
    Blog
</x-link.navigation>

<x-link.navigation href="{{ route('agenda.index') }}" :active="request()->routeIs('agenda.*')" icon="calendar-days">
    Agenda
</x-link.navigation>