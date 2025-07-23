@can('view:user', App\Models\User::class)
    <x-dropdown-link
            href="{{ route('admin.users.index') }}">
        {{ __('Show Users') }}
    </x-dropdown-link>
@endcan

@can('view:role', App\Models\Role::class)
    <x-dropdown-link href="{{ route('admin.roles.index') }}">
        Roles
    </x-dropdown-link>
@endcan

@can('view:permission', App\Models\Permission::class)
    <x-dropdown-link href="{{ route('admin.permissions.index') }}">
        Permissions
    </x-dropdown-link>
@endcan

@can('create:user', App\Models\User::class)
    <x-dropdown-link
            href="#">
        {{ __('Invite User') }}
    </x-dropdown-link>
@endcan