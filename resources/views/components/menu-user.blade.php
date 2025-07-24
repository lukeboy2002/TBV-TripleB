@can('view:user')
    <x-dropdown-link
            href="{{ route('admin.users.index') }}">
        {{ __('Show Users') }}
    </x-dropdown-link>
@endcan

@can('view:role')
    <x-dropdown-link href="{{ route('admin.roles.index') }}">
        Roles
    </x-dropdown-link>
@endcan

@can('view:permission')
    <x-dropdown-link href="{{ route('admin.permissions.index') }}">
        Permissions
    </x-dropdown-link>
@endcan

@can('create:user')
    <x-dropdown-link
            href="#">
        {{ __('Invite User') }}
    </x-dropdown-link>
@endcan