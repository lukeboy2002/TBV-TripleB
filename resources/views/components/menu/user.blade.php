@role('admin')
<x-dropdown-link
        href="{{ route('roles.index') }}">
    {{ __('Roles') }}
</x-dropdown-link>
<x-dropdown-link
        href="{{ route('users.index') }}">
    {{ __('Users') }}
</x-dropdown-link>
@endrole
@can('create:category')
    <x-dropdown-link
            href="{{ route('categories.index') }}">
        {{ __('Category') }}
    </x-dropdown-link>
@endcan

@can('create:user')
    <x-dropdown-link
            href="{{ route('invitations.index') }}">
        {{ __('Invite User') }}
    </x-dropdown-link>
@endcan

@can('create:game')
    <x-dropdown-link href="{{ route('game.create') }}">
        {{ __('Create Game') }}
    </x-dropdown-link>
@endcan