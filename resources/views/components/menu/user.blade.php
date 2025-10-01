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