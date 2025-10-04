<x-link.navigation href="{{ route('home') }}" :active="request()->routeIs('home')" icon="home">
    {{ __('Home') }}
</x-link.navigation>

<x-link.navigation href="{{ route('team') }}" :active="request()->routeIs('team')" icon="users">
    {{ __('Team') }}
</x-link.navigation>

<x-link.navigation href="#" icon="dices">
    {{ __('Games') }}
</x-link.navigation>

<x-link.navigation href="#" icon="images">
    {{ __('Images') }}
</x-link.navigation>

<x-link.navigation href="#" icon="newspaper">
    {{ __('Blog') }}
</x-link.navigation>

<x-link.navigation href="#" icon="calendar-days">
    {{ __('Agenda') }}
</x-link.navigation>